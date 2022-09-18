<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SURAT PERNYATAAN SANTRI</title>
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
        <div style=" height: 1450px; font-size: 19px; font-family: 'Arial';">
            <h1>SURAT PERNYATAAN SANTRI</h1><br>
            <p>Yang bertanda tangan di bawah ini, saya :</p><br>
            <table>
                <tr>
                    <td>Nama Lengkap </td>
                    <td> : <?= $data->nama ?></td>
                </tr>
                <tr>
                    <td>Alamat </td>
                    <td> : <?= $data->alamat_lengkap ?></td>
                </tr>
                <tr>
                    <td>Desa </td>
                    <td> : <?= $desa_al->name?></td>
                </tr>
                <tr>
                    <td>Kecamatan </td>
                    <td> : <?= $kec_al->name ?></td>
                </tr>
                <tr>
                    <td>Kabupaten </td>
                    <td> : <?= $kab_al->name?></td>
                </tr>
                <tr>
                    <td>Provinsi </td>
                    <td> : <?= $prov_al->name ?></td>
                </tr>
                <tr>
                    <td>NO HP </td>
                    <td> : <?= $data->hp_w?></td>
                </tr>
                <tr>
                    <td>NO Telp </td>
                    <td> : <?= $data->telp_w?></td>
                </tr>
            </table><br>
            <p>Menyatakan Dengan Sesungguhnya, Bahwa Saya : </p><br>

            <ul>
                <li>Menjalankan perintah agama islam secara murni dan penuh tanggung jawab</li>
                <li>Taat dan patuh pada seluruh undang undang negara RI secara konsekuen</li>
                <li>Taat dan patuh pada peraturan / Tata Tertib PPNAA</li>
                <li>Taat dan patuh pada pengasuh, dewan pengasuh, pengurus dan dewan asatidz PPNAA</li>
                <li>Menerima dan menyadari manakala saya diberi sanksi atas pelanggaran yang saya lakukan</li>
                <li>Mengikuti seluruh program PPNAA</li>
                <li>Mengikuti seluruh program MAKTAB NUBDZATUL BAYAN PPNAA</li>
                <li>Mengikuti seluruh program kegiatan Non Formal pada setiap jenjang pendidikan yang ada di PPNAA</li>
            </ul><br>
            <p style="font-size: 19px; font-family: 'Times New Roman', Times, serif; text-align: justify;">Demikian pernyataan ini saya buat dengan sadar, sungguh sungguh dan penuh tanggung jawab, jika kemudian hari ternyata saya tidak memenuhi pernyataan yang saya buat ini,
                maka saya bersedia dituntut sesuai dengan ketentuan yang berlaku.</p><br>
            <div class="float-right">
                Banyuwangi, <?= date('d-m-Y'); ?> <p>Yang Membuat pernyataan,</p><br><br><br>
                <hr style="width: 200px;">
                <p>Santri</p>
            </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <span>Keterangan :</span>
            <ul>
                <li>PPNAA : Pondok Pesantren Nurul Abror Al Robbaniyin.</li>
                <li>MAKTAB NUBDZATUL BAYAN : Program wajib untuk seluruh santri, yakni program akselerasi baca kitab kuning yang disingkat menjadi MAKTUBA.</li>
            </ul>
        </div>
    </body>
</html>