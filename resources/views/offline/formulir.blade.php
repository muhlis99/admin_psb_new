<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FORMULIR SANTRI</title>
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
        <script src="{{asset('asset')}}/dist/js/pages/dashboard2.js"></script>
        <script src="{{asset("asset")}}/sweetalert2/sweetalert2.min.js"></script>
        <script src="{{asset("asset")}}/plugins/select2/js/select2.full.min.js"></script>
        <script src="{{asset("asset")}}/parsleyjs/parsley.js"></script>
        <script src="{{asset("asset")}}/parsleyjs/i18n/id.js"></script>
        <script src="{{asset("asset")}}/parsleyjs/i18n/id.extra.js"></script>
        <script src="{{asset('asset')}}/bootstrap-datepicker.min.js"></script>
        
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
    <body style="margin:0;padding-left:7px;">
     <?php
$data = DB::table("tb_person")->where("id_person", $id)->first();
$desa_al = DB::table("desa")->where("id", $data->desa)->first();
$kec_al = DB::table("kecamatan")->where("id", $data->kec)->first();
$kab_al = DB::table("kabupaten")->where("id", $data->kab)->first();
$prov_al = DB::table("provinsi")->where("id", $data->prov)->first();

$desa_w = DB::table("desa")->where("id", $data->desa_w)->first();
$kec_w = DB::table("kecamatan")->where("id", $data->kec_w)->first();
$kab_w = DB::table("kabupaten")->where("id", $data->kab_w)->first();
$prov_w = DB::table("provinsi")->where("id", $data->prov_w)->first();
?>
<style>
    *{
        font-family: "Arial";
    }
</style>
<script>
    window.print();
    window.onafterprint = function (e) {
        window.close();
    };
</script>
<div style="font-size: 19px; height: 1430px; font-family: 'Times New Roman', Times, serif;">
    <div style="font-size: 19px; font-family: 'Times New Roman', Times, serif;">

        <img src="<?php echo asset("gambar/naa.png") ?>" style="width:80px; position: absolute; top: 1px;">
        <div style="margin-left: 100px;">
            <strong>Formulir Pendaftaran Santri Baru<br>
                Pondok Pesantren Nurul Abror Al Robbaniyyin<br>
                Alasbuluh Wongsorejo Banyuwangi</strong>
        </div>
    </div>
    <hr style="width: 100%;">
    <div class="row">
        <table cellpadding="3" cellspacing="0">
            <tr>
                <td><b>Data Diri</b></td>
                <td></td>
            </tr>
            <tr>
                <td>NIUP</td>
                <td>:</td>
                <td><?= $data->niup ?></td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td><?= $data->nama ?></td>
            </tr>
            <tr>
                <td>Tempat Lahir</td>
                <td>:</td>
                <td><?= $data->tempat_lahir ?></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td><?= $data->tanggal_lahir ?></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td><?= $data->nik ?> </td>
            </tr>
            <tr>
                <td>Lembaga Tujuan</td>
                <td>:</td>
                <td><?= $data->pndkn ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?= $data->alamat_lengkap ?></td>
            </tr>
            <tr>
                <td>Desa</td>
                <td>:</td>
                <td><?= $desa_al->name ?></td>
            </tr>
            <tr>
                <td>Kecamatan </td>
                <td>:</td>
                <td><?= $kec_al->name ?></td>
            </tr>
            <tr>
                <td>Kabupaten </td>
                <td>:</td>
                <td><?= $kab_al->name ?></td>
            </tr>
            <tr>
                <td>Provinsi </td>
                <td>:</td>
                <td><?= $prov_al->name ?></td>
            </tr>
            <tr>
                <td>Anak Ke </td>
                <td>:</td>
                <td><?= $data->ank_ke ?></td>
            </tr>
            <tr>
                <td>Jumlah Saudara</td>
                <td>:</td>
                <td><?= $data->sdr ?></td>
            </tr>
            <tr>
                <td>Status Dalam Keluarga</td>
                <td>:</td>
                <td><?= $data->dlm_klrg ?></td>
            </tr>
            <tr><td><br></td></tr>
            <tr>
                <td><strong>Data Keluarga</strong></td>
            </tr>
            <tr>
                <td><b>Data Ayah</b></td>
                <td></td>

            </tr>
            <tr>
                <td>Nama Ayah</td>
                <td>:</td>
                <td><?= $data->nm_a ?></td>

            </tr>
            <tr>
                <td>Pendidikan Ayah</td>
                <td>:</td>
                <td><?= $data->pndkn_a ?></td>
            </tr>
            <tr>
                <td>Pekerjaan Ayah</td>
                <td>:</td>
                <td><?= $data->pkrjn_a ?></td>
            </tr>
            <tr>
                <td><b>Data Ibu</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Nama Ibu</td>
                <td>:</td>
                <td><?= $data->nm_i ?></td>
            </tr>
            <tr>
                <td>Pendidikan Ibu</td>
                <td>:</td>
                <td><?= $data->pndkn_i ?></td>
            </tr>
            <tr>
                <td>Pekerjaan Ibu</td>
                <td>:</td>
                <td><?= $data->pkrjn_i ?></td>
            </tr>
            <tr><td><br></td></tr>
            <tr>
                <td><b>Data Wali</b></td>
            </tr>
            <tr>
                <td>Nama Wali</td>
                <td>:</td>
                <td><?= $data->nm_w ?></td>
                <td>Kecamatan Wali</td>
                <td>:</td>
                <td><?= $kec_w->name ?></td>
            </tr>
            <tr>
                <td>Pendidikan Wali</td>
                <td>:</td>
                <td><?= $data->pndkn_w ?></td>
                <td>Kabupaten Wali</td>
                <td>:</td>
                <td><?= $kab_w->name ?></td>
            </tr>
            <tr>
                <td>Pekerjaan Wali</td>
                <td>:</td>
                <td><?= $data->pkrjn_w ?></td>
                <td>Provinsi Wali</td>
                <td>:</td>
                <td><?= $prov_w->name ?></td>
            </tr>
            <tr>
                <td>Pendapatan Wali</td>
                <td>:</td>
                <td><?= $data->pndptn_w ?></td>
                <td>NO HP Wali</td>
                <td>:</td>
                <td><?= $data->hp_w ?></td>
            </tr>
            <tr>
                <td>Alamat Wali</td>
                <td>:</td>
                <td><?= $data->almt_w ?></td>
                <td>NO Telp Wali</td>
                <td>:</td>
                <td><?= $data->telp_w ?></td>
            </tr>
        </table>
        <p><br><br><br></p>
        <table style="width: 100%;">
            <tr>
                <td style="width: 50%;"></td>
                <td style="width: 23%;"></td>
                <td>Banyuwangi, <?= date('d-m-Y'); ?></td>
            </tr>
            <tr>
                <td>PANITIA PSB</td>
                <td></td>
                <td>WALI SANTRI</td>
            </tr>
            <tr>
                <td><br><br><br><br></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>-----------------------------</td>
                <td></td>
                <td><?= $data->nm_w ?></td>
            </tr>
            <tr>
                <td><br><br></td>
                <td></td>
                <td></td>
            </tr>

        </table>
    </div>
</div>
    </body>
</html>