<!-- Modal -->
<div class="modal fade" id="modalConfronto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confronto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- Preenchimento em massa --}}
            <form method="POST" id="formConfrontoMassa">
                <div class="container pt-4">
                    <div class="row">
                        <div class="col-sm">
                            <button class="btn btn-primary w-100" type="submit">Preencher até 400 partidas</button>
                        </div>
                    </div>
                </div>
                <hr>
            </form>

            <form method="POST" id="formConfronto">
                <div class="modal-body container">
                    {{-- Mensagem de aviso --}}
                    <div class="row" id="aviso-ModalConfronto" style="display:none">
                        <div class="alert alert-danger p-2 text-center w-100" role="alert">
                            <label class="m-0" id="mensagem-ModalConfronto"></label>
                        </div>
                    </div>

                    {{-- Dados do formulário --}}
                    <div class=row>
                        <div class="col-sm">
                            <label>Time de Casa</label>
                            <select class="form-control" id="selectCasa-ModalConfronto" name="timeCasa"
                                onchange="compararTimes()" required>
                            </select>
                        </div>
                        <div class="p-0 pr-1" style="width: 10% !important">
                            <label>&nbsp;</label>
                            <input class="form-control placar" type="text" name="placarCasa"
                                id="placarCasa-ModalConfronto" required>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <br>
                            <span class="align-top">X</span>
                        </div>
                        <div class="p-0 pl-1" style="width: 10% !important">
                            <label>&nbsp;</label>
                            <input class="form-control placar" type="text" name="placarVisitante"
                                id="placarVisitante-ModalConfronto" required>
                        </div>
                        <div class="col-sm">
                            <label>Visitante</label>
                            <select class="form-control" id="selectVisitante-ModalConfronto" name="timeVisitante"
                                onchange="compararTimes()" required>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" id="submit-ModalConfronto">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
