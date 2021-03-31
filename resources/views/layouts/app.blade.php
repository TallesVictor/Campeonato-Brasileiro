<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!--Gera cabeçalho com imports e metas -->
    @include('layouts.header')
</head>

<body class="fix-sidebar">
    <!-- Preloader - todas as páginas terão-->
    <div class="preloader w-100 h-100 d-flex flex-column justify-content-center align-items-center">
        <div class="spinner-border text-success" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
          </div>
    </div>
    <!--Conteúdo da aplicação -->
    @yield('content')
    
    <!--Imports JS -->
    @include('layouts.footer')
    
    <!--Permite inserir aqui o js de cada página-->
    @yield('js-pg')

</body>

</html>
