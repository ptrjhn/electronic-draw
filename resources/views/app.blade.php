<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/png" href="{{ asset('static/logo/logo.png') }}" />
    <title>{{ config('app.name', 'E-Raffle') }}</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Style -->
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet"
        href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">

    <style>
        .main {
            background-color: white;
        }
    </style>
</head>

<body>
    <div id="app">
        <main class="main">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    {{-- <script src="{{ mix('js/app.js') }}" type="text/javascript"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.3/vue-resource.min.js">
    </script>
    <script type="text/javascript" src="/js/util.js"></script>
    <script type="text/javascript" src="/js/modal.js"></script>
    {{-- <script type="text/javascript" src="/js/form-helper.js"></script> --}}
    {{-- <script type="text/javascript" src="/js/auth.js"></script> --}}
    @yield('additional-script')
</body>

</html>