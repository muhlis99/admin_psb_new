@extends('utama')
@section('content')
<?php
$admin = DB::table("tb_admin")->where("id", Session::get("id_admin"))->first();
$namaBulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$data = DB::table("tb_person")->where("id_person", $id)->first();
$data_mahrom = DB::table('tb_detail_mahrom')->join('tb_mahrom', 'tb_detail_mahrom.id_mahrom', '=', 'tb_mahrom.id_mahrom')->where("id_person", $id)->first();
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
                <h1 class="m-0">Data Mahrom dari <span class="text-danger"><b><?php echo $data->nama ?></b></span></h1>
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
                <div class="card-body pb-4">
                    <div class="row">
                        <div class="col-md-3">
                            Yang Termasuk Mahrom adalah :
                            <ol>
                                <li>Ayah</li>
                                <li>Ibu</li>
                                <li>Ayah Tiri</li>
                                <li>Ibu Tiri</li>
                                <li>Kakek (Dari Ayah)</li>
                                <li>Nenek (Dari Ayah)</li>
                                <li>Kakek (Dari Ibu)</li>
                                <li>Nenek (Dari Ibu)</li>
                                <li>Ibu Susuan</li>
                                <li>Kakak Kandung</li>
                                <li>Adik Kandung</li>
                                <li>Keponakan</li>
                                <li>Kakak (Satu SUSUAN)</li>
                                <li>Adik (Satu SUSUAN)</li>
                                <li>Paman (Saudara Ayah)</li>
                                <li>Bibi (Saudara Ayah)</li>
                                <li>Paman (Saudara Ibu)</li>
                                <li>Bibi (Saudara Ibu)</li>
                            </ol> 
                        </div>
                        <div class="col-md-9">
                            <br>
                            <button type="button" id="bt_tambah" class="btn btn-info mb-3 btn-sm">
                                <i class="fas fa-plus"></i>
                                Tambah Mahrom
                            </button>
                            <table id="table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:5%">NO</th>
                                        <th style="width:10%">NIK</th>
                                        <th style="width:20%">NAMA</th>
                                        <th style="width:20%">TANGGAL LAHIR</th>
                                        <th style="width:20%">ALAMAT</th>
                                        <th style="width:20%">HUBUNGAN</th>
                                        <th style="width:20%">FOTO</th>
                                        <th style="width:20%">KTP/KK</th>
                                        <th style="width:8%">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
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
                            <button id="bt_selesai" type="button" style="float:right" class="btn btn-success ">

                                SELESAI
                                <i class="fas fa-arrow-right"></i>
                            </button>
                            <button id="bt_kembali" style="float:right;" type="button" class="btn btn-info mr-2">
                                <i class="fas fa-arrow-left"></i>
                                Sebelumnya
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
        var id_per = $("#id_person").val();
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
            window.location.href = "{{url('offline3')}}/<?php echo $id ?>/<?php echo $st?>";
        });
        
        $("#bt_back").click(function () {
           window.location.href="{{url('offline')}}"; 
        });
        
        $("#bt_selesai").click(function () {
            var id = $("#id_person").val();
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
                    url: "{{route('offline_selesai')}}",
                    data: {
                        "_token": "{{csrf_token()}}",
                        'id': id,
                    },
                    success: function (hasil) {
                        
                        //console.log(hasil);
                        //alert(hasil);
                        if (hasil == 1) {
                            $("#loading").css("display", "none");
                            swal({
                                title: 'Sukses, Data Telah Tersimpan',
                                text: '',
                                type: 'success'
                            }).then(function () {
                                window.location.href = "{{url('print_daftar')}}/"+id;
                            });
                        } else if (hasil == 2) {
                            $("#loading").css("display", "none");
                            swal({
                                title: 'Gagal',
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
                
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            "lengthChange": false,
            language: {search: ""},
            ajax: {
                type: "post",
                url: '{{route("mahrom_data")}}',
                data: {
                    "_token": "{{csrf_token()}}",
                    "id":id_per
                }
            },
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'nik_m', name: 'nik_m'},
                {data: 'nama_mahrom', name: 'nama_mahrom'},
                {data: 'tanggal_lahir', name: 'tanggal_lahir'},
                {data: 'alamat_mahrom', name: 'alamat_mahrom'},
                {data: 'hubungan', name: 'hubungan'},
                {data: 'foto_diri', name: 'foto_diri'},
                {data: 'foto_kk_atau_ktp', name: 'foto_kk_atau_ktp'},
                {data: 'edit', name: 'action', orderable: false, searchable: false}
            ]
        });
        
        $("#bt_tambah").click(function () {
            $("#form_simpan").parsley().reset();
            $("#md_tambah").modal({backdrop: 'static', keyboard: false});
            $('#md_tambah').on('shown.bs.modal', function () {
                $("#status").val("");
                $("#nama").val("");
                $("#nik").val("");
                $("#tgl_lahir").val("");
                $("#thn_lahir").val("");
                $("#bln_lahir").val("");
                $("#alamat").val("");
            });
        });

       
        
        $("#table").on("click", ".bt_hapus", function () {
            var id = $(this).attr("id");
            swal({
                title: 'Anda yakin menghapus?',
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
                    url: "{{route('mahrom_hapus')}}",
                    data: {
                        "_token": "{{csrf_token()}}",
                        'id': id
                    },
                    success: function (hasil) {
                        $("#loading").css("display", "none");
                        //console.log(hasil);
                        //alert(hasil);
                        if (hasil == 1) {
                            $('#table').DataTable().ajax.reload();
                            swal({
                                title: 'Berhasil',
                                text: '',
                                type: 'success'
                            }).then(function () {
                                // window.location.href = "";
                            });
                        } else if (hasil == 2) {
                            swal({
                                title: 'Gagal',
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
        $("#table").on("click", ".bt_foto", function () {
            var id = $(this).attr("id");
            $("#md_foto").modal({backdrop: 'static', keyboard: false});
            $('#md_foto').on('shown.bs.modal', function () {
               $('#id_foto').val(id);
            });
        });
    });
</script>
<div id="md_tambah"  class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Mahrom</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_simpan" alamat="{{route('mahrom_simpan')}}" rel="simpan" data-parsley-validate="" method="post">
                    {{ csrf_field()}}
                    <input hidden="" name="id" value="<?php echo $id ?>">
                    <div class="form-group">
                        <label>Hubungan Mahrom</label>
                        <select id="status" class="form-control" name="hubungan" required="">
                            <option value="">Pilih Status mahrom</option>
                            <?php
                            $data_tb = DB::table("tb_psb_mahrom_status")->get();
                            foreach ($data_tb as $dt) {
                                if($dt->status !="ayah"){
                                    if($dt->status !="ibu"){
                                    ?>
                                <option value="<?php echo $dt->status ?>"><?php echo $dt->status ?></option>
                                <?php
                                }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nik</label>
                        <input data-parsley-length="[16,16]" data-parsley-length-message="harus diisi 16 angka NIK"  autocomplete="off" id="nik" name="nik" required="" class="form-control">
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
                    <div class="form-group">
                        <label>Nama Mahrom</label>
                        <input autocomplete="off" id="nama" name="nama" required="" class="form-control">
                    </div>
                    <div class="row col-12">
                        <div class="form-group col-4">
                            <label>TANGGAL LAHIR</label>
                            <select id="tgl_lahir" name="tgl_lahir" required="" class="form-control ">
                                <option value="">-Pilih Tanggal-</option>
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
                                    } ?>
                            </select>
                        </div>
                        <div class="form-group  col-4">
                            <label>BULAN LAHIR</label>
                            <select id="bln_lahir" name="bln_lahir" required="" class="form-control">
                                <option value="">-Pilih Bulan-</option>
                                    <?php
                                    for ($i = 1; $i < 13; $i++) {
                                        if ($i < 10) {
                                            $bln = "0" . $i;
                                        } else {
                                            $bln = $i;
                                        }
                                        ?>
                                        <option value="<?php echo $bln ?>"><?php echo $namaBulan[$i] ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label>TAHUN LAHIR</label>
                            <select id="thn_lahir" name="thn_lahir" required="" class="form-control ">
                                <option value="">-Pilih Tahun-</option>
                                <?php
                                    for ($th = 1980; $th < date("Y") + 5; $th++) {
                                        ?>
                                        <option value="<?php echo $th ?>"><?php echo $th ?></option>
                                        <?php  } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea autocomplete="off" id="alamat" name="alamat" required="" class="form-control" id="" cols="30" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button data-dismiss="modal" type="button" class="btn btn-danger">Batal</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    function table_reload() {
        $("#table").DataTable().ajax.reload();
        $('#md_tambah').modal('hide');
        $('#md_edit').modal('hide');
    }
    $(document).ready(function () {
        $("#form_simpan").on('submit', function (e) {
            e.preventDefault();
            var kem = $(this).attr("kem");
            var url = $(this).attr("alamat");
            var form = $(this);
            var data = $(this).serialize();
            $("#loading").css("display", "block");
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function (hasil) {
                    $("#loading").css("display", "none");
                    //console.log(hasil);
                    //alert(hasil);
                    if (hasil == 1) {
                        $('#md_tambah').modal("hide");
                        $('#table').DataTable().ajax.reload();
                    } else if (hasil == 2) {
                        swal({
                            title: 'Gagal',
                            text: '',
                            type: 'error'
                        }).then(function () {
                            window.location.href = "";
                        });
                    } else if (hasil == 3) {
                        swal({
                            title: 'Kakek dari ibu tidak boleh lebih dari satu',
                            text: '',
                            type: 'error'
                        }).then(function () {

                        });
                    } else if (hasil == 4) {
                        swal({
                            title: 'Kakek dari Ayah tidak boleh lebih dari satu',
                            text: '',
                            type: 'error'
                        }).then(function () {

                        });
                    } else if (hasil == 5) {
                        swal({
                            title: 'Nenek dari Ayah tidak boleh lebih dari satu',
                            text: '',
                            type: 'error'
                        }).then(function () {

                        });
                    } else if (hasil == 6) {
                        swal({
                            title: 'Nenek dari Ibu tidak boleh lebih dari satu',
                            text: '',
                            type: 'error'
                        }).then(function () {

                        });
                    } 
                    // else if (hasil == 7) {
                    //     swal({
                    //         title: 'Ibu susan tidak boleh lebih dari satu',
                    //         text: '',
                    //         type: 'error'
                    //     }).then(function () {

                    //     });
                    // } 
                    else if (hasil == 7) {
                        swal({
                            title: 'Ibu Tiri tidak boleh lebih dari satu',
                            text: '',
                            type: 'error'
                        }).then(function () {

                        });
                    } else if (hasil == 8) {
                        swal({
                            title: 'Ayah Tiri tidak boleh lebih dari satu',
                            text: '',
                            type: 'error'
                        }).then(function () {

                        });
                    }
                }
            });

        });
    });
</script>


<div id="md_foto"  class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload Foto Mahrom</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- <form id="foto_simpan" alamat="{{route('foto_simpan')}}" rel="simpan" data-parsley-validate="" method="post">
                    {{ csrf_field()}} --}}
                    <input hidden name="id" id="id_foto" value="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>FOTO DIRI</label>
                                <?php
                                    if($data_mahrom->foto_diri !=""){
                                        $req_diri="";
                                        ?>
                                        <div id="ed_priview1" class="col-md-12 mb-3 p-1 border" style="height:150px;">
                                            <div  id="ed_pr_img1" style="background-repeat: no-repeat;background-position: left;background-size: contain;background-image:url('<?php echo asset($data_mahrom->foto_diri) ?>');width:100%;height:100%;">
                                            </div>
                                        </div>
                                        <?php
                                    }else{
                                        $req_diri="required";
                                         ?>
                                        <div id="ed_priview1" class="col-md-12 mb-3 p-1 border" style="height:150px;">
                                            <div  id="ed_pr_img1" style="background-repeat: no-repeat;background-position: left;background-size: contain;background-image:url('<?php echo asset($data_mahrom->foto_diri) ?>');width:100%;height:100%;">
                                            </div>
                                        </div>
                                        <?php
                                    }
                                ?>
                                <div id="priview1" class="col-md-12 mb-3 p-1 border" style="height:150px;">
                                    <div id="pr_img1" style="width:100%;height:100%;">
                                    </div>
                                </div>
                                <div id="batal1" class="col-md-12 p-0 mt-1 mb-1">
                                    <button type="button" class="btn btn-xs btn-warning">
                                        <i class="fas fa-times"></i>
                                        Batal
                                    </button>
                                </div>
                                <input <?php echo $req_diri ?> type="file"  name="ft_diri" id="ft_diri">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>FOTO KK ATAU KTP</label>
                                <?php
                                    if($data_mahrom->foto_kk_atau_ktp !=""){
                                        $req_kk="";
                                        ?>
                                        <div id="ed_priview2" class="col-md-12 mb-3 p-1 border" style="height:150px;">
                                            <div  id="ed_pr_img2" style="background-repeat: no-repeat;background-position: left;background-size: contain;background-image:url('<?php echo asset($data_mahrom->foto_kk_atau_ktp) ?>');width:100%;height:100%;">
                                            </div>
                                        </div>
                                        <?php
                                    }else{
                                        $req_kk="required";
                                    }
                                ?>
                                <div id="priview2" class="col-md-12 mb-3 p-1 border" style="height:150px;">
                                    <div id="pr_img2" style="width:100%;height:100%;">
                                    </div>
                                </div>
                                <div id="batal2" class="col-md-12 p-0 mt-1 mb-1">
                                    <button type="button" class="btn btn-xs btn-warning">
                                        <i class="fas fa-times"></i>
                                        Batal
                                    </button>
                                </div>
                                <input <?php echo $req_kk ?> type="file"  name="ft_kk_ktp" id="ft_kk_ktp">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button data-dismiss="modal" type="button" class="btn btn-danger">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
      function table_reload() {
        $("#table").DataTable().ajax.reload();
        $('#md_tambah').modal('hide');
        $('#md_edit').modal('hide');
    }
    $(document).ready(function () {
        $("#priview1").css("display", "none");
        $("#batal1").css("display", "none");
        $("#priview2").css("display", "none");
        $("#batal2").css("display", "none");


        $("#ft_diri").change(function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#ed_priview1").css("display", "none");
                    $("#priview1").css("display", "block");
                    $("#batal1").css("display", "block");
                    $("#pr_img1").css('background-image', 'url(' + e.target.result + ')');
                    $("#pr_img1").css("background-position", "left");
                    $("#pr_img1").css("background-size", "contain");
                    $("#pr_img1").css("background-repeat", "no-repeat");
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
        $("#batal1").click(function(){
            $("#ft_santri").val("");
            $("#priview1").css("display", "none");
            $("#batal1").css("display", "none");
            $("#ed_priview1").css("display", "block");
        });


        $("#ft_kk_ktp").change(function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#ed_priview2").css("display", "none");
                    $("#priview2").css("display", "block");
                    $("#batal2").css("display", "block");
                    $("#pr_img2").css('background-image', 'url(' + e.target.result + ')');
                    $("#pr_img2").css("background-position", "left");
                    $("#pr_img2").css("background-size", "contain");
                    $("#pr_img2").css("background-repeat", "no-repeat");
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
        $("#batal2").click(function(){
            $("#ft_santri").val("");
            $("#priview2").css("display", "none");
            $("#batal2").css("display", "none");
            $("#ed_priview2").css("display", "block");
        });
    });

    $("#form_biasa").on('submit', function (e) {
            e.preventDefault();
            var kem = $(this).attr("kem");
            var url = $(this).attr("alamat");
            var form = $(this);
            var data = new FormData(this);
            form.parsley().validate();
            if (form.parsley().isValid()) {
                $("#loading").css("display", "block");
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (hasil) {
                        $("#loading").css("display", "none");
                        if (hasil == 1) {
                            swal({
                                title: 'Upload Sukses',
                                text: '',
                                type: 'success'
                            }).then(function () {
                                window.location.href="{{url('offline')}}";
                            });
                        }else if (hasil == 2) {
                            swal({
                                title: 'Gagal',
                                text: '',
                                type: 'error'
                            }).then(function () {

                            });
                        } else if (hasil == 3) {
                            swal("Nik Harus 16 Digit")
                        } else if (hasil == 4) {
                            swal({
                                title: 'Confirm Password Salah !',
                                text: '',
                                type: 'error'
                            }).then(function () {

                            });
                        }
                    }
                });

            }
        });

</script>
@endsection



