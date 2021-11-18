<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MSRA') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 4px;
            height: 40px;
        }

        .control-sidebar.control-sidebar-dark>a.nav-link-controlsidebar>p.control-sidbar-p {
            margin: 5%;
            padding: 2%;
        }

        .control-sidebar.control-sidebar-dark>a.nav-link-controlsidebar:hover {
            text-decoration: none;
            cursor: pointer;
        }

        .control-sidbar-icon {
            margin-right: 4%;
        }

        .css-social-icon {
            border: 1px solid gray;
            padding: 5px;
            border-radius: 4px;
            background-color: rgba(100, 100, 100, 0.1);
        }

        .css-label-badge {
            border: 1px solid gray;
            font-weight: bold;
            padding: 5px;
            margin: 10px;
            border-radius: 4px;
            background-color: rgba(100, 100, 100, 0.1);
        }
    </style>
</head>