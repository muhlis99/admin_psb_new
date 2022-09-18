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
                            <label>Pilih Santri</label>
                            <select id="santri" class="form-control" name="pndkn" required="">
                                <option value="">-Pilih Santri-</option>
                                <option value="Laki-Laki">Santri Putra</option>
                                <option value="Perempuan">Santri Putri</option>
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
                                   var santri=$("#santri").val();
                                   if(santri==""){
                                       swal("Anda belum memilih Santri");
                                   }else{
                                       var tahun=$("#tahun").val();
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
                                                   window.location.href="{{url('cetak_santri_print')}}/"+santri+"/"+tahun;
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
