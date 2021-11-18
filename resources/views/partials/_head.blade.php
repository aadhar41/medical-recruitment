<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="shortcut icon" type="images/favicon.png" href="images/favicon.png" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/mapdata.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/australiamap.js') }}"></script>
    <title>247FS</title>
    <style>
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid rgba(200, 200, 200, 0.8);
            border-radius: 4px;
            height: 38px;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            display: block;
            padding-left: 0px;
            padding-right: 20px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: rgba(70, 70, 70, 0.8);
            line-height: 28px;
        }
    </style>
</head>