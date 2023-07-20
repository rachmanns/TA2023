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

        .flatpickr-wrapper {
            display: block;
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
                        <div class="col-12">
                            <h2 class="content-header-title float-left">Data Usulan Kenaikan Pangkat - 2023</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="input-group input-group-merge form-input">
                                <input type="text" id="tahun" class="yearpicker form-control bg-white cursor-pointer"
                                    placeholder="Tahun" readonly />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i data-feather="calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-12 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#ukp">Buat UKP</button>

                            {{-- Modal UKP --}}
                            <div class="modal fade text-left" id="ukp" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel18" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel18">Buat UKP</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('bidum.personil.store_ukp') }}" class="default-form">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="form-label" for="periode">Tanggal UKP</label>
                                                    <input type="text" id="periode" class="form-control flatpickr-basic"
                                                        placeholder="Tanggal UKP" name="periode" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="pilih">Pilih Perwira/PNS</label>
                                                    <select id="id_personil" name="id_personil"
                                                        class="select2 form-control form-control-lg">
                                                        <option disabled selected>Pilih Perwira/PNS</option>
                                                        @foreach ($personil as $item)
                                                            <option value="{{ $item->id_personil }}">{{ $item->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <input type="hidden" name="pangkat_terakhir" id="pangkat_terakhir">
                                                <input type="hidden" name="tmt_pangkat_terakhir" id="tmt_pangkat_terakhir">
                                                <div class="card bg-light border mb-1">
                                                    <div class="card-body">
                                                        <table>
                                                            <tr>
                                                                <th class="width-250">Nama Lengkap</th>
                                                                <th class="width-50">:</th>
                                                                <th id="text-nama"></th>
                                                            </tr>
                                                            <tr>
                                                                <th>Pangkat Terakhir</th>
                                                                <th class="width-50">:</th>
                                                                <th id="text-pangkat-terakhir"></th>
                                                            </tr>
                                                            <tr>
                                                                <th>TMT Pangkat Terakhir</th>
                                                                <th class="width-50">:</th>
                                                                <th id="text-tmt-pangkat-terakhir"></th>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="tgl">Tanggal Kenkat</label>
                                                    <input type="text" id="target_tmt_kenkat" name="target_tmt_kenkat" class="form-control flatpickr-basic" placeholder="Tanggal Kenkat" />

                                                    <!-- <input type="text" id="target_tmt_kenkat" name="target_tmt_kenkat" class="form-control" readonly/> -->
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
            </div>
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="table table-striped table-responsive-xl" id="list-ukp">
                                        <thead>
                                            <tr>
                                                <th>Nama Personil</th>
                                                <th>Pangkat Saat Ini</th>
                                                <th>TMT Pangkat</th>
                                                <th>Periode UKP</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Multilingual -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>

        $(".flatpickr-basic").flatpickr({
            static: true,
        });

        $(function(){
            get_ukp('{{ $tahun }}');
        });

        $("#tahun").yearpicker({year: {{ $tahun }}})

        $(document).on('change', '#tahun', function() {
            get_ukp($(this).val());
            $('.content-header-title').text(`Data Usulan Kenaikan Pangkat - ${$(this).val()}`)
        });

        function get_ukp(tahun) {
            var table = $('#list-ukp').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('bidum/personil/ukp-list') }}",
                    method: 'POST',
                    data: {tahun: tahun},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [{
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'pangkat_terakhir',
                        name: 'pangkat_terakhir'
                    },
                    {
                        data: 'tmt_pangkat_terakhir',
                        name: 'tmt_pangkat_terakhir'
                    },
                    {
                        data: 'periode',
                        name: 'periode'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });
        }

        $('#id_personil').change(function() {
            var id_personil = $(this).val();
            var url = "{{ route('bidum.personil.get_personil', ':id_personil') }}";
            url = url.replace(':id_personil', id_personil);

            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    $('#text-nama').text(response.nama)
                    $('#text-pangkat-terakhir').text(response.nama_pangkat_terakhir)
                    $('#pangkat_terakhir').val(response.nama_pangkat_terakhir)
                    $('#text-tmt-pangkat-terakhir').text(response.tmt_pangkat_terakhir)
                    $('#tmt_pangkat_terakhir').val(response.tmt_pangkat_terakhir)
                }
            });
        })

        $('#periode').change(function() {
            var periode = $(this).val();
            var date = new Date(periode);
            var month = date.getMonth() + 1;
            var year = date.getFullYear();

            if (month == 4) {
                kenkat = `${year}-10-01`;
            } else if (month == 10) {
                year = year + 1;
                kenkat = `${year}-04-01`;
            }
            $('#target_tmt_kenkat').val(kenkat);

        })

        $("#ukp").on("hide.bs.modal", function() {

            $("#myModalLabel18").html("Buat UKP")
            $("#text-nama").html("")
            $("#text-pangkat-terakhir").html("")
            $("#text-tmt-pangkat-terakhir").html("")
            $('#ukp form')[0].reset();
            // $('#spesialis form').attr('action', "{{ url('bangkes/jenis-spesialis') }}");
            // $("[name='_method']").val("POST");
            $("#id_personil").val('').trigger('change');

        });
    </script>
@endsection
