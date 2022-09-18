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
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 style="font-size:22px;" class="card-title">CETAK DATA MAHROM PER-SANTRI</h3>
                    <a href="{{url('cetak_mahrom_all')}}">
                    <button type="button" style="float:right;" class="btn btn-warning btn-sm">
                        <i class="fas fa-print"></i>&nbsp;
                        Cetak Semua data
                    </button>
                    </a>
                </div>
                <div class="card-body mb-1">
                    <div class="row">
                        <div class="col-md-12">
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
                                        <th style="width:4%">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <script>
                                $(document).ready(function () {
                                    $('#table').DataTable({
                                        processing: true,
                                        serverSide: true,
                                        ajax: {
                                            type: 'POST',
                                            url: '{{route("siswa_person_data")}}',
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
                                            {data: 'edit', name: 'action', orderable: false, searchable: false}
                                        ],
                                        "columnDefs": [
                                            {
                                                "targets": [1],
                                                "visible": false
                                            },
                                            {
                                                "targets": [2],
                                                "visible": false
                                            },
                                            {
                                                "targets": [3],
                                                "visible": false
                                            },
                                            {
                                                "targets": [4],
                                                "visible": false
                                            },
                                            {
                                                "targets": [5],
                                                "visible": false
                                            }
                                        ]
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        
    </div>
</section>

@endsection
