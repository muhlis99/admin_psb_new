@extends('utama')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">BERANDA</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v2</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1">
                        <i class="fas fa-users"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">PENDAFTAR ONLINE</span>
                        <span class="info-box-number">
                            <?php
                            $jum_online=DB::table("tb_psb")->where("no_regristrasi","<>","")->count();
                            echo $jum_online;
                            ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1">
                        <i class="fas fa-users"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">SANTRI BARU <?php echo date("Y") ?></span>
                        <span class="info-box-number">
                            <?php
                                $date = date('Y');
                                $jum_santri_baru=DB::table("tb_person")->where("status","aktif") ->whereYear("tgl_daftar",$date)->count();
                                echo $jum_santri_baru
                            ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1">
                        <i class="fas fa-male"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">SANTRI LAKI-LAKI</span>
                        <span class="info-box-number">
                            <?php
                                $date = date('Y');
                                $santri_baru_lk=DB::table("tb_person")
                                        ->where("status","aktif")
                                        ->where("jenis_kelamin","Laki-Laki")
                                        ->whereYear("tgl_daftar",$date)
                                        ->count();
                                echo $santri_baru_lk;
                            ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1">
                        <i class="fas fa-female"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">SANTRI PEREMPUAN</span>
                        <span class="info-box-number">
                            <?php
                                $date = date('Y');
                                $santri_baru_pr=DB::table("tb_person")
                                        ->where("status","aktif")
                                        ->where("jenis_kelamin","Perempuan")
                                        ->whereYear("tgl_daftar",$date)
                                        ->count();
                                echo $santri_baru_pr;
                            ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
    </div><!--/. container-fluid -->
</section>
@endsection