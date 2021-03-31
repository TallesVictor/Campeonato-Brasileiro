<!-- Herda layout principal da aplicação -->
@extends('layouts.app')
<?php define('Version', '1'); ?>
@section('nav')
    <!-- Imprime navegação -->
@endsection


@section('content')
    <div class="container border pt-4">
        <div class="row">
            <div class="col-sm">
                <h3>Tabela Brasilerião Série A</h3>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-sm-2 align-self-center pb-3">
                <button class="btn btn-success w-100" data-toggle="modal" data-target="#modalConfronto">Inserir
                    Confronto</button>
            </div>

        </div>
        <div class="row">
            <div class="col-sm">
                <div class="table-responsive-sm">
                    <table class="table table-hover" id="tabelaBrasileiraoA">
                        <thead>
                            <tr>
                                <th colspan="2">Posição</th>
                                <th class="">PTS</th>
                                <th class="">J</th>
                                <th class="">V</th>
                                <th class="">E</th>
                                <th class="">D</th>
                                <th class="">GP</th>
                                <th class="">GC</th>
                                <th class="">SG</th>
                            </tr>
                        </thead>
                        <tbody id="bodyBrasileiroA">
                            {{-- @foreach ($times as $collection)
                                <tr>
                                    <td> v </td>
                                    <td class="text-left">
                                        1º
                                        <img src="{{ url($collection->logo) }}" class="img-logo"
                                            alt="{{ $collection->name }}" />
                                        {{ $collection->name }}
                                    </td>
                                    <td>99</td>
                                    <td>99</td>
                                    <td>99</td>
                                    <td>99</td>
                                    <td>99</td>
                                    <td>99</td>
                                    <td>99</td>
                                    <td>99</td>
                                </tr>
                            @endforeach --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


    @extends('modais');
@endsection


@section('js-pg')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>
    <script src="js/funcoes.js?v=<?php echo Version; ?>"></script>
    <script src="js/campeonato-brasileiro.js?v=<?php echo Version; ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
@endsection
