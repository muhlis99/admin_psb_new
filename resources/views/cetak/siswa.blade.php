@extends('utama')
@section('content')
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
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        </div><!-- /.row -->
    </div>
</div>
<section class="content">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <a href="{{url("offline")}}">
                    <button class="btn btn-danger">
                        <i class="fas fa-reply"></i>
                        Kembali
                    </button>
                </a>
            </div>
            <div class="card-body mb-1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Pilih Lembaga</label>
                            <select id="pndkn" class="form-control" name="pndkn" required="">
                                <option value="">-Pilih Pendidikan-</option>
                                <option value="RA">RA</option>
                                <option value="MI">MI</option>
                                <option value="SMP">SMP NAA</option>
                                <option value="SMK">SMK NAA</option>
                                <option value="STRATA I">STRATA 1</option>
                                <option value="NON FORMAL">NON  FORMAL</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tahun Angkatan</label>
                            <select id="tahun" class="form-control" name="pndkn" required="">
                                <option value="">-Tahun Angkatan-</option>
                                <?php
                                    for($g=2010;$g<date("Y")+5;$g++){
                                        ?>
                                        <option value="<?php echo $g ?>"><?php echo $g ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button id="bt_cetak" class="btn btn-info">
                                <i class="fas fa-print"></i>
                                Cetak Data
                            </button>
                        </div>
                        <script>
                            $(document).ready(function(){
                                $("#bt_cetak").click(function(){
                                   var pndkn=$("#pndkn").val();
                                   
                                   if(pndkn==""){
                                       swal("Anda belum memilih pendidikan");
                                   }else{
                                       var tahun=$("#tahun").val();
                                    //    alert(tahun);
                                       $("#loading").css("display", "block");
                                       $.ajax({
                                           type:'POST',
                                           url:"{{route('cek_data_siswa')}}",
                                           data: {
                                                "_token": "{{csrf_token()}}",
                                                "tahun":tahun
                                            },
                                            success: function (hasil) {
                                               if(hasil==1){
                                                  $("#loading").css("display", "none");
                                                  swal("Tahun angkatan yang anda pilih tidak ada siswa"); 
                                               }else{
                                                   $("#loading").css("display", "none");
                                                   window.location.href="{{url('cetak_siswa_print')}}/"+pndkn+"/"+tahun;
                                               }
                                            }
                                       }); 
                                   }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
