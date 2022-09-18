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
            <div class="col-sm-6">
                <h1 class="m-0">Data Santri Baru</h1>
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
            <div class="card-header">
                <button id="bt_tambah" class="btn btn-info btn-sm">
                    <i class="fas fa-plus"></i>
                    Tambah data
                </button>
            </div>
            <div class="card-body">
                <table style="width:100%;" id="table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width:1%">NO</th>
                            <th style="width:10%">NIK</th>
                            <th style="width:10%">NIUP</th>
                            <th style="width:15%">NAMA</th>
                            <th style="width:9%">TANGGAL LAHIR</th>
                            <th style="width:9%">TEMPAT LAHIR</th>
                            <th style="width:15%">IDENTITAS SANTRI</th>
                            <th style="width:9%">TTL</th>
                            <th style="width:12%">ALAMAT</th>
                            <th style="width:13%">STATUS BERKAS</th>
                            <th style="width:13%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                type: 'POST',
                url: '{{route("person_data")}}',
                data: {
                    "_token": "{{csrf_token()}}"
                }
            },
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'nik', name: 'nik'},
                {data: 'niup', name: 'niup'},
                {data: 'nama', name: 'nama'},
                {data: 'tanggal_lahir', name: 'tanggal_lahir'},
                {data: 'tempat_lahir', name: 'tempat_lahir'},
                {data: 'identitas', name: 'identitas'},
                {data: 'ttl', name: 'ttl'},
                {data: 'alamat_lengkap', name: 'alamat_lengkap'},
                {data: 'berkas', name: 'berkas'},
                {data: 'edit', name: 'action', orderable: false, searchable: false}
            ],
            "columnDefs": [
                {
                    "targets": [ 1 ],
                    "visible": false
                },
                {
                    "targets": [ 2 ],
                    "visible": false
                },
                {
                    "targets": [ 3 ],
                    "visible": false
                },
                {
                    "targets": [ 4 ],
                    "visible": false
                },
                {
                    "targets": [ 5 ],
                    "visible": false
                }
            ]
        });
        $('#table').on("click", ".bt_edit", function () {
            var id=$(this).attr("id");
            window.location.href="{{url('offline1')}}/"+id+"/ed";
        });
        
//        $('#table').on("click", ".bt_hapus", function () {
//            var id = $(this).attr("id");
//            swal({
//                title: 'Anda yakin menghapus?',
//                text: "",
//                type: 'warning',
//                showCancelButton: true,
//                confirmButtonColor: '#3085d6',
//                cancelButtonColor: '#d33',
//                confirmButtonText: 'YA',
//                cancelButtonText: 'TIDAK',
//                confirmButtonClass: 'btn btn-success',
//                cancelButtonClass: 'btn btn-danger',
//                buttonsStyling: true
//            }).then(function () {
//                $.ajax({
//                    type: 'POST',
//                    url: "",
//                    data: {
//                        "_token": "{{csrf_token()}}",
//                        "id": id
//                    },
//                    success: function (hasil) {
//                        if (hasil == 1) {
//                            swal({
//                                title: 'Hapus Sukses',
//                                text: '',
//                                type: 'success'
//                            }).then(function () {
//                                table_reload();
//                            });
//                        } else if(hasil==2) {
//                            swal({
//                                title: 'Hapus Gagal',
//                                text: '',
//                                type: 'error'
//                            }).then(function () {
//                                table_reload();
//                            });
//                        }else if(hasil==3) {
//                            swal({
//                                title: 'Data telah digunakan',
//                                text: '',
//                                type: 'error'
//                            }).then(function () {
//                                table_reload();
//                            });
//                        }
//                    }
//                });
//            });
//        });
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
          $('#table').on("click", ".bt_upload", function () {
            var id=$(this).attr("id");
            window.location.href="{{url('upload')}}/"+id;
        });
        
        $('#table').on("click", ".bt_detail", function () {
            var id=$(this).attr("id");
            window.location.href="{{url('detail')}}/"+id;
        });
        $('#table').on("click", ".bt_print", function () {
            var id=$(this).attr("id");
            window.location.href="{{url('print_daftar')}}/"+id+"/1";
        });
    });
</script>
@endsection

