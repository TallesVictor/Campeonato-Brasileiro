function loading() {
    $(".preloader").addClass('d-flex');
    $(".preloader").show()
}

function hideLoading() {
    $(".preloader").hide()
    $(".preloader").removeClass('d-flex');
}

function erro(id, msg) {
    $("#aviso-" + id).hide();
    if (msg) {
        $("#mensagem-" + id).html(msg);
        $("#aviso-" + id).show();
    }

}