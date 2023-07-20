@extends('partials.template')

@section('page_style')
<style>
    div.dataTables_wrapper div.dataTables_filter label,
    div.dataTables_wrapper div.dataTables_length label {
        margin-left: 1.5rem;
        margin-right: 1.5rem;
    }

    div.dataTables_wrapper div.dataTables_paginate ul.pagination {
        margin-right: 1.5rem;
    }

    div.dataTables_wrapper .dataTables_info {
        margin-left: 1.5rem;
    }
</style>
@endsection

@section('main')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="row breadcrumbs-top">
            <div class="col-12 mb-1">
                <a href="/kalender_ln"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
            </div>
            <div class="col-12">
                <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Jadwal Penugasan LN</h2>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group form-input col-md-3 col-12">
                                    <label class="form-label">Batalyon</label>
                                    <select class="select2 form-control">
                                        <option selected disabled>Pilih Batalyon</option>
                                        <option>YONIF 725 WOROAGI</option>
                                    </select>
                                </div>
                                <div class="form-group form-input col-md-3 col-12">
                                    <label class="form-label">Satgas Ops</label>
                                    <select class="select2 form-control">
                                        <option selected disabled>Pilih Satgas Ops</option>
                                        <option>PAMTAS RI - PNG SEKTOR TENGAH</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-12">             
                                    <div class="form-group form-input">
                                        <label class="form-label">Tanggal Berangkat</label>
                                        <input type="text" class="form-control flatpickr-basic" placeholder="Tanggal Berangkat"/>
                                    </div>                                           
                                </div>
                                <div class="col-md-3 col-12">             
                                    <div class="form-group form-input">
                                        <label class="form-label">Tanggal Pulang</label>
                                        <input type="text" class="form-control flatpickr-basic" placeholder="Tanggal Pulang"/>
                                    </div>                                           
                                </div>
                                <div class="form-group col-12">
                                    <label>Nota Dinas</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" />
                                        <label class="custom-file-label">Nota Dinas</label>
                                    </div>
                                </div>
                                <div class="form-group form-input col-12">
                                    <label class="form-label">Status</label>
                                    <select class="select2 form-control">
                                        <option selected disabled>Pilih Status</option>
                                        <option>Berangkat</option>
                                        <option>Belum Berangkat</option>
                                        <option>Gagal</option>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label class="form-label">Keterangan</label>
                                    <textarea class="form-control" rows="3" name="keterangan" id="keterangan"></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="font-weight-bolder mt-2">Pos Penugasan</h5>
                                </div>
                                <div class="col-12">
                                    <div class="border rounded">
                                        <table class="table table-striped" id="pos">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th style="min-width: 150px;">Pos Satgas</th>
                                                    <th style="min-width: 200px;">Nama Personil</th>
                                                    <th>No Telepon</th>
                                                    <th>Jumlah Personil</th>
                                                    <th>Bekkes Tambahan</th>
                                                    <th>Keterangan</th>
                                                    <th class="text-center">Detail Bekkes</th>
                                                    <th class="text-center" style="min-width: 100px;">Aksi</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>

                                <!-- Modal Detail Bekkes-->
                                <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Detail Bekkes Pos SIMPANG PNG</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>KAT PRAPAS</th>
                                                                <th>KAT DOKTER</th>
                                                                <th>KAT WAT</th>
                                                                <th>KAT BANWAT</th>
                                                                <th>KAT AMBULANS</th>
                                                                <th>KAT PRATUGAS</th>
                                                                <th>KAT POS SATGASOPS</th>
                                                                <th>KAT SERPAS</th>
                                                                <th>KAT KESYON</th>
                                                                <th>KAT ENDEMIK A</th>
                                                                <th>KAT ENDEMIK B</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@section('page_script')
<script>
    var table = $('#pos').DataTable({
        ajax: "{{ url('/app-assets/data/penugasan-dn.json') }}",
        scrollX: true,
        columns: [
            {
                data: 'no'
            },
            {
                data: 'pos'
            },
            {
                data: 'personil'
            },
            {
                data: 'telp'
            },
            {
                data: 'jml'
            },
            {
                data: 'bekkes'
            },
            {
                data: 'ket'
            },
            {
                data: 'detail'
            },
            {
                data: 'action'
            }
        ],
        "drawCallback": function(settings) {
            feather.replace();
        }
    });
</script>
@endsection