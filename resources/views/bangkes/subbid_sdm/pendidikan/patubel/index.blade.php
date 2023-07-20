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
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-md-10 col-10">
                            <h2 class="content-header-title float-left">Daftar Usul Calon Patubel</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="content-header-left text-md-left col-md-3 col-12 d-md-block d-none">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="tahun" class="yearpicker form-control bg-white cursor-pointer"
                            placeholder="Tahun" readonly />
                        <div class="input-group-append">
                            <span class="input-group-text" id="calendaricon"><i data-feather="calendar"></i></span>
                            <span id="clear" class="input-group-text" style="display: none;"><i
                                    data-feather='x'></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 text-right">
                    <a href="{{ route('bangkes.calon-patubel.create') }}"><button class="btn btn-primary">Tambah Data
                            Patubel</button></a>
                </div>
            </div>
            @include('bangkes.subbid_sdm.pendidikan.patubel.tmt')
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped" id="patubel">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 150px;">Tahun Ajaran</th>
                                            <th>Matra</th>
                                            <th style="min-width: 150px;">Asal Kesatuan</th>
                                            <th style="min-width: 200px;">Nama</th>
                                            <th>Pangkat/Korps</th>
                                            <th>NRP/NIP</th>
                                            <th>Jabatan Struktural</th>
                                            <th>Jabatan Fungsional</th>
                                            <th style="min-width: 150px;">Peminatan</th>
                                            <th>Status</th>
                                            <th class="text-center" style="min-width: 100px;">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @include('bangkes.subbid_sdm.pendidikan.patubel.tmt')
@endsection
@section('page_script')
    <script>
        $('#clear').click(function() {
            $('#tahun').val('');
            tahun = '';
            patubel_list(tahun);

            $('#clear').hide();
            $('#calendaricon').show();
        })

        $(document).ready(function() {
            patubel_list()

            $('#clear').hide();
            $('#calendaricon').show();
        });

        $('#tahun').change(function() {
            let tahun = $(this).val();
            patubel_list(tahun);

            $('#clear').show();
            $('#calendaricon').hide();
        })

        function patubel_list(tahun = '') {
            let data = {
                tahun: tahun
            }

            $('#patubel').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ url('bangkes/calon-patubel/get') }}",
                    method: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [{
                        data: 'tahun_ajaran',
                        name: 'tahun_ajaran'
                    },
                    {
                        data: 'matra',
                        name: 'matra'
                    },
                    {
                        data: 'satuan_asal',
                        name: 'satuan_asal'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'pangkat',
                        name: 'pangkat'
                    },
                    {
                        data: 'no_identitas',
                        name: 'no_identitas'
                    },
                    {
                        data: 'jabatan_struktural',
                        name: 'jabatan_struktural'
                    },
                    {
                        data: 'jabatan_fungsional',
                        name: 'jabatan_fungsional'
                    },
                    {
                        data: 'peminatan_kampus',
                        name: 'peminatan_kampus'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });
        }

        function toggleText() {
            var x = document.getElementById("show");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function hide() {
            document.getElementById('tanggal').style.display = 'none';
        }

        function show() {
            document.getElementById('tanggal').style.display = 'block';
        }

        var tmt_date = $("#tmt_date").flatpickr({
            mode: 'range',
            dateFormat: "d F Y",
            onChange: function(selectedDates) {
                var _this = this;
                var dateArr = selectedDates.map(function(date) {
                    return _this.formatDate(date, 'Y-m-d');
                });
                let start = dateArr[0];
                let end = dateArr[1];

                $('#tmt_awal').val(start);
                $('#tmt_akhir').val(end);
            }
        })

        function edit_patubel(e) {
            let id_patubel = e.attr('data-id');

            let action = `{{ url('bangkes/calon-patubel') }}/${id_patubel}`;
            var url = `{{ url('bangkes/calon-patubel') }}/${id_patubel}`;


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#tmt_modal form').attr('action', action);
                    if (response.tmt_awal != null && response.tmt_akhir != null) {
                        tmt_date.setDate([response.tmt_date_awal, response.tmt_date_akhir], false);
                        $('#tmt_awal').val(response.tmt_awal);
                        $('#tmt_akhir').val(response.tmt_akhir);
                    }
                    $('#tmt_modal').modal('show');
                }
            });
        }

        $("#tmt_modal").on("hide.bs.modal", function() {
            $('#tmt_modal form')[0].reset();
            $('#tmt_modal form').attr('action', "");
        });
    </script>
@endsection
