<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!--Gera cabeçalho com imports e metas -->
    @include('layouts.header')
</head>

<body class="fix-sidebar">
    <!-- Preloader - todas as páginas terão-->
    <div class="preloader">
        <div class="loading-page"></div>
    </div>
    <!--Conteúdo da aplicação -->
    @yield('content')

    <!--Permite inserir aqui o js de cada página-->
    @yield('js-pg')

    <!--Imports JS -->
    @include('layouts.footer')
</body>

</html>
