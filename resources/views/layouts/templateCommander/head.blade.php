    <html lang="en" dir="ltr">

    <head>

        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Zanex – Bootstrap  Admin & Dashboard Template">
        <meta name="author" content="Spruko Technologies Private Limited">
        <meta name="keywords"
            content="admin, dashboard, dashboard ui, admin dashboard template, admin panel dashboard, admin panel html, admin panel html template, admin panel template, admin ui templates, administrative templates, best admin dashboard, best admin templates, bootstrap 4 admin template, bootstrap admin dashboard, bootstrap admin panel, html css admin templates, html5 admin template, premium bootstrap templates, responsive admin template, template admin bootstrap 4, themeforest html">
        <!-- FAVICON -->
        <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/brand/favicon.ico" />

        <title>Rekapitung</title>

        <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

        <link href="../../assets/css/style.css" rel="stylesheet" />
        <link href="../../assets/css/dark-style.css" rel="stylesheet" />
        <link href="../../assets/css/skin-modes.css" rel="stylesheet" />

        <link href="../../assets/css/sidemenu.css" rel="stylesheet" id="sidemenu-theme">

        <link href="../../assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />

        <link href="../../assets/plugins/p-scroll/perfect-scrollbar.css" rel="stylesheet" />

        <link href="../../assets/css/icons.css" rel="stylesheet" />

        <link href="../../assets/plugins/sidebar/sidebar.css" rel="stylesheet">

        <link href="../../assets/plugins/select2/select2.min.css" rel="stylesheet" />

        <link href="../../assets/plugins/datatable/css/dataTables.bootstrap5.css" rel="stylesheet" />
        <link href="../../assets/plugins/datatable/responsive.bootstrap5.css" rel="stylesheet" />

        <link id="theme" rel="stylesheet" type="text/css" media="all" href="../../assets/colors/color1.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqU
KLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

        <!--C3 CHARTS CSS -->
        <link href="../../assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />

        <link rel="stylesheet" href="https://raw.githack.com/thdoan/magnify/master/dist/css/magnify.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">



        @livewireStyles

        <!-- Scripts -->

        <style>
            .mid {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* The switch - the box around the slider */
            .switch {
                position: relative;
                display: inline-block;
                width: 60px;
                height: 34px;
            }

            /* Hide default HTML checkbox */
            .switch input {
                opacity: 0;
                width: 0;
                height: 0;
            }

            /* The slider */
            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                -webkit-transition: .4s;
                transition: .4s;
            }

            .slider:before {
                position: absolute;
                content: "";
                height: 26px;
                width: 26px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
            }

            input:checked+.slider {
                background-color: #2196F3;
            }

            input:focus+.slider {
                box-shadow: 0 0 1px #2196F3;
            }

            input:checked+.slider:before {
                -webkit-transform: translateX(26px);
                -ms-transform: translateX(26px);
                transform: translateX(26px);
            }

            /* Rounded sliders */
            .slider.round {
                border-radius: 34px;
            }

            .slider.round:before {
                border-radius: 50%;
            }

            .btn-dark-custom {
                background: rgb(113, 56, 150);
                background: linear-gradient(180deg, rgba(113, 56, 150, 1) 0%, rgba(108, 48, 147, 1) 2%, rgba(96, 29, 140, 1) 9%, rgba(78, 0, 130, 1) 25%, rgba(64, 0, 107, 1) 84%, rgba(60, 0, 101, 1) 88%, rgba(65, 0, 109, 1) 93%, rgba(15, 0, 25, 1) 100%, rgba(0, 0, 0, 1) 100%, rgba(0, 0, 0, 0.5) 100%, rgba(0, 0, 0, 0.75) 100%);

            }

            .bg-dark-custom {
                background: rgb(78, 0, 130);
                background: linear-gradient(180deg, rgba(78, 0, 130, 1) 0%, rgba(78, 0, 130, 1) 68%, rgba(15, 0, 25, 1) 100%, rgba(0, 0, 0, 1) 100%, rgba(0, 0, 0, 0.5) 100%, rgba(0, 0, 0, 0.75) 100%);
            }
            
            .c3-legend-item text{
                font-size: 11px;
            }

        </style>
    </head>

    <body class="app sidebar-mini dark-mode">
