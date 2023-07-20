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
                    <a href="{{ url('/lafibiovak/renprod') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">Detail Renprod</h2>
                </div>
            </div>
            <style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0;}
                .tg td{border-color:black;border-style:solid;border-width:1px;font-size:12px;
                  overflow:hidden;padding:5px 5px;word-break:normal;}
                .tg th{border-color:black;border-style:solid;border-width:1px;;font-size:10px;
                  font-weight:normal;overflow:hidden;padding:5px 5px;word-break:normal;}
                .tg .tg-gvcd{background-color:#ffffff;border-color:#ffffff;text-align:left;vertical-align:top;font-size: 15px}
                .tg .tg-v0nz{background-color:#ffffff;border-color:#ffffff;text-align:left;vertical-align:top;font-size: 15px}
                </style>  
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-1">
                            <div class="card-body">
                                        <table class="tg">
                                                <tr>
                                                    <td class="tg-v0nz" style="width: 200px">Nama Produk</td>
                                                    <td class="tg-v0nz">:</td>
                                                    <td class="tg-gvcd font-weight-bolder">{{$data->kemasan->produk->nama_produk}} / {{$data->kemasan->satuan_produk->nama_satuan}} / {{$data->kemasan->nama_kemasan}}</td>
                                                    <td class="tg-v0nz" style="width: 100px"></td>
                                                    <td class="tg-v0nz" style="width: 250px">Tahun Anggaran</td>
                                                    <td class="tg-v0nz">:</td>
                                                    <td class="tg-gvcd font-weight-bolder">{{$data->periode_produksi}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-v0nz" style="width: 200px">Bets</td>
                                                    <td class="tg-v0nz">:</td>
                                                    <td class="tg-gvcd font-weight-bolder">{{$data->kemasan->bets}}</td>
                                                    <td class="tg-v0nz"></td>
                                                    <td class="tg-v0nz" style="width: 250px">Jumlah Renbut (RKO)</td>
                                                    <td class="tg-v0nz">:</td>
                                                    <td class="tg-gvcd font-weight-bolder">{{$data->rko}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-v0nz" style="width: 200px">Persediaan Awal</td>
                                                    <td class="tg-v0nz">:</td>
                                                    <td class="tg-gvcd font-weight-bolder">{{$data->persediaan}}</td>
                                                    <td class="tg-v0nz"></td>
                                                    <td class="tg-v0nz" style="width: 250px">Jumlah Batch</td>
                                                    <td class="tg-v0nz">:</td>
                                                    <td class="tg-gvcd font-weight-bolder">{{$data->jml_spp}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-v0nz" style="width: 200px">Jumlah Renprod</td>
                                                    <td class="tg-v0nz">:</td>
                                                    <td class="tg-gvcd font-weight-bolder">{{$data->renprod}}</td>
                                                    <td class="tg-v0nz"></td>
                                                    <td class="tg-v0nz" style="width: 250px">Assign Ke Lafi</td>
                                                    <td class="tg-v0nz">:</td>
                                                    <td class="tg-gvcd">
                                                    @foreach($data->lafi as $d)
                                                        <div class="badge badge-light-primary badge-sm mr-25">
                                                            {{$d->pel}}
                                                        </div>
                                                    @endforeach
                                                    </td>
                                                </tr>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12 mb-1 mt-1">
                            <h4 class="content-header-title float-left">Daftar Produksi</h4>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="renprod">
                                    <thead>
                                        <tr>
                                            <th>Nama Lafi</th>
                                            <th class="text-center">Jumlah Bets</th>
                                            @foreach($kat as $k)
                                            <th class="text-center">{{$k->nama_kategori}}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
    <!-- END: Content-->
@endsection

@section('page_script')
    <script>
        $('#renprod').DataTable({
            ajax: "{{ url('/lafibiovak/renprod/list-bahan-produksi/' . request()->segment(4)) }}",
            columns: [
                {
                    data: 'nama_lafi',
                },
                {
                    data: 'jumlah_bets',
                    className: 'text-center',
                },
                @foreach($kat as $k)
                {
                    data: '{{$k->id_kategori}}',
                },
                @endforeach
            ],
            "drawCallback": function(settings) {
                feather.replace();
            }

        });
    </script>
@endsection