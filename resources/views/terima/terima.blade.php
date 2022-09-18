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
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        </div><!-- /.row -->
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5><b>MASUKKAN NO REEGRISTRASI</b></h5>
                        <input type="number" autofocus="" id="no_regris" placeholder="Masukkan No regristrasi" class="form-control text-center" style="width:70%;margin:0 auto;">
                        <button id="bt_proses" class="btn btn-info mt-3" style="width:40%;">PROSES</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {

        $("#bt_proses").click(function(){
            var no_regris=$("#no_regris").val();
            if(no_regris==""){
                $("#no_regris").focus();
                swal("No regristrasi Harus Diisi");
            }else{
                $("#loading").css("display", "block ");
                $.ajax({
                    type: 'POST',
                    url:"{{route('cek_regris')}}",
                    data:{
                        "_token": "{{csrf_token()}}",
                        "no":no_regris
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
                            $("#loading").css("display", "none");
                            window.location.href="{{url('terima_detail')}}/"+hasil+"/3";
                        }
                        
                   }
                });
            }
        });
         $("#bt_tambah").click(function(){
             $("#loading").css("display", "block");
             $.ajax({
                 type: 'POST',
                 url:"{{route('simpan1')}}",
                 data:{
                     "_token": "{{csrf_token()}}",
                 },
                 success: function (hasil) {
                     $("#loading").css("display", "none"); 
                     window.location.href="{{url('offline1')}}/"+hasil+"/sm";
                }
             });
          });
          
    });
</script>
@endsection



