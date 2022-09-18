@extends('utama')
@section('content')
<?php
$admin=DB::table("tb_admin")->where("id",Session::get("id_admin"))->first();
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
    
    #tb_identitas tbody tr td{
        border-color: white !important;
        padding: 2px;
    }
    label{
        font-family: noto;
        font-size:14px;
    }
</style>
    <audio id="audioNotifikasi">
        <source src="{{asset('asset')}}/notifikasi.mp3" type="audio/mpeg">
    </audio>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        </div><!-- /.row -->
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-6 offset-md-3">
                <div class="card elevation-2">
                    <div class="card-body text-center ">
                        <video class="col " id="preview"></video>
                        
                    </div>
                    <div class="card-footer text-center bg-gradient-gray-dark">
                        <h2 >
                            <a href="#"  id="btn_mulai">
                                <i class="fas fa-camera text-secondary text-white">
                                </i>
                            </a>
                            <a href="#"  id="btn_berhenti" >
                                <i class="fas fa-camera text-secondary">
                                </i>
                            </a>
                        </h2>
                        <label class="mb-0">Scan Qr Code</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (data) {
            if (data) {
                var el = document.getElementById("audioNotifikasi"); 
                el.play(); 
                    var noQrCode = data;
                    if( noQrCode == "" ) {
                        swal("No regristrasi Harus Diisi");
                    }else{
                        $("#loading").css("display", "block ");
                        $.ajax({
                            type: 'POST',
                            url:"{{route('cek_regris')}}",
                            data:{
                                "_token": "{{csrf_token()}}",
                                "no":noQrCode
                            },
                            success: function (hasil) {
                                if(hasil=="N"){
                                    $("#loading").css("display", "none");
                                    swal({
                                        title: 'No Regristrasi Tidak Ada!',
                                        text: '',
                                        type: 'warning'
                                    }).then(function () {
                                    });
                                }else if(hasil=="M"){
                                    $("#loading").css("display", "none");
                                    swal({
                                        title: 'Data Telah diterima',
                                        text: '',
                                        type: 'warning'
                                    }).then(function () {
                                    });
                                }else{
                                    var o = 3;
                                    $("#loading").css("display", "none");
                                    window.location.href="{{url('terima_detail')}}/"+hasil+"/2";
                                }
                            }
                        });
                    }
            } else {
                var el = document.getElementById("audioNotifikasi"); 
                el.play(); 
                swal({
                        title: 'Data Tidak Ada!',
                        text: '',
                        type: 'warning'
                        }).then(function () {
                });
            }
        });
    $('#btn_berhenti').hide();
    $('#btn_mulai').click(function () {
        $(this).hide();
        $('#btn_berhenti').show();
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
            }).catch(function (e) {
                console.error(e);
        });
    });
    $('#btn_berhenti').click(function () {
        $(this).hide();
        $('#btn_mulai').show();
        Instascan.Camera.getCameras().then(function () {
            scanner.stop();
            }).catch(function (e) {
                console.error(e);
        });
    });
</script>
@endsection



