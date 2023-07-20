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
                    <a href="{{ route('bangkes.calon-patubel.index') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">Detail Patubel</h2>
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
                                <div class="row">
                                    <div class="col-6" >
                                        <table class="tg">
                                            <thead>
                                                <tr>
                                                    <td class="tg-v0nz" style="width: 200px">Sebaran</td>
                                                    <td class="tg-v0nz">:</td>
                                                    <td class="tg-gvcd font-weight-bolder">{{ $nakes->rumah_sakit->nama_rs ?? '-'}}</td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="col-6">
                                        <table class="tg">
                                            <thead>
                                                <tr>
                                                    <td class="tg-v0nz" style="width: 250px">Pangkat/NRP/NIP</td>
                                                    <td class="tg-v0nz">:</td>
                                                    <td class="tg-gvcd font-weight-bolder">{{ $nakes->pangkat ?? $nakes->pangkat_korps ?? '-' }}/{{ $nakes->no_identitas }}</td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6" >
                                        <table class="tg">
                                            <thead>
                                                <tr>
                                                    <td class="tg-v0nz" style="width: 200px">Kategori</td>
                                                    <td class="tg-v0nz">:</td>
                                                    <td class="tg-gvcd font-weight-bolder">{{ $nakes->jenis_spesialis[0]->kategori_dokter->nama_kategori ?? ($nakes->jenis_paramedis->nama_jenis_paramedis ?? '-') }}</td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="col-6" >
                                        <table class="tg">
                                            <thead>
                                                <tr>
                                                    <td class="tg-v0nz" style="width: 250px">Jabatan Struktural</td>
                                                    <td class="tg-v0nz">:</td>
                                                    <td class="tg-gvcd font-weight-bolder">{{ $nakes->jabatan_struktural ?? '-' }}</td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6" >
                                        <table class="tg">
                                            <thead>
                                                <tr>
                                                    <td class="tg-v0nz" style="width: 200px">Spesialis</td>
                                                    <td class="tg-v0nz">:</td>
                                                    <td class="tg-gvcd font-weight-bolder">{{ $nakes->jenis_spesialis[0]->nama_spesialis ?? '-' }}</td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="col-6" >
                                        <table class="tg">
                                            <thead>
                                                <tr>
                                                    <td class="tg-v0nz" style="width: 250px">Jabatan Fungsional</td>
                                                    <td class="tg-v0nz">:</td>
                                                    <td class="tg-gvcd font-weight-bolder">{{ $nakes->jabatan_fungsional ?? '-' }}</td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6" >
                                        <table class="tg">
                                            <thead>
                                                <tr>
                                                    <td class="tg-v0nz" style="width: 200px">Nama</td>
                                                    <td class="tg-v0nz">:</td>
                                                    <td class="tg-gvcd font-weight-bolder">{{ $nakes->nama_dokter ?? ($nakes->nama_paramedis ?? '-') }}</td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="col-6" >
                                        <table class="tg">
                                            <thead>
                                                <tr>
                                                    <td class="tg-v0nz" style="width: 250px">Keterangan</td>
                                                    <td class="tg-v0nz">:</td>
                                                    <td class="tg-gvcd font-weight-bolder">{{ $nakes->keterangan ?? '-' }}</td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6" >
                                        <table class="tg">
                                            <thead>
                                                <tr>
                                                    <td class="tg-v0nz" style="width: 200px">Matra</td>
                                                    <td class="tg-v0nz">:</td>
                                                    <td class="tg-gvcd font-weight-bolder">{{ $nakes->matra ?? '-' }}</td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12 mb-1 mt-1">
                            <h4 class="content-header-title float-left">Riwayat Patubel</h4>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-lg" id="sprin">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Tahun Ajaran</th>
                                            <th>TMT</th>
                                            <th>Peminatan</th>
                                            <th>Tempat Pendidikan</th>
                                            <th>Dok Sprin</th>
                                            <th>Status</th>
                                            <th>Tanggal Lulus</th>
                                            <th>IPK</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
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
        $('#sprin').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('bangkes/calon-patubel/get-patubel-nakes') }}/"+"{{ $id_nakes }}",
            scrollX: true,
            columns: [
                {
                    data: 'tahun_ajaran',
                    name: 'tahun_ajaran'
                },
                {
                    data: 'tmt',
                    name: 'tmt',
                },
                {
                    data: 'peminatan',
                    name: 'peminatan'
                },
                {
                    data: 'kampus',
                    name: 'kampus'
                },
                {
                    data: 'file_sprin',
                    name: 'file_sprin'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'tgl_lulus',
                    name: 'tgl_lulus'
                },
                {
                    data: 'ipk',
                    name: 'ipk'
                }
            ],
            "drawCallback": function(settings) {
                feather.replace();
            }

        });
    </script>
@endsection