<head>
    <title>{{ $title }} | {{ $web_config['web_name'] ? $web_config['web_name'] : 'Nama Aplikasi belum diatur' }}</title>
    <meta charset="utf-8" />
    <meta name="description" content="PT.Mitra Global Kencana" />
    <meta name="keywords" content="PT.Mitra Global Kencana" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="PT.Mitra Global Kencana" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <link rel="canonical" href="" />
    <link rel="shortcut icon" href="{{ $web_config['favicon'] }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/assets/css/custom.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    @yield('css')
    @livewireStyles
    @stack('css')
    {{-- <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= '../../../www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-5FS8GGP');
    </script> --}}
    <style>
        .icon-cog i {
            font-size: 20px;
            transition: .3s;
        }

        .icon-cog:hover I {
            color: #1bc5bd
        }

        .preview-img {
            height: 100px;
        }

        .footer-img {
            position: relative;
        }

        .custom-file-input {
            position: relative;
            z-index: 2;
            width: 100%;
            height: calc(1.6em + 1.21875rem);
            margin: 0;
            opacity: 0;
            cursor: pointer;
        }

        .custom-file-label {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1;
            height: calc(1.6em + 1.21875rem);
            padding: 0.54688rem 0.875rem;
            font-weight: 400;
            cursor: pointer;
            line-height: 1.6;
            color: #1e2022;
            background-color: #fff;
            border: 0.0625rem solid #e7eaf3;
            border-radius: 0.3125rem;
        }

        .custom-file-label::after {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            z-index: 3;
            display: block;
            height: calc(1.6em + 1.09375rem);
            padding: 0.54688rem 0.875rem;
            line-height: 1.6;
            color: #1e2022;
            content: "Browse";
            background-color: transparent;
            border-left: inherit;
            border-radius: 0 0.3125rem 0.3125rem 0;
        }

    </style>
</head>
