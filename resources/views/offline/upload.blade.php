@extends('utama')
@section('content')
<?php
$data = DB::table("tb_person")->where("id_person", $id)->first();
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Upload Berkas Ananda <span class="text-danger"><?php echo $data->nama ?></span></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Beranda</a></li>
                    <li class="breadcrumb-item active">Upload Berkas</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <b><label>SCAN DOKUMEN (Berupa File Gambar berformat JPG) </label></b>
            </div>
            <div class="card-body">
                <form id="form_biasa" alamat="{{route('upload_simpan')}}"  rel="simpan" data-parsley-validate="" enctype="multipart/form-data" method="post">
                    {{ csrf_field()}}
                    <input hidden="" value="<?php echo $id ?>" name="id">
                    <input hidden="" name="ft_santri_lama" value="<?php echo $data->foto_warna_santri ?>">
                    <input hidden="" name="ft_wali_lama" value="<?php echo $data->foto_wali_santri_warna ?>">
                    <input hidden="" name="ft_kk_lama" value="<?php echo $data->foto_scan_kk ?>">
                    <input hidden="" name="ft_akta_lama" value="<?php echo $data->foto_scan_akta ?>">
                    <input hidden="" name="ft_sehat_lama" value="<?php echo $data->foto_scan_ket_sehat ?>">
                    <input hidden="" name="ft_skck_lama" value="<?php echo $data->foto_scan_skck ?>">
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Scan Foto Santri Berwarna </label>
                                <?php
                                    if($data->foto_warna_santri!=""){
                                        $req_santri="";
                                        ?>
                                        <div id="ed_priview1" class="col-md-12 mb-3 p-1 border" style="height:150px;">
                                            <div  id="ed_pr_img1" style="background-repeat: no-repeat;background-position: left;background-size: contain;background-image:url('<?php echo asset($data->foto_warna_santri) ?>');width:100%;height:100%;">
                                            </div>
                                        </div>
                                        <?php
                                    }else{
                                        $req_santri="required";
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
                                
                                <input <?php echo $req_santri ?> type="file"  name="ft_santri" id="ft_santri">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Scan Foto Wali Santri Berwarna 4X6</label>
                                <?php
                                    if($data->foto_wali_santri_warna!=""){
                                        $req_wali="";
                                        ?>
                                        <div id="ed_priview2" class="col-md-12 mb-3 p-1 border" style="height:150px;">
                                            <div  id="ed_pr_img2" style="background-repeat: no-repeat;background-position: left;background-size: contain;background-image:url('<?php echo asset($data->foto_wali_santri_warna) ?>');width:100%;height:100%;">
                                            </div>
                                        </div>
                                        <?php
                                    }else{
                                        $req_wali="required";
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
                                <input <?php echo $req_wali ?> type="file"  name="ft_wali" id="ft_wali">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Scan Kartu Keluarga</label>
                                <?php
                                    if($data->foto_scan_kk!=""){
                                        $req_kk="";
                                        ?>
                                        <div id="ed_priview3" class="col-md-12 mb-3 p-1 border" style="height:150px;">
                                            <div  id="ed_pr_img3" style="background-repeat: no-repeat;background-position: left;background-size: contain;background-image:url('<?php echo asset($data->foto_scan_kk) ?>');width:100%;height:100%;">
                                            </div>
                                        </div>
                                        <?php
                                    }else{
                                        $req_kk="required";
                                    }
                                ?>
                                <div id="priview3" class="col-md-12 mb-3 p-1 border" style="height:150px;">
                                    <div id="pr_img3" style="width:100%;height:100%;">
                                    </div>
                                </div>
                                <div id="batal3" class="col-md-12 p-0 mt-1 mb-1">
                                    <button type="button" class="btn btn-xs btn-warning">
                                        <i class="fas fa-times"></i>
                                        Batal
                                    </button>
                                </div>
                                <input <?php echo $req_kk ?> type="file"  name="ft_kk" id="ft_kk">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Scan Akta Kelahiran</label>
                                <?php
                                    if($data->foto_scan_akta!=""){
                                        $req_akta="";
                                        ?>
                                        <div id="ed_priview4" class="col-md-12 mb-3 p-1 border" style="height:150px;">
                                            <div  id="ed_pr_img4" style="background-repeat: no-repeat;background-position: left;background-size: contain;background-image:url('<?php echo asset($data->foto_scan_akta) ?>');width:100%;height:100%;">
                                            </div>
                                        </div>
                                        <?php
                                    }else{
                                        $req_akta="required";
                                    }
                                ?>
                                <div id="priview4" class="col-md-12 mb-3 p-1 border" style="height:150px;">
                                    <div id="pr_img4" style="width:100%;height:100%;">
                                    </div>
                                </div>
                                <div id="batal4" class="col-md-12 p-0 mt-1 mb-1">
                                    <button type="button" class="btn btn-xs btn-warning">
                                        <i class="fas fa-times"></i>
                                        Batal
                                    </button>
                                </div>
                                <input <?php echo $req_akta ?> type="file"  name="ft_akta" id="ft_akta">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Scan Surat Keterangan Sehat</label>
                                <?php
                                    if($data->foto_scan_ket_sehat!=""){
                                        $req_sehat="";
                                        ?>
                                        <div id="ed_priview5" class="col-md-12 mb-3 p-1 border" style="height:150px;">
                                            <div  id="ed_pr_img5" style="background-repeat: no-repeat;background-position: left;background-size: contain;background-image:url('<?php echo asset($data->foto_scan_ket_sehat) ?>');width:100%;height:100%;">
                                            </div>
                                        </div>
                                        <?php
                                    }else{
                                        $req_sehat="required";
                                    }
                                ?>
                                <div id="priview5" class="col-md-12 mb-3 p-1 border" style="height:150px;">
                                    <div id="pr_img5" style="width:100%;height:100%;">
                                    </div>
                                </div>
                                <div id="batal5" class="col-md-12 p-0 mt-1 mb-1">
                                    <button type="button" class="btn btn-xs btn-warning">
                                        <i class="fas fa-times"></i>
                                        Batal
                                    </button>
                                </div>
                                <input <?php echo $req_sehat ?> type="file"  name="ft_sehat" id="ft_sehat">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Scan SKCK</label><br>
                                <?php
                                    if($data->foto_scan_skck!=""){
                                        $req_skck="";
                                        ?>
                                        <div id="ed_priview6" class="col-md-12 mb-3 p-1 border" style="height:150px;">
                                            <div  id="ed_pr_img6" style="background-repeat: no-repeat;background-position: left;background-size: contain;background-image:url('<?php echo asset($data->foto_scan_skck) ?>');width:100%;height:100%;">
                                            </div>
                                        </div>
                                        <?php
                                    }else{
                                        // $req_skck="required";
                                        $req_skck="";
                                    }
                                ?>
                                <div id="priview6" class="col-md-12 mb-3 p-1 border" style="height:150px;">
                                    <div id="pr_img6" style="width:100%;height:100%;">
                                    </div>
                                </div>
                                <div id="batal6" class="col-md-12 p-0 mt-1 mb-1">
                                    <button type="button" class="btn btn-xs btn-warning">
                                        <i class="fas fa-times"></i>
                                        Batal
                                    </button>
                                </div>
                                <input <?php echo $req_skck ?> type="file"  name="ft_skck" id="ft_skck">
                                {{-- <h1>Hanya Untuk Siswa SMK Dan STAINAA</h1> --}}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <div class="row">
                                <div class="col-3 text-left">
                                    <a href="{{url("offline")}}">
                                    <button type="button" class="btn btn-danger pl-4 pr-4">
                                        <i class="fas fa-reply"></i>
                                        Batal
                                    </button>
                                    </a>
                                </div>
                                <div class="col-9 text-right">
                                    <button  type="submit" class="btn btn-info pl-4 pr-4">
                                        <i class="fas fa-save"></i>
                                        Simpan</button>
                                 </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#priview1").css("display", "none");
        $("#batal1").css("display", "none");
        $("#priview2").css("display", "none");
        $("#batal2").css("display", "none");
        $("#priview3").css("display", "none");
        $("#batal3").css("display", "none");
        $("#priview4").css("display", "none");
        $("#batal4").css("display", "none");
        $("#priview5").css("display", "none");
        $("#batal5").css("display", "none");
        $("#priview6").css("display", "none");
        $("#batal6").css("display", "none");
        
        $("#ft_santri").change(function(){
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
        
        $("#ft_wali").change(function(){
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
            $("#ft_wali").val("");
            $("#priview2").css("display", "none");
            $("#batal2").css("display", "none");
            $("#ed_priview2").css("display", "block");
        });
        
        
       $("#ft_kk").change(function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#ed_priview3").css("display", "none");
                    $("#priview3").css("display", "block");
                    $("#batal3").css("display", "block");
                    $("#pr_img3").css('background-image', 'url(' + e.target.result + ')');
                    $("#pr_img3").css("background-position", "left");
                    $("#pr_img3").css("background-size", "contain");
                    $("#pr_img3").css("background-repeat", "no-repeat");
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
        $("#batal3").click(function(){
            $("#ft_kk").val("");
            $("#priview3").css("display", "none");
            $("#batal3").css("display", "none");
            $("#ed_priview3").css("display", "block");
        });
        
       $("#ft_akta").change(function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#ed_priview4").css("display", "none");
                    $("#priview4").css("display", "block");
                    $("#batal4").css("display", "block");
                    $("#pr_img4").css('background-image', 'url(' + e.target.result + ')');
                    $("#pr_img4").css("background-position", "left");
                    $("#pr_img4").css("background-size", "contain");
                    $("#pr_img4").css("background-repeat", "no-repeat");
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
        $("#batal4").click(function(){
            $("#ft_akta").val("");
            $("#priview4").css("display", "none");
            $("#batal4").css("display", "none");
            $("#ed_priview4").css("display", "block");
        });
        
        $("#ft_sehat").change(function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#ed_priview5").css("display", "none");
                    $("#priview5").css("display", "block");
                    $("#batal5").css("display", "block");
                    $("#pr_img5").css('background-image', 'url(' + e.target.result + ')');
                    $("#pr_img5").css("background-position", "left");
                    $("#pr_img5").css("background-size", "contain");
                    $("#pr_img5").css("background-repeat", "no-repeat");
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
        $("#batal5").click(function(){
            $("#ft_sehat").val("");
            $("#priview5").css("display", "none");
            $("#batal5").css("display", "none");
            $("#ed_priview5").css("display", "block");
        });
        
        
        $("#ft_skck").change(function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#ed_priview6").css("display", "none");
                    $("#priview6").css("display", "block");
                    $("#batal6").css("display", "block");
                    $("#pr_img6").css('background-image', 'url(' + e.target.result + ')');
                    $("#pr_img6").css("background-position", "left");
                    $("#pr_img6").css("background-size", "contain");
                    $("#pr_img6").css("background-repeat", "no-repeat");
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
        $("#batal6").click(function(){
            $("#ft_skck").val("");
            $("#priview6").css("display", "none");
            $("#batal6").css("display", "none");
            $("#ed_priview6").css("display", "block");
        });
        
        
        
        $("#bt_batal").click(function () {
            var id =<?php echo $id ?>;
            //alert(id);
            swal({
                title: 'Anda yakin Membatalkan ?',
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
                    success: function (data) {
                        $("#loading").css("display", "none");
                        //alert(data);
                        if (data == 1) {
                            swal({
                                title: 'Pembatalan Sukses',
                                text: '',
                                type: 'success'
                            }).then(function () {
                                window.location.href = "{{url('/')}}";
                            });
                        } else if (data == 2) {
                            swal({
                                title: 'Pembatalan Gagal',
                                text: '',
                                type: 'success'
                            }).then(function () {
                                window.location.href = "";
                            });
                        }
                    }
                });
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

        
    });
</script>
@endsection