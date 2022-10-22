<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link href="{{ asset('/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
    <style>
        th,td{
            padding-left: 10px !important;
        }

        .page-break{
            page-break-after: always;
        }

        #data {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #data td, #data th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #data tr:nth-child(even){
            background-color: #f2f2f2;
        }

        #data tr:hover {
            background-color: #ddd;
        }

        #data th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            /* background-color: #def6ff; */
            color: black;
        }
    </style>
</head>
