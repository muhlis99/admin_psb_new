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
    <div class="col-md-6">
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
                        <?php
                        $batas = 100;
                        $tahun = date('Y');
                        $jumlahdata = DB::table("tb_person")
                                        ->where("status", "aktif")
                                        ->where(DB::raw('SUBSTRING(tgl_daftar,1,4)'),"=",$tahun)
                                        ->orderBy("id_person", "desc")->count();
                        $tot_halaman = ceil($jumlahdata / $batas);

                        for ($p = 1; $p <= $tot_halaman; $p++) {
                            if($p>1){
                                $hal=($p*$batas)-$batas;
                                $cek_jum=DB::table("tb_person")
                                        ->where("status", "aktif")
                                        ->where(DB::raw('SUBSTRING(tgl_daftar,1,4)'),"=",$tahun)
                                        ->offset($hal)->limit($batas)
                                        ->get()->count();
                            }else{
                                $hal=0;
                                $cek_jum="100";
                            }
                            
                            if($tot_halaman!=$p){
                             ?>
                                <a href="{{url('cetak_semua_mahrom')}}/<?= $hal ?>/<?= $batas?>/Data_100_santri_Ke_<?= $p?>">
                                    <button type="button" class="btn btn-info btn-block mb-2">cetak 100 Santri <?php echo "Ke-" .$p ?></button>
                                </a>
                                <?php   
                            }else{
                               ?>
                                <a href="{{url('cetak_semua_mahrom')}}/<?= $hal ?>/<?= $batas?>/Data_<?= $cek_jum ?>_santri_terakhir">
                                    <button type="button" class="btn btn-info btn-block mb-2">cetak <?php echo $cek_jum ?> Santri Terkahir </button>
                                </a>
                                <?php  
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
