@extends('utama')
@section('content')
<?php
$admin=DB::table("tb_admin")->where("id",Session::get("id_admin"))->first();
$data = DB::table("tb_person")->where("id_person", $id)->first();
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
            <!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5><?php echo "<b class='text-danger'>".strtoupper($data->nama)."</b> [".$data->niup."]"?></h5>
                    </div>
                    <div class="col-md-6">
                        <?php 
                            if($o =='1'){
                                ?>
                                <a href="{{url('offline')}}">
                                    <button style="float:right" class="btn btn-sm btn-danger">
                                        <i class="fas fa-file"></i>
                                        Kembali Ke data Santri
                                    </button> 
                                </a>
                                <?php
                            }elseif ($o =='2') {
                                ?>
                                <a href="{{url('terima_qrcode')}}">
                                    <button style="float:right" class="btn btn-sm btn-danger">
                                        <i class="fas fa-file"></i>
                                        Kembali Ke Scan QR Code
                                    </button> 
                                </a>
                                <?php
                            }else{
                                ?>
                                <a href="{{url('terima')}}">
                                    <button style="float:right" class="btn btn-sm btn-danger">
                                        <i class="fas fa-file"></i>
                                        Kembali Ke No Registrasi
                                    </button> 
                                </a>
                                <?php
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-6 offset-md-3">
                    <a target="_blank" href="{{url('formulir')}}/<?php echo $id ?>">
                <button type="button" class="mb-2 btn btn-info btn-block">
                    <i class="fas fa-print"></i>
                    PRINT FORMULIR PENDAFTARAN SANTRI BARU</button>
                </a>
                <a target="_blank" href="{{url('print_surat_santri')}}/<?php echo $id ?>">
                <button type="button" class="mb-2 btn btn-primary btn-block">
                    <i class="fas fa-print"></i>
                    PRINT SURAT PERNYATAAN SANTRI</button>
                </a>
                <a target="_blank" href="{{url('print_surat_ortu')}}/<?php echo $id ?>">
                <button type="button" class="mb-2 btn btn-success btn-block">
                    <i class="fas fa-print"></i>
                    PRINT SURAT PERNYATAAN ORANG TUA</button>
                </a>
                </div>
                
            </div>
        </div>
        </div>
    </div>
</section>
@endsection

