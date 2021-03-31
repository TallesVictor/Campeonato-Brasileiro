/** Listar a tabela do Campeonato Brasileiro A */


$(document).ready(function() {
    tabelaBrasileiraoA();
    show();
    formConfronto();
    $('.placar').mask('99');
});

function tabelaBrasileiraoA() {
    $.ajax({
        type: "GET",
        url: "/index",
        success: function(data) {

            let html = "";

            for (let i = 0; i < data.length; i++) {
                let classe = "";
                let rank = parseInt(data[i].RANK);
                let derrota = data[i].derrota;
                let logo = data[i].logo;
                let empate = data[i].empate;
                let gols_contra = data[i].gols_contra;
                let gols_pro = data[i].gols_pro;
                let name = data[i].name;
                let pontuacao = data[i].pontuacao;
                let jogos = data[i].jogos;
                let saldo_gols = data[i].saldo_gols;
                let vitorias = data[i].vitorias;

                if (rank == 1)
                    classe = "campeao"
                else if (rank >= 2 && rank <= 7)
                    classe = "libertadores"
                else if (rank >= 8 && rank <= 14)
                    classe = "copa-brasil"
                html += `<tr class="${classe}" >
                            <td class="text-center"> v </td>
                            <td class="text-left">
                                ${rank}º&nbsp;
                                <img src="${logo}" class="img-logo" alt="${name}">
                                &nbsp;${name}
                            </td>
                            <td>${pontuacao}</td>
                            <td>${jogos}</td>
                            <td>${vitorias}</td>
                            <td>${empate}</td>
                            <td>${derrota}</td>
                            <td>${gols_pro}</td>
                            <td>${gols_contra}</td>
                            <td>${saldo_gols}</td>
                        </tr>`;

            }
            $("#bodyBrasileiroA").html(html);
            hideLoading();
        }

    });
}


/** Listar todos os times */
function show() {
    let html = '<option value="">Escolha</option>';
    $.ajax({
        type: "GET",
        url: "/show",
        success: function(data) {
            for (let i = 0; i < data.length; i++) {
                html += `<option value="${data[i].id}">${data[i].name}</option>`;
            }
            $("#selectCasa-ModalConfronto").html(html);
            $("#selectVisitante-ModalConfronto").html(html);
        }
    });


}

function formConfronto() {

    $("#formConfronto").submit(function(e) {
        e.preventDefault();
        console.log(new FormData(this))
        $.ajax({
            type: "POST",
            url: "create",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(data) {
                if (data == 'true') {
                    $("#modalConfronto").modal("hide");
                } else if (data == 'false') {
                    erro('ModalConfronto', 'Erro ao salvar no Bando de Dados');
                }
            },
            erro: function() {
                erro('ModalConfronto', 'Erro ao salvar no Bando de Dados');
            }
        });

    });
}

function compararTimes() {
    let timeCasa = $("#selectCasa-ModalConfronto").val();
    let timeVisitante = $("#selectVisitante-ModalConfronto").val();
    let msg = "";
    if (timeCasa == timeVisitante) {
        msg = "Dois times iguais não podem se disputar!";
    }
    erro('ModalConfronto', msg);
}