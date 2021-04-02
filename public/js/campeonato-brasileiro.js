/** Listar a tabela do Campeonato Brasileiro A */


$(document).ready(function() {
    tabelaBrasileiraoA();
    show();
    formConfronto();
    formConfrontoMassa();
    $('.placar').mask('99');
});

function tabelaBrasileiraoA() {
    loading();
    $.ajax({
        type: "GET",
        url: "/index",
        success: function(data) {
            let html = "";
            let jogos = 0;
            for (let i = 0; i < data.length; i++) {
                let classe = "";
                let status = "";
                let rank = data[i].RANK;
                let derrota = data[i].derrota;
                let logo = data[i].logo;
                let empate = data[i].empate;
                let gols_contra = data[i].gols_contra;
                let gols_pro = data[i].gols_pro;
                let name = data[i].name;
                let pontuacao = data[i].pontuacao;
                jogos = parseInt(data[i].jogos);
                let saldo_gols = data[i].saldo_gols;
                let vitorias = data[i].vitorias;
                // Verificar classificação para destacar posições
                if (rank == 1)
                    classe = "campeao"
                else if (rank >= 2 && rank <= 7)
                    classe = "libertadores"
                else if (rank >= 8 && rank <= 14)
                    classe = "copa-brasil"
                else if (rank >= 17 && rank <= 20)
                    classe = "rebaixamento"

                // Verificar se o time subiu, desceu ou manteve de posição
                if (data[i].status > 0)
                    status = '<i class="fas fa-chevron-up text-success"></i>'
                else if (data[i].status < 0)
                    status = '<i class="fas fa-chevron-down text-danger"></i>'
                else
                    status = '<i class="fas fa-minus text-secondary"></i>'

                html += `<tr class="${classe}  flex-column justify-content-center align-items-center" >
                            <td class="text-center"> ${status} </td>
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
            if (jogos > 38) {
                erro('ModalConfronto', 'O limite de partida já foi alcançado (38 partidas).');
            }
            $("#bodyBrasileiroA").html(html);
            hideLoading();
        },
        error: function(xhr) {
            erro('home', xhr.responseText);
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
        loading();
        $.ajax({
            type: "POST",
            url: "create",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(data) {
                $("#modalConfronto").modal("hide");
                tabelaBrasileiraoA();
                erro('ModalConfronto', null);
                hideLoading();
            },
            error: function(xhr) {
                hideLoading();
                erro('ModalConfronto', xhr.responseText);
            }
        });

    });
}

// Formulário para criar 15 rodadas de forma aleatória para teste
function formConfrontoMassa() {

    $("#formConfrontoMassa").submit(function(e) {
        e.preventDefault();
        loading();
        $.ajax({
            type: "POST",
            url: "createBulk",
            data: {
                timeCasa: 0,
                timeVisitante: 0,
                placarCasa: 0,
                placarVisitante: 0,
            },
            success: function(data) {
                $("#modalConfronto").modal("hide");
                tabelaBrasileiraoA();
                erro('ModalConfronto', null);
                hideLoading();
            },
            error: function(xhr) {
                hideLoading();
                erro('ModalConfronto', xhr.responseText);
                // Limpar algum erro que possa aparecer pelo número de registros que está sendo criado
                if (xhr.status == '400') {
                    $("#modalConfronto").modal("hide");
                    tabelaBrasileiraoA();
                    erro('ModalConfronto', null);
                }
            }
        });

    });
}

function compararTimes() {
    let timeCasa = $("#selectCasa-ModalConfronto").val();
    let timeVisitante = $("#selectVisitante-ModalConfronto").val();
    let msg = "";
    if (timeCasa == timeVisitante) {
        msg = "Dois times iguais não podem disputar!";
    }
    erro('ModalConfronto', msg);
}