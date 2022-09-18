@extends('utama')
@section('content')
<?php
$admin = DB::table("tb_admin")->where("id", Session::get("id_admin"))->first();
$cek_1 = DB::table("tb_psb")->where("no_regristrasi", $id)->count();
if ($cek_1 > 0) {
    $data = DB::table("tb_psb")->where("no_regristrasi", $id)->first();
    $cek_2 = DB::table("tb_person")->where("nik", $data->nik)->count();
    $desa_al = DB::table("desa")->where("id", $data->desa)->first();
    $kec_al = DB::table("kecamatan")->where("id", $data->kec)->first();
    $kab_al = DB::table("kabupaten")->where("id", $data->kab)->first();
    $prov_al = DB::table("provinsi")->where("id", $data->prov)->first();

    $desa_w = DB::table("desa")->where("id", $data->des_w)->first();
    $kec_w = DB::table("kecamatan")->where("id", $data->kec_w)->first();
    $kab_w = DB::table("kabupaten")->where("id", $data->kab_w)->first();
    $prov_w = DB::table("provinsi")->where("id", $data->prov_w)->first();
    if ($cek_2 == 0) {
        ?>
        <style>
            th{
                font-family: noto;
                font-size:11px;
                padding:8px !important;
            }

            td{
                padding:4px !important;
                font-size:14px;
                font-family: noto;
            }

            #tb_identitas tbody tr td{
                border-color: white !important;
                padding: 2px;
            }
            label{
                font-family: noto;
                font-size:14px;
            }
        </style>
        <input hidden="" id="no_regristrasi" value="<?php echo $id ?>">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                </div><!-- /.row -->
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <?php
                        if ($o == "2" ) {
                            ?>
                            <a  href="{{ url("terima_qrcode") }}">
                                <button class="btn btn-danger">
                                    <i class="fas fa-reply"></i>
                                    Kembali
                                </button>
                            </a>
                            <?php 
                        } else {
                            ?>
                            <a  href="{{ url("terima") }}">
                                <button class="btn btn-danger">
                                    <i class="fas fa-reply"></i>
                                    Kembali
                                </button>
                            </a>
                            <?php
                        }
                            
                        ?>
                        
                    </div>
                    <div class="card-body mb-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <h5 style="margin:0" class="mb-2"><b>IDENTITAS SANTRI</b></h5>
                                        <hr style="line-height:9;margin:0;">
                                    </div>
                                    <div class="col-md-6">
                                        <table>
                                            <tr>
                                                <td>NIK</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->nik ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>NAMA</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->nama ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>TEMPAT,TANGGAL LAHIR</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->tempat_lahir . "," . $data->tanggal_lahir ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>JENIS KELAMIN</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->jenis_kelamin ?></b></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table>
                                            <tr>
                                                <td>STATUS KELUARGA</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->dlm_klrg ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>ANAK KE-</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->ank_ke ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>JUMLAH SAUDARA</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->sdr ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>TANGGAL DAFTAR</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->tgl_daftar ?></b></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-12 mt-4 mb-2">
                                        <h5 style="margin:0;" class="mb-2"><b>DESKRIPSI ALAMAT</b></h5>
                                        <hr style="line-height:9;margin:0;">
                                    </div>
                                    <div class="col-md-6">
                                        <table>
                                            <tr>
                                                <td>PROVINSI</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $prov_al->name ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>KABUPATEN</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $kab_al->name ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>KECAMATAN</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $kec_al->name ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>DESA</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $desa_al->name ?></b></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table>
                                            <tr>
                                                <td>DETAIL ALAMAT</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->alamat_lengkap ?></b></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-12 mt-4 mb-2">
                                        <h5 style="margin:0;" class="mb-2"><b>IDENTITAS ORANG TUA</b></h5>
                                        <hr style="line-height:9;margin:0;">
                                    </div>
                                    <div class="col-md-6">
                                        <table>
                                            <tr>
                                                <td>NAMA AYAH</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->nm_a ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>PENDIDIKAN AYAH</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->pndkn_a ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>PEKERJAAN AYAH</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->pkrjn_a ?></b></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table>
                                            <tr>
                                                <td>NAMA IBU</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->nm_i ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>PENDIDIKAN IBU</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->pndkn_i ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>PEKERJAAN IBU</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->pkrjn_i ?></b></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-12 mt-4 mb-2">
                                        <h5 style="margin:0;" class="mb-2"><b>IDENTITAS WALI</b></h5>
                                        <hr style="line-height:9;margin:0;">
                                    </div>
                                    <div class="col-md-6">
                                        <table>
                                            <tr>
                                                <td>NAMA WALI</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->nm_w ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>PENDIDIKAN WALI</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->pndkn_w ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>PEKERJAAN WALI</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->pkrjn_w ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>PENDAPATAN WALI</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->pndptn_w ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>NO HP/WA WALI</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->hp_w ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>NO TELP WALI</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->telp_w ?></b></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table>
                                            <tr>
                                                <td>DETAIL ALAMAT WALI</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $data->almt_w ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>PROVINSI</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $prov_w->name ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>KABUPATEN</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $kab_w->name ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>KECAMATAN</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $kec_w->name ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>DESA</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><b><?php echo $desa_w->name ?></b></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="card">
                    <div class="card-header">
                        <h5><b>DATA MAHROM</b></h5>
                    </div>
                    <div class="card-body">
                        <div class="col-md-9">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:1%">NO</th>
                                        <th>STATUS MAHROM</th>
                                        <th>NAMA MAHROM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $mahrom = DB::table("tb_psb_mahrom")->where("token", $data->token)->get();
                                    $no = 1;
                                    foreach ($mahrom as $mr) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no ?></td>
                                            <td><?php echo $mr->status ?></td>
                                            <td><?php echo $mr->nama ?></td>
                                        </tr>
                                        <?php
                                        $no++;
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}
                <div class="card">
                    <div class="card-header">
                        <h5><b>DOKUMEN SANTRI</b></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>FOTO SANTRI</label>
                                <?php
                                if ($data->foto_warna_santri != "") {
                                    ?>
                                    <button jud="FOTO SANTRI" foto="<?php echo asset($data->foto_warna_santri) ?>" class="bt_detail btn btn-info btn-sm btn-block mb-2">Detail</button>
                                    <img class="img-thumbnail img-fluid" src="<?php echo asset($data->foto_warna_santri) ?>">
                                    <?php
                                } else {
                                    echo "<br>File Tidak Ada";
                                }
                                ?>

                            </div>
                            <div class="col-md-4">
                                <label>FOTO WALI SANTRI</label>
                                <?php
                                if ($data->foto_wali_santri_warna != "") {
                                    ?>
                                    <button jud="FOTO WALI SANTRI" foto="<?php echo asset($data->foto_wali_santri_warna) ?>" class="bt_detail btn btn-info btn-sm btn-block mb-2">Detail</button>
                                    <img class="img-thumbnail img-fluid" src="<?php echo asset($data->foto_wali_santri_warna) ?>">
                                    <?php
                                } else {
                                    echo "<br>File Tidak Ada";
                                }
                                ?>
                            </div>
                            <div class="col-md-4">
                                <label>SCAN AKTA</label>
                                <?php
                                if ($data->foto_scan_akta != "") {
                                    ?>
                                    <button jud="SCAN AKTA" foto="<?php echo asset($data->foto_scan_akta) ?>" class="bt_detail btn btn-info btn-sm btn-block mb-2">Detail</button>
                                    <img class="img-thumbnail img-fluid" src="<?php echo asset($data->foto_scan_akta) ?>">
                                    <?php
                                } else {
                                    echo "<br>File Tidak Ada";
                                }
                                ?>
                            </div>
                            <div class="col-md-4 mt-4">
                                <label>SCAN KARTU KELUARGA</label>
                                <?php
                                if ($data->foto_scan_kk != "") {
                                    ?>
                                    <button jud="SCAN KARTU KELUARGA" foto="<?php echo asset($data->foto_scan_kk) ?>" class="bt_detail btn btn-info btn-sm btn-block mb-2">Detail</button>
                                    <img class="img-thumbnail img-fluid" src="<?php echo asset($data->foto_scan_kk) ?>">
                                    <?php
                                } else {
                                    echo "<br>File Tidak Ada";
                                }
                                ?>
                            </div>
                            <div class="col-md-4 mt-4">
                                <label>SCAN SKCK</label>
                                <?php
                                if ($data->foto_scan_skck != "") {
                                    ?>
                                    <button jud="SCAN SKCK"  foto="<?php echo asset($data->foto_scan_skck) ?>" class="bt_detail btn btn-info btn-sm btn-block mb-2">Detail</button>
                                    <img class="img-thumbnail img-fluid" src="<?php echo asset($data->foto_scan_skck) ?>">
                                    <?php
                                } else {
                                    echo "<br>File Tidak Ada";
                                }
                                ?>

                            </div>
                            <div class="col-md-4 mt-4">
                                <label>SCAN SURAT </label>
                                <?php
                                if ($data->foto_scan_ket_sehat != "") {
                                    ?>
                                    <button jud="SCAN SURAT KESEHATAN" foto="<?php echo asset($data->foto_scan_ket_sehat) ?>" class="bt_detail btn btn-info btn-sm btn-block mb-2">Detail</button>
                                    <img class="img-thumbnail" src="<?php echo asset($data->foto_scan_ket_sehat) ?>">
                                    <?php
                                } else {
                                    echo "<br>File Tidak Ada";
                                }
                                ?>

                            </div>
                            <div class="col-md-12 mt-5">
                                <hr>
                                <?php 
                                if ($o == "3") {
                                    ?>
                                    <button id="bt_terima" class="btn btn-success bt_terima">
                                        <i class="fas fa-check"></i>
                                        TERIMA
                                    </button>
                                    <?php
                                }else{
                                    ?>
                                    <button id="bt_terima2" class="btn btn-success bt_terima">
                                        <i class="fas fa-check"></i>
                                        TERIMA
                                    </button>
                                    <?php
                                }
                                ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div id="md_tambah"  class="modal fade" id="modal-default">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title judul_detail"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <img style="width:100%;" class="img-fluid" id="gmbr_detail" src="">
                            </div>
                            <div class="col-md-4">
                                <a href="" id="img_download" download="">
                                    <button class="btn btn-info">DOWNLOAD</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <script>
            $(document).ready(function () {
                $('#table').on("click", ".bt_edit", function () {
                    var id = $(this).attr("id");
                    window.location.href = "{{url('offline1')}}/" + id + "/ed";
                });

                $("#bt_terima").click(function () {
                    var no = $("#no_regristrasi").val();
                    swal({
                        title: 'Pastikan Data telah lengkap!',
                        text: "Apakah Anda Yakin Data Sudah Lengkap ? ",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#28a745',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'YA, SUDAH',
                        cancelButtonText: 'BELUM',
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: true
                    }).then(function () {
                        $("#loading").css("display", "block");
                        $.ajax({
                            type: 'POST',
                            url: "{{route('terima_simpan')}}",
                            data: {
                                "_token": "{{csrf_token()}}",
                                "no": no
                            },
                            success: function (hasil) {
                                if (hasil !="N") {
                                    $("#loading").css("display", "none");
                                    swal({
                                        title: 'Data Berhasil Terverifikasi',
                                        text: '',
                                        type: 'success'
                                    }).then(function () {
                                        window.location.href = "{{url('print_daftar')}}/"+hasil+"/3";
                                    });
                                }else{
                                   $("#loading").css("display", "none");
                                   swal({
                                        title: 'GAGAL',
                                        text: '',
                                        type: 'error'
                                    }).then(function () {
                                        window.location.href = "";
                                    }); 
                                }
                            }
                        });
                    });

                });

                $("#bt_terima2").click(function () {
                    var no = $("#no_regristrasi").val();
                    swal({
                        title: 'Pastikan Data telah lengkap!',
                        text: "Apakah Anda Yakin Data Sudah Lengkap ? ",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#28a745',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'YA, SUDAH',
                        cancelButtonText: 'BELUM',
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: true
                    }).then(function () {
                        $("#loading").css("display", "block");
                        $.ajax({
                            type: 'POST',
                            url: "{{route('terima_simpan')}}",
                            data: {
                                "_token": "{{csrf_token()}}",
                                "no": no
                            },
                            success: function (hasil) {
                                if (hasil !="N") {
                                    $("#loading").css("display", "none");
                                    swal({
                                        title: 'Data Berhasil Terverifikasi',
                                        text: '',
                                        type: 'success'
                                    }).then(function () {
                                        window.location.href = "{{url('print_daftar')}}/"+hasil+"/2";
                                    });
                                }else{
                                   $("#loading").css("display", "none");
                                   swal({
                                        title: 'GAGAL',
                                        text: '',
                                        type: 'error'
                                    }).then(function () {
                                        window.location.href = "";
                                    }); 
                                }
                            }
                        });
                    });

                });

                $("#bt_tambah").click(function () {
                    $("#loading").css("display", "block");
                    $.ajax({
                        type: 'POST',
                        url: "{{route('simpan1')}}",
                        data: {
                            "_token": "{{csrf_token()}}",
                        },
                        success: function (hasil) {
                            $("#loading").css("display", "none");
                            window.location.href = "{{url('offline1')}}/" + hasil + "/sm";
                        }
                    });
                });
                $('#table').on("click", ".bt_upload", function () {
                    var id = $(this).attr("id");
                    window.location.href = "{{url('upload')}}/" + id;
                });

                $(".bt_detail").click(function () {
                    var foto = $(this).attr("foto");
                    var judul = $(this).attr("jud");
                    $("#gmbr_detail").attr("src", foto);
                    $("#img_download").attr("href", foto);
                    //alert(foto);
                    $(".judul_detail").html(judul);
                    $("#md_tambah").modal({backdrop: 'static', keyboard: false});
                });
            });
        </script>
        <?php
    }
}
?>
@endsection




