@extends('utama')
@section('content')
<?php
$admin = DB::table("tb_admin")->where("id", Session::get("id_admin"))->first();
$namaBulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$data = DB::table("tb_person")->where("id_person", $id)->first();
$waktu = explode("-", $data->tanggal_lahir);
if ($data->kab == "") {
    $kab = "0";
} else {
    $kab = $data->kab;
}

if ($data->prov == "") {
    $prov = "0";
} else {
    $prov = $data->prov;
}

if ($data->kec == "") {
    $kec = "0";
} else {
    $kec = $data->kec;
}

if ($data->desa == "") {
    $des = "0";
} else {
    $des = $data->desa;
}
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
<input hidden="" value="<?php echo $prov ?>" id="prov">
<input hidden="" value="<?php echo $kab ?>" id="kab">
<input hidden="" value="<?php echo $kec ?>" id="kec">
<input hidden="" value="<?php echo $des ?>" id="des">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Identitas Diri <?php
                
                if($st=="ed"){
                    ?>
                    Ananda <b class="text-danger"><?php echo $data->nama ?></b>
                    <?php
                }
                ?></h1>
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
            <form id="form_biasa" alamat="{{route('simpan2')}}"  rel="simpan" data-parsley-validate="" method="post">
                {{ csrf_field()}}
                <input hidden="" value="<?php echo $id ?>" name="id">
                <div class="card-body pb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <label>NIK SANTRI</label>
                            <input data-parsley-length="[16,16]" data-parsley-length-message="harus diisi 16 angka NIK"  value="<?php echo $data->nik ?>" autocomplete="off" required="" placeholder="Nik " id="nik" class="form-control form-control-sm" name="nik">
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
                        <div class="col-md-9">
                            <label>NAMA</label>
                            <input value="<?php echo $data->nama ?>" placeholder="Nama" required="" autocomplete="off" id="nama" class="form-control form-control-sm" name="nama">
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>TEMPAT LAHIR</label>
                            <input value="<?php echo $data->tempat_lahir ?>" autocomplete="off" required="" placeholder="Tempat Lahir" id="tempat_lahir" class="form-control form-control-sm" name="tempat_lahir">
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>TANGGAL LAHIR</label>
                            <select id="tgl_lahir" name="tgl_lahir" required="" class="form-control form-control-sm">
                                <option value="">-Pilih Tanggal-</option>
                                <?php
                                if ($data->tanggal_lahir == "2000-01-01") {
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
                            <label>BULAN LAHIR</label>
                            <select id="bln_lahir" name="bln_lahir" required="" class="form-control form-control-sm">
                                <option value="">-Pilih Bulan-</option>
                                <?php
                                if ($data->tanggal_lahir == "2000-01-01") {
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
                            <label>TAHUN LAHIR</label>
                            <select id="thn_lahir" name="thn_lahir" required="" class="form-control form-control-sm">
                                <option value="">-Pilih Tahun-</option>
                                <?php
                                if ($data->tanggal_lahir == "2000-01-01") {
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
                        <div class="col-md-3">
                            <br>
                            <?php
                            $k1="";$k2="";$k3="";
                            if ($data->jenis_kelamin == "0") {
                                $k1 = "selected";
                                $k2 = "";
                                $k3 = "";
                            } else if ($data->jenis_kelamin == "Laki-Laki") {
                                $k1 = "";
                                $k2 = "selected";
                                $k3 = "";
                            } else if ($data->jenis_kelamin == "Perempuan") {
                                $k1 = "";
                                $k2 = "";
                                $k3 = "selected";
                            }
                            ?>
                            <label>Jenis Kelamin</label>
                            <select id="jk" name="jk" required="" class="form-control form-control-sm">
                                <option <?php echo $k1 ?> value="">-Pilih Jenis Kelamin-</option>
                                <option <?php echo $k2 ?> value="Laki-Laki">Laki-laki</option>
                                <option <?php echo $k3 ?> value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <?php
                            if ($data->dlm_klrg == "") {
                                $kosong = "selected";
                                $kandung = "";
                                $tiri = "";
                                $angkat = "";
                            } else if ($data->dlm_klrg == "Kandung") {
                                $kosong = "";
                                $kandung = "selected";
                                $tiri = "";
                                $angkat = "";
                            } else if ($data->dlm_klrg == "Tiri") {
                                $kosong = "";
                                $kandung = "";
                                $tiri = "selected";
                                $angkat = "";
                            } else if ($data->dlm_klrg == "Angkat") {
                                $kosong = "";
                                $kandung = "";
                                $tiri = "";
                                $angkat = "selected";
                            }
                            ?>
                            <label>STATUS ANAK</label>
                            <select required="" name="status_anak" class="form-control form-control-sm">
                                <option <?php echo $kosong ?> value="">-Pilih Status-</option>
                                <option <?php echo $kandung ?> value="Kandung">Anak Kandung</option>
                                <option <?php echo $tiri ?> value="Tiri">Anak Tiri</option>
                                <option <?php echo $angkat ?> value="Angkat">Anak Angkat</option>

                            </select>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>ANAK KE</label>
                            <input value="<?php echo $data->ank_ke ?>" placeholder="isi dengan angka" autocomplete="off" type="number"  required="" class="form-control form-control-sm" name="ank_ke">
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>JUMLAH SAUDARA</label>
                            <input value="<?php echo $data->sdr ?>" type="number" placeholder="isi dengan angka" autocomplete="off"  required="" class="form-control form-control-sm" name="sdr">
                        </div>
                        <div class="col-md-9">
                            <br>
                            <label>ALAMAT LENGKAP SESUAI KTP</label>
                            <textarea name="alamat" id="alamat" required="" class="form-control form-control-sm">
                                <?php
                                echo $data->alamat_lengkap;
                                ?>
                            </textarea>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>KODE POS</label>
                            <input value="<?php echo $data->pos?>" type="number" placeholder="isi dengan angka" autocomplete="off"  required="" class="form-control form-control-sm" name="kodepos">
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>Provinsi</label>
                            <select id="provinsi" class="form-control form-control-sm" name="provinsi" required="">
                                <option value="">-Pilih Provinsi-</option>
                                <?php
                                $provinsi = DB::table("provinsi")->get();
                                foreach ($provinsi as $pr) {
                                    if($data->prov!=""){
                                            if($data->prov==$pr->id){
                                                $prov="selected";
                                            }else{
                                                $prov="";
                                            }
                                        }else{
                                            $prov="";
                                        }
                                    ?>
                                    <option <?php echo $prov ?> value="<?php echo $pr->id ?>"><?php echo $pr->name ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <script>
                            $(document).ready(function () {
                                var prov = $("#prov").val();
                                var kab = $("#kab").val();
                                $.ajax({
                                    type: 'POST',
                                    url: '{{route("ambil_kab")}}',
                                    data: {
                                        "_token": "{{csrf_token()}}",
                                        "id": prov,
                                        "kab": kab
                                    },
                                    success: function (data) {
                                        $("#loading").css("display", "none");
                                        $("#kabupaten").html("");
                                        $("#kabupaten").append(data);
                                    }
                                });
                                $("#provinsi").change(function () {
                                    var idprovinsi = $(this).val();
                                    $("#loading").css("display", "block");
                                    $.ajax({
                                        type: 'POST',
                                        url: '{{route("ambil_kab")}}',
                                        data: {
                                            "_token": "{{csrf_token()}}",
                                            "id": idprovinsi,
                                            "kab": "0"
                                        },
                                        success: function (data) {
                                            $("#loading").css("display", "none");
                                            $("#kabupaten").html("");
                                            $("#kabupaten").append(data);
                                            $("#kecamatan").html("");
                                            $("#kecamatan").append("<option value=''>-Pilih Kecamatan-</option>");
                                            $("#desa").html("");
                                            $("#desa").append("<option value=''>-Pilih Desa-</option>");
                                        }
                                    });
                                });
                            });

                        </script>
                        <div class="col-md-3">
                            <br>
                            <label>Kabupaten</label>
                            <select id="kabupaten" class="form-control form-control-sm" name="kabupaten" required="">
                                <option value="">-Pilih Kabupaten-</option>

                            </select>
                        </div>
                        <script>
                            $(document).ready(function () {
                                var kabu = $("#kab").val();
                                var keca = $("#kec").val();
                                $.ajax({
                                    type: 'POST',
                                    url: '{{route("ambil_kec")}}',
                                    data: {
                                        "_token": "{{csrf_token()}}",
                                        "id": kabu,
                                        "kec": keca
                                    },
                                    success: function (data) {
                                        $("#loading").css("display", "none");
                                        $("#kecamatan").html("");
                                        $("#kecamatan").append(data);
                                    }
                                });
                                $("#kabupaten").change(function () {
                                    var id = $(this).val();
                                    $("#loading").css("display", "block");
                                    $.ajax({
                                        type: 'POST',
                                        url: '{{route("ambil_kec")}}',
                                        data: {
                                            "_token": "{{csrf_token()}}",
                                            "id": id,
                                            "kec": "0"
                                        },
                                        success: function (data) {
                                            $("#loading").css("display", "none");
                                            $("#kecamatan").html("");
                                            $("#kecamatan").append(data);
                                            $("#desa").html("");
                                            $("#desa").append("<option value=''>-Pilih Desa-</option>");
                                        }
                                    });
                                });
                            })
                        </script>
                        <div class="col-md-3">
                            <br>
                            <label>Kecamatan</label>
                            <select id="kecamatan" class="form-control form-control-sm" name="kecamatan" required="">
                                <option value="">-Pilih Kecamatan-</option>

                            </select>
                        </div>
                        <script>
                            $(document).ready(function () {
                                var kec = $("#kec").val();
                                var des= $("#des").val();
                                $.ajax({
                                    type: 'POST',
                                    url: '{{route("ambil_desa")}}',
                                    data: {
                                        "_token": "{{csrf_token()}}",
                                        "id": kec,
                                        "desa":des
                                    },
                                    success: function (data) {
                                        $("#loading").css("display", "none");
                                        $("#desa").html("");
                                        $("#desa").append(data);
                                    }
                                });
                                $("#kecamatan").change(function () {
                                    var id = $(this).val();
                                    $("#loading").css("display", "block");
                                    $.ajax({
                                        type: 'POST',
                                        url: '{{route("ambil_desa")}}',
                                        data: {
                                            "_token": "{{csrf_token()}}",
                                            "id": id,
                                            "desa": "0"
                                        },
                                        success: function (data) {
                                            $("#loading").css("display", "none");
                                            $("#desa").html("");
                                            $("#desa").append(data);
                                        }
                                    });
                                });
                            })
                        </script>
                        <div class="col-md-3">
                            <br>
                            <label>Desa</label>
                            <select id="desa" class="form-control form-control-sm" name="desa" required="">
                                <option value="">-Pilih Desa-</option>

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

        $("#bt_batal").click(function () {
            var id=$("#id_person").val();
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
                    url:"{{route('batal')}}",
                    data:{
                        "_token": "{{csrf_token()}}",
                        "id":id
                    },
                    success: function (hasil) {
                        $("#loading").css("display", "none");
                        if(hasil==1){
                            swal({
                                title: 'Sukses Dibatalkan',
                                text: '',
                                type: 'success'
                            }).then(function () {
                                window.location.href="{{url('offline')}}";
                            });
                            
                        }else{
                            
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
                            window.location.href = "{{url('offline2')}}/" + hasil+"/<?php echo $st?>";
                        }
                    }
                });

            }
        });
    });
</script>
@endsection

