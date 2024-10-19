<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-1JJLGZJ1FP"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-1JJLGZJ1FP');
        </script>

        <!-- Page Icon  -->
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/icon/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/icon/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/icon/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/icon/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/icon/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/icon/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/icon/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/icon/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/icon/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('images/icon/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/icon/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/icon/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/icon/favicon-16x16.png')}}">
        <link rel="manifest" href="{{ asset('images/icon/manifest.json')}}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('images/icon/ms-icon-144x144.png')}}">
        <meta name="theme-color" content="#ffffff">
        
        <!-- Font Awesome  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <!-- Boostrap  -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.4/dataTables.bootstrap5.css" rel="stylesheet">
        
        <!-- jQuery  -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.4/dataTables.bootstrap5.min.js" integrity="sha512-KFdmxVdAssPxrj4mZh1c01AbGXMAmXmBsO4Tc/GG5+kNLqitTfUBpDHicyDwF7CaFV+pN1r808IOK+vHzWB8gw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-wOLiP6uL5tNrV1FiutKtAyQGGJ1CWAsqQ6Kp2XZ12/CvZxw8MvNJfdhh0yTwjPIir4SWag2/MHrseR7PRmNtvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
        <!-- Page Description  -->

        @yield('pageTitle')

        @yield('pageMeta')

        <link rel="stylesheet" href="{{ asset('build/assets/app-965d8c7c.css') }}">
        <link href="{{ asset('css/main.css?v=1.1') }}" rel="stylesheet">
        @vite('resources/css/app.css')
    
    </head>
    <body class="gray-bg">
        @yield('nav')                
        @yield('pageContents')
        @yield('footer')
    </body>
</html>
