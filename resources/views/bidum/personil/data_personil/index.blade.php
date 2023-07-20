@extends('partials.template')

@section('page_style')
    <style>
        .underline {
            text-decoration: underline;
        }

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

        table td {
            word-wrap: break-word;
            max-width: 200px;
        }
    </style>
@endsection
@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-10">
                            <h2 class="content-header-title float-left mb-0">Daftar Personil</h2>
                        </div>
                        <div class="col-2 text-right">
                            <i data-feather="settings" class="font-medium-5 cursor-pointer text-primary" data-toggle="modal"
                                data-target="#setting"></i>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{-- Modal Setting --}}
                        <div class="modal fade text-left" id="setting" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel18" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel18">Setting Data Personil</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($config == null)
                                            <form action="{{ route('bidum.personil.store_config_data_personil') }}"
                                                class="default-form">
                                            @else
                                                <form
                                                    action="{{ route('bidum.personil.update_config_data_personil', $config->id_config) }}"
                                                    class="default-form">
                                        @endif
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label" for="dsp">DSP</label>
                                            <input type="number" id="dsp" class="form-control" placeholder="Terisi"
                                                name="var_dsp" value="{{ $config == null ? '' : $config->var_dsp }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="jabatan">Jabatan Penanda Tangan RH</label>
                                            <input type="text" id="jabatan" class="form-control" placeholder="Jabatan" name="jabatan" value="{{ $config->jabatan ?? null }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="rh">Penanda Tangan RH</label>
                                            <select id="rh" name="var_rh" class="select2 form-control form-control-lg">
                                                <option disabled selected>Penanda Tangan RH</option>
                                                @foreach ($personil as $item)
                                                    <option
                                                        @if ($config != null) {{ $config->var_rh == $item->id_personil ? 'selected' : '' }} @endif
                                                        value="{{ $item->id_personil }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group form-input">
                                            <label class="form-label" for="batas_pensiun">Batas Pensiun Bintara (Tahun)</label>
                                            <input type="number" id="batas_pensiun" class="form-control"
                                                placeholder="Bintara" name="pensiun_bintara"
                                                value="{{ $config == null ? '' : $config->pensiun_bintara }}" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input">
                                            <label class="form-label" for="batas_pensiun">Batas Pensiun Tamtama (Tahun)</label>
                                            <input type="number" id="batas_pensiun" class="form-control"
                                                placeholder="Tamtama" name="pensiun_tamtama"
                                                value="{{ $config == null ? '' : $config->pensiun_tamtama }}"/>
                                                <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input">
                                            <label class="form-label" for="batas_pensiun">Batas Pensiun Perwira (Tahun)</label>
                                            <input type="number" id="batas_pensiun" class="form-control"
                                                placeholder="Perwira" name="pensiun_perwira"
                                                value="{{ $config == null ? '' : $config->pensiun_perwira }}" />
                                                <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input">
                                            <label class="form-label" for="batas_pensiun">Batas Pensiun PNS (Tahun)</label>
                                            <input type="number" id="batas_pensiun" class="form-control" placeholder="PNS"
                                                name="pensiun_pns"
                                                value="{{ $config == null ? '' : $config->pensiun_pns }}" />
                                                <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="alert alert-primary" role="alert">
                        <div class="alert-body text-primary font-weight-bolder">
                            <div class="row">
                                <div class="col-6">
                                    DSP : {{ $dsp }}
                                </div>
                                <div class="col-6 text-right">
                                    RIIL : {{ $riil }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12 text-right">
                    <div class="btn-group">
                        <a class="btn btn-outline-primary mr-75" href="{{ route('bidum.personil.cetak_nominatif') }}"
                            target="_blank">Cetak Nominatif</a>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-primary" href="{{ route('bidum.personil.create_data_personil') }}">Tambah
                            Personil</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <select id="id_kategori" class="select2 form-control">
                        <option value="all">All</option>
                        @foreach ($kategori as $k)
                            <option value="{{ $k->id_kategori }}" {{ $k->id_kategori == 1?'selected':'' }}>{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="table table-striped table-responsive-xl" id="table-personil">
                                        <thead>
                                            <tr>
                                                <th>Nama Lengkap</th>
                                                <th>Pangkat</th>
                                                <th>Korps</th>
                                                <th>Nrp</th>
                                                <th>Jabatan</th>
                                                <th>Matra</th>
                                                <th>Status</th>
                                                <th class="text-center" style="min-width: 100px;">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        $(function() {
            personil_list($('#id_kategori').val());
        });

        $('#id_kategori').change(function() {
            personil_list($(this).val());
        })

        function personil_list(id_kategori) {
            var table = $('#table-personil').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                order: [],
                ajax: {
                    url: "{{ route('bidum.personil.list_data_personil') }}",
                    method: 'POST',
                    data: {id_kategori:id_kategori},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [{
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'nama_pangkat',
                        name: 'nama_pangkat'
                    },
                    {
                        data: 'kode_korps',
                        name: 'kode_korps'
                    },
                    {
                        data: 'nrp',
                        name: 'nrp'
                    },
                    {
                        data: 'nama_jabatan_terakhir',
                        name: 'nama_jabatan_terakhir'
                    },
                    {
                        data: 'kode_matra',
                        name: 'kode_matra'
                    },
                    {
                        data: 'kategori.nama_kategori',
                        name: 'kategori.nama_kategori'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });
        }
    </script>
@endsection
