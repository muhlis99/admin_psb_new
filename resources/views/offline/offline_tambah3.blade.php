@extends('utama')
@section('content')
<?php
$admin = DB::table("tb_admin")->where("id", Session::get("id_admin"))->first();
$namaBulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$data = DB::table("tb_person")->where("id_person", $id)->first();
if ($data->kab_w == "") {
    $kab = "0";
} else {
    $kab = $data->kab_w;
}

if ($data->prov_w == "") {
    $prov = "0";
} else {
    $prov = $data->prov_w;
}

if ($data->kec_w == "") {
    $kec = "0";
} else {
    $kec = $data->kec_w;
}

if ($data->desa_w == "") {
    $des = "0";
} else {
    $des = $data->desa_w;
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
                <h1 class="m-0">Identitas Wali dari <span class="text-danger"><b><?php echo $data->nama ?></b></span></h1>
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
           
            <form id="form_biasa" alamat="{{route('simpan4')}}"  rel="simpan" data-parsley-validate="" method="post">
                {{ csrf_field()}}
                <input hidden="" value="<?php echo $id ?>" name="id">
                <div class="card-header">
                    <div class="row">
                      
                        <div class="col-md-8">
                            <button type="button" class="btn btn-primary" onclick="wali_ayah()">
                                <i class="fas fa-user-minus"></i>
                                WALI BERUPA AYAH
                            </button>
                            <button type="button" class="btn btn-success" onclick="wali_ibu()">
                                <i class="fas fa-user-plus"></i>
                                WALI BERUPA IBU
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <label>NIK WALI</label>
                            <input data-parsley-length="[16,16]" data-parsley-length-message="harus diisi 16 angka NIK"  value="<?php echo $data->nik_w ?>" autocomplete="off" required="" placeholder="Nik " id="nik" class="form-control form-control-sm" name="nik_w" type="number">
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
                        <div class="col-md-3">
                            <label>NAMA WALI</label>
                            <input value="<?php echo $data->nm_w ?>" placeholder="Nama Ayah" required="" autocomplete="off" id="nm_w" class="form-control form-control-sm" name="nm_w">
                        </div>
                        <div class="col-md-3">
                            <label>PENDIDIKAN WALI</label>
                            <select name="pdkn_w" id="pdkn_w" required="" class="form-control form-control-sm">
                                <option value="">-Pilih Pendidikan Wali-</option>
                                <?php
                                $pndkn = DB::table("tb_psb_pndkn_a")->get();
                                foreach ($pndkn as $pda) {
                                    if ($data->pndkn_w == $pda->pendidikan) {
                                        $pd_w = "selected";
                                    } else {
                                        $pd_w = "";
                                    }
                                    ?>
                                    <option <?php echo $pd_w ?> value="<?php echo $pda->pendidikan ?>"><?php echo $pda->pendidikan ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>PEKERJAAN WALI</label>
                            <select name="pkrjn_w" id="pkrjn_w" required="" class="form-control form-control-sm">
                                <option value="">-Pilih Pekerjaan Wali-</option>
                                <?php
                                $prkjn = DB::table("tb_psb_pkrjn_a")->get();
                                foreach ($prkjn as $pka) {
                                    if ($data->pkrjn_w == $pka->pekerjaan) {
                                        $pk_w = "selected";
                                    } else {
                                        $pk_w = "";
                                    }
                                    ?>
                                    <option <?php echo $pk_w ?> value="<?php echo $pka->pekerjaan ?>"><?php echo $pka->pekerjaan ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>NO HP WALI</label>
                            <input data-parsley-length="[12,12]" data-parsley-length-message="harus diisi 12 angka NO HP" value="<?php echo $data->hp_w ?>" id="no_hp" type="number" placeholder="isi dengan angka" autocomplete="off"  required="" class="form-control form-control-sm" name="nohp">
                            <script>
                                $(document).ready(function () {
                                    $("#no_hp").keypress(function (e) {
                                        var charCode = (e.which) ? e.which : e.keyCode;
                                        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                            return false;
                                        }
                                    });
                                });
                            </script>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>NO TELP WALI</label>
                            <input data-parsley-length="[12,12]" data-parsley-length-message="harus diisi 12 angka NO TELP" id="no_tlp" value="<?php echo $data->telp_w ?>" type="number" placeholder="isi dengan angka" autocomplete="off"  required="" class="form-control form-control-sm" name="notelp">
                            <script>
                                $(document).ready(function () {
                                    $("#no_tlp").keypress(function (e) {
                                        var charCode = (e.which) ? e.which : e.keyCode;
                                        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                            return false;
                                        }
                                    });
                                });
                            </script>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>KODE POS</label>
                            <input id="pos" value="<?php echo $data->pos_w ?>" type="number" placeholder="isi dengan angka" autocomplete="off"  required="" class="form-control form-control-sm" name="kodepos">
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>Pendapatan Wali</label>
                            <select name="pndptn_w" id="pndptn_w" required="" class="form-control form-control-sm">
                                <?php
                                if ($data->pndptn_w != "") {
                                    if ($data->pndptn_w == "tinggi") {
                                        $tinggi = "selected";
                                        $sedang = "";
                                        $rendah = "";
                                    } else if ($data->pndptn_w == "sedang") {
                                        $tinggi = "";
                                        $sedang = "selected";
                                        $rendah = "";
                                    } else if ($data->pndptn_w == "rendah") {
                                        $tinggi = "";
                                        $sedang = "";
                                        $rendah = "selected";
                                    }
                                } else {
                                    $tinggi = "";
                                    $sedang = "";
                                    $rendah = "";
                                }
                                ?>
                                <option value="">-Pendapatan Wali-</option>
                                <option <?php echo $tinggi ?> value="tinggi">Tinggi</option>
                                <option <?php echo $sedang ?>  value="sedang">Sedang</option>
                                <option <?php echo $rendah ?>  value="rendah">Rendah</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <label>ALAMAT WALI LENGKAP SESUAI KTP</label>
                            <textarea name="alamat" id="alamat" required="" class="form-control form-control-sm">
                                <?php
                                echo $data->almt_w;
                                ?>
                            </textarea>
                        </div>

                        <div class="col-md-3">
                            <br>
                            <label>Provinsi</label>
                            <select id="provinsi" class="form-control form-control-sm" name="provinsi" required="">
                                <option value="">-Pilih Provinsi-</option>
                                <?php
                                $provinsi = DB::table("provinsi")->get();
                                foreach ($provinsi as $pr) {
                                    if ($data->prov != "") {
                                        if ($data->prov_w == $pr->id) {
                                            $prov = "selected";
                                        } else {
                                            $prov = "";
                                        }
                                    } else {
                                        $prov = "";
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
                                var des = $("#des").val();
                                $.ajax({
                                    type: 'POST',
                                    url: '{{route("ambil_desa")}}',
                                    data: {
                                        "_token": "{{csrf_token()}}",
                                        "id": kec,
                                        "desa": des
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
                        <div class="col-md-8">
                            <br>
                                <label>Pilih Pendidikan Yang Akan Ditempuh Oleh Santri</label>
                                <select class="form-control" name="pndkn" required="">
                                    <?php
                                        if($data->pndkn!=""){
                                            if($data->pndkn=="SMP"){
                                                $smp="selected";
                                                $smk="";
                                                $sarjana="";
                                                $mi="";
                                                $ra="";
                                            }else if($data->pndkn=="SMK"){
                                                $smp="";
                                                $smk="selected";
                                                $sarjana="";
                                                $mi="";
                                                $ra="";
                                            }else if($data->pndkn=="STRATA I"){
                                                $smp="";
                                                $smk="";
                                                $sarjana="selected";
                                                $mi="";
                                                $ra="";
                                            }else if($data->pndkn=="MI"){
                                                $smp="";
                                                $smk="";
                                                $sarjana="";
                                                $mi="selected";
                                                $ra="";
                                            }else if($data->pndkn=="RA"){
                                                $smp="";
                                                $smk="";
                                                $sarjana="";
                                                $mi="";
                                                $ra="selected";
                                            }else if($data->pndkn=="NON FORMAL"){
                                                $smp="";
                                                $smk="";
                                                $sarjana="";
                                                $mi="";
                                                $ra="";
                                                $non="selected";
                                            }
                                        }else{
                                            $smp="";
                                            $smk="";
                                            $sarjana=""; 
                                            $mi="";
                                            $ra="";
                                            $non="";
                                        }
                                    ?>
                                    <option value="">-Pilih Pendidikan Yang Akan Ditempuh-</option>
                                    <option <?php echo $ra ?> value="RA">RA </option>
                                    <option <?php echo $mi ?>  value="MI">MI </option>
                                    <option <?php echo $smp ?>value="SMP">SMP NAA</option>
                                    <option <?php echo $smk ?>  value="SMK">SMK NAA</option>
                                    <option <?php echo $sarjana ?> value="STRATA I">STAINAA</option>
                                    <option <?php echo $sarjana ?> value="NON FORMAL">NON FORMAL</option>
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
        $("#bt_kembali").click(function () {
            window.location.href = "{{url('offline2')}}/<?php echo $id ?>/<?php echo $st?>";
        });
        
        $("#bt_back").click(function () {
           window.location.href="{{url('offline')}}"; 
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
                            window.location.href = "{{url('offline4')}}/" + hasil+"/<?php echo $st?>";
                        }
                    }
                });

            }
        });
    });

    function provinsi() {
        let a = `<?php
                    $provinsi = DB::table("provinsi")->get();
                        foreach ($provinsi as $pr) {
                            if ($data->prov != "") {
                                if ($data->prov == $pr->id) {
                                    $prov = "selected";
                                } else {
                                    $prov = "";
                                    }
                            } else {
                                $prov = "";
                            }
                ?>
                    <option <?php echo $prov ?> value="<?php echo $pr->id ?>"><?php echo $pr->name ?></option>
                <?php } ?>`;
        $('#provinsi').html(a);
        $("#provinsi").css("background", "red");

    }

    function kabupaten() {
        var prov = "<?= $data->prov ?>";
        var kab = "<?= $data->kab ?>";
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
    }

    function kecamatan() {
        var kabu = "<?= $data->kab ?>";
        var keca = "<?= $data->kec ?>";
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
    }

    function desa() {
        var kec = "<?= $data->kec ?>";
        var des =  "<?= $data->desa ?>";
        $.ajax({
            type: 'POST',
            url: '{{route("ambil_desa")}}',
            data: {
                "_token": "{{csrf_token()}}",
                "id": kec,
                "desa": des
                },
            success: function (data) {
                $("#loading").css("display", "none");
                 $("#desa").html("");
                $("#desa").append(data);
                }
        });
    }

  function wali_ayah() {
      $('#nik').val("<?= $data->nik_a?>");
      $('#nik').attr('readonly', '=');
      $('#nm_w').val("<?= $data->nm_a?>");
      $('#nm_w').attr('readonly', '=');
      $('#pdkn_w').val("<?= $data->pndkn_a?>");
      $('#pdkn_w').attr('readonly', '=');
      $('#pkrjn_w').val("<?= $data->pkrjn_a?>");
      $('#pkrjn_w').attr('readonly', '=');
      $('#pos').val("<?= $data->pos?>"); 
      $('#pos').attr('readonly', '=');
      $('#alamat').val("<?= $data->alamat_lengkap?>"); 
      $('#alamat').attr('readonly', '=');
      provinsi();
      kabupaten();
      kecamatan();
      desa();
  }

  function wali_ibu() {
      $('#nik').val("<?= $data->nik_i?>");
      $('#nm_w').val("<?= $data->nm_i?>");
      $('#pdkn_w').val("<?= $data->pndkn_i?>");
      $('#pkrjn_w').val("<?= $data->pkrjn_i?>");
      $('#pos').val("<?= $data->pos?>");  
      $('#alamat').val("<?= $data->alamat_lengkap?>");
      $('#nik').attr('readonly', '=');
      $('#nm_w').attr('readonly', '=');
      $('#pdkn_w').attr('readonly', '=');
      $('#pkrjn_w').attr('readonly', '=');
      $('#pos').attr('readonly', '=');
      $('#alamat').attr('readonly', '=');
      
      provinsi();
      kabupaten();
      kecamatan();
      desa();
  }
</script>
@endsection

