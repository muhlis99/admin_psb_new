@extends('utama')
@section('content')
<?php
$admin = DB::table("tb_admin")->where("id", Session::get("id_admin"))->first();
$namaBulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$data = DB::table("tb_person")->where("id_person", $id)->first();
$waktu = explode("-", $data->tgl_lahir_a);
$waktu_i = explode("-", $data->tgl_lahir_i);
?>
<style>
    th{
        font-family: noto;
        font-size:11px;
        padding:8px !important;
    }

    td{
        padding:4px !important;
        font-size:12px;
        font-family: noto;
    }

    label{
        font-family: noto;
        font-size:13px;
    }
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Identitas Orang Tua dari <span class="text-danger"><b><?php echo $data->nama ?></b></span></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Beranda</a></li>
                    <li class="breadcrumb-item active">Data Santri Baru</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <form id="form_biasa" alamat="{{route('simpan3')}}"  rel="simpan" data-parsley-validate="" method="post">
                {{ csrf_field()}}
                <input hidden="" value="<?php echo $id ?>" name="id">
                <input hidden="" value="<?php echo $data->alamat_lengkap ?>" name="alamat_lengkap">
                <div class="card-body pb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <label>NIK AYAH</label>
                            <input data-parsley-length="[16,16]" data-parsley-length-message="harus diisi 16 angka NIK"  value="<?php echo $data->nik_a ?>" autocomplete="off" required="" placeholder="Nik " id="nik" class="form-control form-control-sm" name="nik_a" type="number">
                        </div>
                        <script>
                            $(document).ready(function () {
                                $("#nik").keypress(function (e) {
                                    var charCode = (e.which) ? e.which : e.keyCode;
                                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                        return false;
                                    }
                                });
                            });
                        </script>
                        <div class="col-md-6">
                            <label>NAMA AYAH</label>
                            <input value="<?php echo $data->nm_a ?>" placeholder="Nama Ayah" required="" autocomplete="off" id="nm_a" class="form-control form-control-sm" name="nm_a">
                        </div>
                        <div class="col-md-3">
                            <label>PENDIDIKAN AYAH</label>
                            <select name="pdkn_a" id="pdkn_a" required="" class="form-control form-control-sm">
                                <option value="">-Pilih Pendidikan Ayah-</option>
                                <?php
                                $pndkn = DB::table("tb_psb_pndkn_a")->get();
                                foreach ($pndkn as $pda) {
                                    if ($data->pndkn_a == $pda->pendidikan) {
                                        $pd_a = "selected";
                                    } else {
                                        $pd_a = "";
                                    }
                                    ?>
                                    <option <?php echo $pd_a ?> value="<?php echo $pda->pendidikan ?>"><?php echo $pda->pendidikan ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3 mt-4">
                            <label>PEKERJAAN AYAH</label>
                            <select name="pkrjn_a" id="pkrjn_a" required="" class="form-control form-control-sm">
                                <option value="">-Pilih Pekerjaan Ayah-</option>
                                <?php
                                $prkjn = DB::table("tb_psb_pkrjn_a")->get();
                                foreach ($prkjn as $pka) {
                                    if ($data->pkrjn_a == $pka->pekerjaan) {
                                        $pk_a = "selected";
                                    } else {
                                        $pk_a = "";
                                    }
                                    ?>
                                    <option <?php echo $pk_a ?> value="<?php echo $pka->pekerjaan ?>"><?php echo $pka->pekerjaan ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>TANGGAL LAHIR AYAH</label>
                            <select id="tgl_lahir" name="tanggal_lahir_a" required="" class="form-control form-control-sm">
                                <option value="">-Pilih Tanggal-</option>
                                <?php
                                if ($data->tgl_lahir_a == "2000-01-01") {
                                    ?>
                                    <option selected="" value="">Tanggal</option>
                                    <?php
                                    for ($i = 1; $i < 32; $i++) {
                                        if ($i < 10) {
                                            $tg = "0" . $i;
                                        } else {
                                            $tg = $i;
                                        }
                                        ?>
                                        <option value="<?php echo $tg ?>"><?php echo $tg ?></option>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <option value="">Tanggal</option>       
                                    <?php
                                    for ($i = 1; $i < 32; $i++) {
                                        if ($i < 10) {
                                            $tg = "0" . $i;
                                        } else {
                                            $tg = $i;
                                        }

                                        if ($waktu[2] == $tg) {
                                            ?>
                                            <option selected="" value="<?php echo $tg ?>"><?php echo $tg ?></option>
                                            <?php
                                        } else {
                                            ?>
                                            <option  value="<?php echo $tg ?>"><?php echo $tg ?></option>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>BULAN LAHIR AYAH</label>
                            <select id="bln_lahir" name="bulan_lahir_a" required="" class="form-control form-control-sm">
                                <option value="">-Pilih Bulan-</option>
                                <?php
                                if ($data->tgl_lahir_a == "2000-01-01") {
                                    ?>
                                    <option selected="" value="">Bulan</option>
                                    <?php
                                    for ($i = 1; $i < 13; $i++) {
                                        if ($i < 10) {
                                            $bln = "0" . $i;
                                        } else {
                                            $bln = $i;
                                        }
                                        ?>
                                        <option value="<?php echo $bln ?>"><?php echo $namaBulan[$i] ?></option>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <option  value="">Bulan</option>        
                                    <?php
                                    for ($i = 1; $i < 13; $i++) {
                                        if ($i < 10) {
                                            $bln = "0" . $i;
                                        } else {
                                            $bln = $i;
                                        }

                                        if ($waktu[1] == $bln) {
                                            ?>
                                            <option selected="" value="<?php echo $bln ?>"><?php echo $namaBulan[$i] ?></option>
                                            <?php
                                        } else {
                                            ?>
                                            <option value="<?php echo $bln ?>"><?php echo $namaBulan[$i] ?></option>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>TAHUN LAHIR AYAH</label>
                            <select id="thn_lahir" name="tahun_lahir_a" required="" class="form-control form-control-sm">
                                <option value="">-Pilih Tahun-</option>
                                <?php
                                if ($data->tgl_lahir_a == "2000-01-01") {
                                    for ($th = 1980; $th < date("Y") + 5; $th++) {
                                        ?>
                                        <option value="<?php echo $th ?>"><?php echo $th ?></option>
                                        <?php
                                    }
                                } else {
                                    for ($th = 1980; $th < date("Y") + 5; $th++) {
                                        if ($th == $waktu[0]) {
                                            ?>
                                            <option selected="" value="<?php echo $th ?>"><?php echo $th ?></option>
                                            <?php
                                        } else {
                                            ?>
                                            <option  value="<?php echo $th ?>"><?php echo $th ?></option>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3 mt-4">
                            <label>NIK IBU</label>
                            <input data-parsley-length="[16,16]" data-parsley-length-message="harus diisi 16 angka NIK"  value="<?php echo $data->nik_i ?>" autocomplete="off" required="" placeholder="Nik " id="nik" class="form-control form-control-sm" name="nik_i" type="number">
                        </div>
                        <script>
                            $(document).ready(function () {
                                $("#nik").keypress(function (e) {
                                    var charCode = (e.which) ? e.which : e.keyCode;
                                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                        return false;
                                    }
                                });
                            });
                        </script>
                        <div class="col-md-6">
                            <br>
                            <label>NAMA IBU</label>
                            <input value="<?php echo $data->nm_i ?>" placeholder="Nama Ibu" required="" autocomplete="off" id="nm_i" class="form-control form-control-sm" name="nm_i">
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>PENDIDIKAN IBU</label>
                            <select required="" name="pdkn_i" id="pdkn_i" class="form-control form-control-sm">
                                <option value="">-Pilih Pendidikan Ibu-</option>
                                <?php
                                
                                foreach ($pndkn as $pdi) {
                                    if ($data->pndkn_i == $pdi->pendidikan) {
                                        $pd_i= "selected";
                                    } else {
                                        $pd_i = "";
                                    }
                                    ?>
                                    <option <?php echo $pd_i ?> value="<?php echo $pdi->pendidikan ?>"><?php echo $pdi->pendidikan ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>PEKERJAAN IBU</label>
                            <select name="pkrjn_i" id="pkrjn_i" required="" class="form-control form-control-sm">
                                <option value="">-Pilih Pekerjaan Ibu-</option>
                                <?php
                                //$prkjn=DB::table("tb_psb_pkrjn_a")->get();
                                foreach ($prkjn as $pki) {
                                    if ($data->pkrjn_i == $pki->pekerjaan) {
                                        $pk_i = "selected";
                                    } else {
                                        $pk_i = "";
                                    }
                                    ?>
                                    <option <?php echo $pk_i ?> value="<?php echo $pki->pekerjaan ?>"><?php echo $pki->pekerjaan ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>TANGGAL LAHIR IBU</label>
                            <select id="tgl_lahir" name="tanggal_lahir_i" required="" class="form-control form-control-sm">
                                <option value="">-Pilih Tanggal-</option>
                                <?php
                                if ($data->tgl_lahir_i == "2000-01-01") {
                                    ?>
                                    <option selected="" value="">Tanggal</option>
                                    <?php
                                    for ($i = 1; $i < 32; $i++) {
                                        if ($i < 10) {
                                            $tg = "0" . $i;
                                        } else {
                                            $tg = $i;
                                        }
                                        ?>
                                        <option value="<?php echo $tg ?>"><?php echo $tg ?></option>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <option value="">Tanggal</option>       
                                    <?php
                                    for ($i = 1; $i < 32; $i++) {
                                        if ($i < 10) {
                                            $tg = "0" . $i;
                                        } else {
                                            $tg = $i;
                                        }

                                        if ($waktu_i[2] == $tg) {
                                            ?>
                                            <option selected="" value="<?php echo $tg ?>"><?php echo $tg ?></option>
                                            <?php
                                        } else {
                                            ?>
                                            <option  value="<?php echo $tg ?>"><?php echo $tg ?></option>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>BULAN LAHIR IBU</label>
                            <select id="bln_lahir" name="bulan_lahir_i" required="" class="form-control form-control-sm">
                                <option value="">-Pilih Bulan-</option>
                                <?php
                                if ($data->tgl_lahir_i == "2000-01-01") {
                                    ?>
                                    <option selected="" value="">Bulan</option>
                                    <?php
                                    for ($i = 1; $i < 13; $i++) {
                                        if ($i < 10) {
                                            $bln = "0" . $i;
                                        } else {
                                            $bln = $i;
                                        }
                                        ?>
                                        <option value="<?php echo $bln ?>"><?php echo $namaBulan[$i] ?></option>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <option  value="">Bulan</option>        
                                    <?php
                                    for ($i = 1; $i < 13; $i++) {
                                        if ($i < 10) {
                                            $bln = "0" . $i;
                                        } else {
                                            $bln = $i;
                                        }

                                        if ($waktu_i[1] == $bln) {
                                            ?>
                                            <option selected="" value="<?php echo $bln ?>"><?php echo $namaBulan[$i] ?></option>
                                            <?php
                                        } else {
                                            ?>
                                            <option value="<?php echo $bln ?>"><?php echo $namaBulan[$i] ?></option>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>TAHUN LAHIR IBU</label>
                            <select id="thn_lahir" name="tahun_lahir_i" required="" class="form-control form-control-sm">
                                <option value="">-Pilih Tahun-</option>
                                <?php
                                if ($data->tgl_lahir_i == "2000-01-01") {
                                    for ($th = 1980; $th < date("Y") + 5; $th++) {
                                        ?>
                                        <option value="<?php echo $th ?>"><?php echo $th ?></option>
                                        <?php
                                    }
                                } else {
                                    for ($th = 1980; $th < date("Y") + 5; $th++) {
                                        if ($th == $waktu_i[0]) {
                                            ?>
                                            <option selected="" value="<?php echo $th ?>"><?php echo $th ?></option>
                                            <?php
                                        } else {
                                            ?>
                                            <option  value="<?php echo $th ?>"><?php echo $th ?></option>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-4">
                            <?php
                            if($st=="sm"){
                                ?>
                            <button id="bt_batal" type="button" class="btn btn-danger ">
                                <i class="fas fa-times"></i>
                                Batal
                            </button>
                                <?php
                            }else{
                                ?>
                                <button id="bt_back" type="button" class="btn btn-danger ">
                                    <i class="fas fa-reply"></i>
                                    Kembali Ke Santri Baru
                                </button>
                                    <?php
                            }
                            ?>
                            <a href="">
                                <button type="button" class="btn btn-warning ">
                                    <i class="fas fa-sync"></i>
                                    Refresh
                                </button>
                            </a>
                        </div>
                        <div class="col-md-8">
                            <button type="submit" style="float:right" class="btn btn-info ">
                                Simpan dan Lanjut
                                <i class="fas fa-arrow-right"></i>
                            </button>
                            <button id="bt_kembali" style="float:right;" type="button" class="btn btn-info mr-2">
                                <i class="fas fa-arrow-left"></i>
                                Kembali
                            </button>
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<input hidden="" id="id_person" value="<?php echo $id ?>">
<script>
    $(document).ready(function () {
        $('#provinsi').select2({
            theme: 'bootstrap4'
        });
        $('#kabupaten').select2({
            theme: 'bootstrap4'
        });
        $('#kecamatan').select2({
            theme: 'bootstrap4'
        });
        $('#desa').select2({
            theme: 'bootstrap4'
        });
        
        $("#bt_back").click(function () {
           window.location.href="{{url('offline')}}"; 
        });
        
        $("#bt_kembali").click(function () {
            window.location.href = "{{url('offline1')}}/<?php echo $id ?>/<?php echo $st?>";
        });

        $("#bt_batal").click(function () {
            var id = $("#id_person").val();
            swal({
                title: 'Anda yakin untuk Membatalkan?',
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
                $("#loading").css("display", "block");
                $.ajax({
                    type: 'POST',
                    url: "{{route('batal')}}",
                    data: {
                        "_token": "{{csrf_token()}}",
                        "id": id
                    },
                    success: function (hasil) {
                        $("#loading").css("display", "none");
                        if (hasil == 1) {
                            swal({
                                title: 'Sukses Dibatalkan',
                                text: '',
                                type: 'success'
                            }).then(function () {
                                window.location.href = "{{url('offline')}}";
                            });

                        } else {

                        }
                    }
                })
            });
        });

        $("#form_biasa").on('submit', function (e) {
            e.preventDefault();
            var kem = $(this).attr("kem");
            var url = $(this).attr("alamat");
            var form = $(this);
            var data = $(this).serialize();
            form.parsley().validate();
            if (form.parsley().isValid()) {
                $("#loading").css("display", "block");
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    success: function (hasil) {
                        $("#loading").css("display", "none");
                        if (hasil == 'N') {
                            swal({
                                title: 'Gagal',
                                text: '',
                                type: 'error'
                            }).then(function () {

                            });
                        } else {
                            window.location.href = "{{url('offline3')}}/" + hasil+"/<?php echo $st?>";
                        }
                    }
                });

            }
        });
    });
</script>
@endsection

