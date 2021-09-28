<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{ site_url('assets/templates/backend/./') }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>Sistem Peminjaman dan Inventory Sarana Prasarana</title>
    <!-- Icons-->
    <link href="{{ site_url('assets/templates/backend/vendors/@coreui/icons/css/coreui-icons.min.css') }}"
        rel="stylesheet">
    <link href="{{ site_url('assets/templates/backend/vendors/flag-icon-css/css/flag-icon.min.css') }}"
        rel="stylesheet">
    <link href="{{ site_url('assets/templates/backend/vendors/font-awesome/css/font-awesome.min.css') }}"
        rel="stylesheet">
    <link href="{{ site_url('assets/templates/backend/vendors/simple-line-icons/css/simple-line-icons.css') }}"
        rel="stylesheet">

    <link href="{{ site_url('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ site_url('assets/plugins/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ site_url('assets/plugins/izimodal/css/iziModal.min.css') }}" rel="stylesheet">
    <link href="{{ site_url('assets/plugins/izimodal/css/iziModal.min.css') }}" rel="stylesheet">
    <link href="{{ site_url('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') }}"
        rel="stylesheet">
    <link href="{{ site_url('assets/plugins/clockpicker/dist/jquery-clockpicker.min.css') }}" rel="stylesheet">
    <link href="{{ site_url('assets/plugins/clockpicker/dist/bootstrap-clockpicker.min.css') }}" rel="stylesheet">


    <!-- Main styles for this application-->
    <link href="{{ site_url('assets/templates/backend/css/style.css') }}" rel="stylesheet">
    <link href="{{ site_url('assets/templates/backend/vendors/pace-progress/css/pace.min.css') }}" rel="stylesheet">
    <style>
        .colAction {
            width: 1%;
            white-space: nowrap;
        }

        .col-form-label {
            font-weight: bold;
        }

        .form-control:not(input[type="file"]) {
            border: 1px solid #001100;
        }

        #file-content {
            border: 1px solid #e4e7ea;
            width: 100px;
            height: 100px;
            display: block;
            margin-bottom: 5px;
        }

        #file-content>img {
            width: 100%;
            height: 100%;
        }

    </style>
    @yield('css')
    <script>
        const SITE_URL = '<?= site_url() ?>';
    </script>
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="javascript:void(0);">
            <img class="navbar-brand-full" src="{{ site_url('assets/images/logo backend edu.png') }}" width="89"
                height="20" alt="Sistem Logo">
            <img class="navbar-brand-minimized" src="{{ site_url('assets/images/logo backend edu.png') }}" width="30"
                height="30" alt="Sistem Logo">
        </a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown mr-3">
                <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);" role="button"
                    aria-haspopup="true" aria-expanded="false">
                    {{ $currentRole->role_name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Account</strong>
                    </div>
                    <a class="dropdown-item" href="{{ site_url('logout') }}">
                        <i class="fa fa-lock"></i> Logout</a>
                </div>
            </li>

        </ul>
    </header>
    <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-title">Daftar Menu</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ site_url('private/dashboard') }}">
                            <i class="nav-icon icon-arrow-right"></i> Dashboard
                        </a>
                    </li>

                    @if (strtolower($currentRole->role_name) == 'umum')
                        <li class="nav-item nav-dropdown">
                            <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
                                <i class="nav-icon icon-arrow-right"></i> Master Data
                            </a>
                            <ul class="nav-dropdown-items">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ site_url('private/ruangan') }}">
                                        <i class="nav-icon icon-arrow-right"></i> Ruangan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ site_url('private/daftar_barang') }}">
                                        <i class="nav-icon icon-arrow-right"></i> Daftar Barang
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ site_url('private/daftar_inventaris') }}">
                                        <i class="nav-icon icon-arrow-right"></i> Daftar Inventaris
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ site_url('private/peminjaman_ruangan') }}">
                                <i class="nav-icon icon-arrow-right"></i> Peminjaman Ruangan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ site_url('private/peminjaman_barang') }}">
                                <i class="nav-icon icon-arrow-right"></i> Peminjaman Barang
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ site_url('private/pengajuan_inventaris') }}">
                                <i class="nav-icon icon-arrow-right"></i> Pengajuan Inventaris
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ site_url('private/permintaan_inventaris') }}">
                                <i class="nav-icon icon-arrow-right"></i> Permintaan Inventaris
                            </a>
                        </li>
                    @endif


                    @if (strtolower($currentRole->role_name) == 'kabag tu')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ site_url('private/lembar_disposisi') }}">
                                <i class="nav-icon icon-arrow-right"></i> Lembar Disposisi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ site_url('private/isi_disposisi') }}">
                                <i class="nav-icon icon-arrow-right"></i> Isi Disposisi
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ site_url('private/peminjaman_ruangan/indexReadOnly') }}">
                                <i class="nav-icon icon-arrow-right"></i> Peminjaman Ruangan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ site_url('private/peminjaman_barang/indexReadOnly') }}">
                                <i class="nav-icon icon-arrow-right"></i> Peminjaman Barang
                            </a>
                        </li>
                    @endif
                    @if (strtolower($currentRole->role_name) == 'dekan')
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ site_url('private/peminjaman_ruangan/indexReadOnly') }}">
                                <i class="nav-icon icon-arrow-right"></i> Peminjaman Ruangan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ site_url('private/peminjaman_barang/indexReadOnly') }}">
                                <i class="nav-icon icon-arrow-right"></i> Peminjaman Barang
                            </a>
                        </li>
                    @endif
                    @if (strtolower($currentRole->role_name) == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ site_url('private/user') }}">
                                <i class="nav-icon icon-arrow-right"></i> Pengguna
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>

        @yield('content')

    </div>

    <footer class="app-footer">
        <div>
            <a href="javascript:void(0);">CoreUI
            </a>
            <span>&copy; 2019 Sistem Peminjaman dan Inventory Sarana Prasarana.</span>
        </div>
        <div class="ml-auto">
            <span>Template By</span>
            <a href="javascript:void(0);">CoreUI
            </a>
        </div>
    </footer>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ site_url('assets/templates/backend/vendors/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ site_url('assets/templates/backend/vendors/popper.js/js/popper.min.js') }}"></script>
    <script src="{{ site_url('assets/templates/backend/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ site_url('assets/templates/backend/vendors/pace-progress/js/pace.min.js') }}"></script>
    <script src="{{ site_url('assets/templates/backend/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js') }}">
    </script>

    <script src="{{ site_url('assets/js/custom.js') }}"></script>



    <script src="{{ site_url('assets/templates/backend/vendors/@coreui/coreui/js/coreui.min.js') }}"></script>
    <!-- Plugins and scripts required by this view-->


    <script src="{{ site_url('assets/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ site_url('assets/plugins/izimodal/js/iziModal.min.js') }}"></script>
    <script src="{{ site_url('assets/plugins/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ site_url('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ site_url('assets/plugins/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>
    <script src="{{ site_url('assets/plugins/clockpicker/dist/bootstrap-clockpicker.min.js') }}"></script>



    @yield('js')

    <style>
        .swal2-container {
            z-index: 20000;
        }

    </style>
</body>

</html>
