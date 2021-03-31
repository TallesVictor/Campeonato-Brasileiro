function loading() {
    $(".preloader").addClass('d-flex');
    $(".preloader").show()
}

function hideLoading() {
    $(".preloader").hide()
    $(".preloader").removeClass('d-flex');
}

function erro(modal, msg) {
    $("#aviso-" + modal).hide();
    $("#submit-" + modal).prop("disabled", false);
    if (msg) {
        $("#mensagem-" + modal).html(msg);
        $("#aviso-" + modal).show();
        $("#submit-" + modal).prop("disabled", true);
    }

}