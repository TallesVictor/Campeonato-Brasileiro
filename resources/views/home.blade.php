<!-- Herda layout principal da aplicação -->
@extends('layouts.app')
<?php define('Version', '1'); ?>
@section('nav')
    <!-- Imprime navegação -->
@endsection


@section('content')
    <div id="container bg-dark">

        <h1>Olá Mundo</h1>
    </div>
@endsection

@section('jg-pg')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>
@endsection
