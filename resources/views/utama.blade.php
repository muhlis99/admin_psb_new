
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ADMIN PSB</title>
        <link rel="shortcut icon" href="{{asset('gambar')}}/naa.png">
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{asset('asset')}}/plugins/fontawesome-free/css/all.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{asset('asset')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('asset')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <link rel="stylesheet" href="{{asset("asset")}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="{{asset("asset")}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="{{asset("asset")}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <link rel="stylesheet" href="{{asset("asset")}}/sweetalert2/sweetalert2.min.css">
        <link rel="stylesheet" href="{{asset('asset')}}/font/font.css">
        <link rel="stylesheet" href="{{asset('asset')}}/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="{{asset('asset')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <link rel="stylesheet" href="{{asset("asset")}}/parsleyjs/parsley.css">
        <link rel="stylesheet" href="{{asset('asset')}}/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="{{asset("asset")}}/bootstrap-datepicker.css">

        <script src="{{asset('asset')}}/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="{{asset('asset')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset("asset")}}/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="{{asset("asset")}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="{{asset("asset")}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="{{asset("asset")}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="{{asset("asset")}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="{{asset("asset")}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="{{asset("asset")}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="{{asset("asset")}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="{{asset("asset")}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="{{asset('asset')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('asset')}}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
        <script src="{{asset('asset')}}/plugins/raphael/raphael.min.js"></script>
        <script src="{{asset('asset')}}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
        <script src="{{asset('asset')}}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
        <!-- ChartJS -->
        <script src="{{asset('asset')}}/plugins/chart.js/Chart.min.js"></script>
        <script src="{{asset("asset")}}/plugins/moment/moment.min.js"></script>
        <script src="{{asset("asset")}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="{{asset('asset')}}/dist/js/adminlte.js"></script>
        <!-- PAGE PLUGINS -->
        <script src="{{asset('asset')}}/dist/js/demo.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        {{-- <script src="{{asset('asset')}}/dist/js/pages/dashboard2.js"></script> --}}
        <script src="{{asset("asset")}}/sweetalert2/sweetalert2.min.js"></script>
        <script src="{{asset("asset")}}/plugins/select2/js/select2.full.min.js"></script>
        <script src="{{asset("asset")}}/parsleyjs/parsley.js"></script>
        <script src="{{asset("asset")}}/parsleyjs/i18n/id.js"></script>
        <script src="{{asset("asset")}}/parsleyjs/i18n/id.extra.js"></script>
        <script src="{{asset('asset')}}/bootstrap-datepicker.min.js"></script>
        <!-- instaScan -->
        <script  src="{{asset('asset')}}/qrCode/adapter.min.js"></script>
        <script  src="{{asset('asset')}}/qrCode/vue.min.js"></script>
        <script  src="{{asset('asset')}}/qrCode/instascan.min.js"></script>

        <style>
            #loading{
                height: 100%;
                position: fixed;
                text-align: center; 
                display: flex; 
                align-items:center; 
                justify-content: center;
                left:0; 
                top: 0; 
                min-height:100%;
                height:auto; 
                background-color: rgba(0, 0, 0, .5); 
                z-index:99999;
                display:none;
            }
        </style>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <script>
$(document).ready(function () {
    $('textarea').each(function () {
        $(this).val($(this).val().trim());
    }
    );
});
        </script>
        <div id="loading" class="col-md-12 text-center">
            <img src="{{asset('asset/loading/loading.png')}}" style="height:60px; width:300px; margin:0 auto; margin-top:270px;">
        </div>
        <?php
        $user = DB::table("tb_admin")->where("id", Session::get("id_admin"))->first();
        ?>
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                            <i class="fas fa-bars"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <!-- Messages Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-user"></i>&nbsp;
                            <?php echo $user->nama ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- <div class="dropdown-divider"></div>-->
                            <button id="bt_logout" class="dropdown-item text-center" type="button">
                                <i class="fas fa-sign-out-alt"></i>&nbsp;
                                Keluar
                            </button>
                        </div>
                    </li>
                </ul>
            </nav>

            <script>
                $(document).ready(function () {
                    $("#bt_logout").click(function () {
                        swal({
                            title: 'Anda yakin keluar?',
                            text: "",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'YA',
                            cancelButtonText: 'TIDAK',
                            confirmButtonClass: 'btn btn-success',
                            cancelButtonClass: 'btn btn-danger',
                            buttonsStyling: true
                        }).then(function () {
                            window.location.href = '{{url("logout_adm")}}';
                        });
                    });
                });
            </script>

            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{url("/")}}" class="brand-link">
                    <img src="{{asset('gambar')}}/naa.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-1">
                    <span class="brand-text font-weight-light">ADMIN PSB NAA</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image pt-2">
                            <img src="{{asset('image')}}/user.png" class="img-circle elevation-1" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#">
                                <?php echo $user->nama ?>
                            </a>
                            <br>
                            <span class="text-white">
                                Admin
                            </span>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{url("/")}}" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Beranda
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Terima Santri Online
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{url('terima_qrcode')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                QR Code
                                            </p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{url('terima')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                No Registrasi
                                            </p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            
                            <li class="nav-item">
                                <a href="{{url('offline')}}" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Daftar Santri Offline
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-print"></i>
                                    <p>
                                        Cetak Data
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{url('cetak_siswa')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Cetak Siswa</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('cetak_mahrom')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Cetak Mahrom</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('cetak_santri')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Cetak Santri</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </body>
</html>

