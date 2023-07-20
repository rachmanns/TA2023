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
                <div class="col-12 mb-1">
                    <a href="{{ url('bidum/anggaran/realisasi-pertahun') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Realisasi Anggaran - <span id="periode-text"></span></h2>
                        </div>
                    </div>
                </div>
            </div>
            @if (\Session::has('error'))
                <div class="alert alert-danger">
                    <ul>
                        <li>{!! \Session::get('error') !!}</li>
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-3">
                    <div class="input-group input-group-merge bg-white">
                        <input type="text" id="fp-range" class="form-control" placeholder="Filter Tanggal" />
                        <input type="hidden" name="" id="from_date" value="{{ $from_date }}">
                        <input type="hidden" name="" id="to_date" value="{{ $to_date }}">
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-9 text-right">
                    <!-- <button class="btn btn-outline-primary mr-75" data-toggle="modal" data-target="#defaultSize">Import Realisasi</button> -->
                    @include('bidum.anggaran.realisasi_harian.modal_create', [
                        'bidang' => $bidang,
                    ])

                    <!-- Modal Import-->
                    <div class="modal fade text-left" id="defaultSize" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel18" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel18">Import Realisasi Anggaran</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('bidum.anggaran.realisasi_import') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="customFile1">Pilih File Realisasi Anggaran</label>
                                        <div class="custom-file">
                                            <input type="file" name="file" class="custom-file-input" id="customFile1" required />
                                            <label class="custom-file-label" for="customFile1">Tambah File</label>
                                        </div>
                                    </div>
                                    <div class="text-right mt-25">
                                        <a href="{{ url('bidum/anggaran/realisasi/export-format') }}"><u> Download Format Excel </u></a>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <a data-toggle="modal" data-target="#add"><button type="button" class="btn btn-primary">Tambah Realisasi</button></a>
                    
                </div>
            </div>
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <nav class="nav-justified">
                                        <div class="nav nav-tabs mb-0" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active m-2 mb-0" id="nav-pusat-tab"
                                                data-toggle="tab" href="#nav-pusat" role="tab" aria-controls="nav-pusat"
                                                aria-selected="true"><span class="font-medium-4 font-weight-bolder">Dipa
                                                    Kewenangan Pusat</span></a>
                                            <a class="nav-item nav-link m-2 mb-0" id="nav-daerah-tab" data-toggle="tab"
                                                href="#nav-daerah" role="tab" aria-controls="nav-daerah"
                                                aria-selected="false"><span class="font-medium-4 font-weight-bolder">Dipa
                                                    Kewenangan Daerah</span></a>
                                        </div>
                                    </nav>
                                    <hr class="mb-0">
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-pusat" role="tabpanel"
                                            aria-labelledby="nav-pusat-tab">
                                            <table class="table table-striped table-responsive-lg" id="realisasi-pusat">
                                                <thead>
                                                    <tr>
                                                        <th>Bidang</th>
                                                        <th>Akun</th>
                                                        <th>Uraian</th>
                                                        <th>Tanggal Realisasi</th>
                                                        <th>Nilai Realisasi</th>
                                                        <th>Action</th>
                                                        {{-- <th>Kewenangan</th> --}}
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="nav-daerah" role="tabpanel"
                                            aria-labelledby="nav-daerah-tab">
                                            <table class="table table-striped table-responsive-lg" id="realisasi-daerah">
                                                <thead>
                                                    <tr>
                                                        <th>Bidang</th>
                                                        <th>Akun</th>
                                                        <th>Uraian</th>
                                                        <th>Tanggal Realisasi</th>
                                                        <th>Nilai Realisasi</th>
                                                        <th>Action</th>
                                                        {{-- <th>Kewenangan</th> --}}
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    {{-- <table class="dt-nasional table"> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Multilingual -->
            </div>
        </div>
    </div>
    <input type="hidden" id="val_kode_dipa">
    <!-- END: Content-->
@endsection
@section('page_js')
    <script src="{{ url('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
@endsection
@section('page_script')
    <script>
        $(function() {

            let from_date = "{{ $from_date }}";
            let to_date = "{{ $to_date }}";
            $('#periode-text').text(`(${moment(from_date).format('DD MMMM YYYY')} - ${moment(to_date).format('DD MMMM YYYY')})`)
            realisasi_list(from_date, to_date);

            $('#bidang').change(function() {
                $('#uraian').val(null).trigger('change')
            })

        });

        $("#fp-range").flatpickr({
            mode: 'range',
            onChange: function(selectedDate) {
                let _this = this;
                let dateArr = selectedDate.map(function(date) {
                    return _this.formatDate(date, 'Y-m-d');
                });

                let start = dateArr[0];
                let end = dateArr[1];
                $('#from_date').val(start)
                $('#to_date').val(end)

                $('#periode-text').text(`(${moment(start).format('DD MMMM YYYY')} - ${moment(end).format('DD MMMM YYYY')})`)

                realisasi_list(start, end);
            }
        })

        function realisasi_list(from_date,to_date) {
            let dipa_pusat = 'DIPPUS';
            let dipa_daerah = 'DIPDAR';
            let url = `{{ route('bidum.anggaran.realisasi_list', [':from_date', ':to_date', ':dipa']) }}`
            url = url.replace(':from_date', from_date);
            url = url.replace(':to_date', to_date);

            url_pusat = url.replace(':dipa', dipa_pusat);

            url_daerah = url.replace(':dipa', dipa_daerah);
            var table = $('#realisasi-pusat').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: url_pusat,
                columns: [{
                        data: 'kode_bidang',
                        name: 'uraian.kode_bidang',
                        visible: false
                    },
                    {
                        data: 'kode_akun',
                        name: 'uraian.kode_akun'
                    },
                    {
                        data: 'nama_uraian',
                        name: 'uraian.nama_uraian'
                    },
                    {
                        data: 'tgl_realisasi',
                        name: 'tgl_realisasi'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }

                ],
                order: [
                    [0, 'asc']
                ],
                drawCallback: function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;

                    api.column(0, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<th colspan="6" class="group text-center font-medium-4" style="background-color:#F3F2F7;">' +
                                group + '</th>'

                            );

                            last = group;
                        }
                    });
                    feather.replace();
                }
            });

            var table = $('#realisasi-daerah').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: url_daerah,
                columns: [{
                        data: 'kode_bidang',
                        name: 'uraian.kode_bidang',
                        visible: false
                    },
                    {
                        data: 'kode_akun',
                        name: 'uraian.kode_akun'
                    },
                    {
                        data: 'nama_uraian',
                        name: 'uraian.nama_uraian'
                    },
                    {
                        data: 'tgl_realisasi',
                        name: 'tgl_realisasi'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                    }

                ],
                order: [
                    [0, 'asc']
                ],
                drawCallback: function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;

                    api.column(0, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<th colspan="6" class="group text-center font-medium-4" style="background-color:#F3F2F7;">' +
                                group + '</th>'
                            );

                            last = group;
                        }
                    });
                    feather.replace();
                }
            })
        }

        $("#add").on("hide.bs.modal", function () {

            var reset_form = $('#add form')[0];
            reset_form.reset();
            $("#bidang").val("").trigger('change');
            $("#uraian").val("").trigger('change');
            
        });

        $("input[name='kode_dipa']").change(function(){
                
            $('#bidang').empty().trigger("change");
                
            select_ajax("{{ url('bidum/anggaran/realisasi/get-bidang') }}","bidang","Bidang",$(this).val())
            
            $("#bidang").prop("disabled", false);
            $("#uraian").prop("disabled", true);
            $("#uraian").val("");
            $("#uraian").trigger("change");
            $('#uraian').empty().trigger("change");
            $('#val_kode_dipa').val($(this).val());

        });

        $('#bidang').on('select2:select', function (e) {
            var data = e.params.data;
            var kode_dipa = $("#val_kode_dipa").val()

                $("#uraian").val("");
                $("#uraian").trigger("change");
                $('#uraian').empty().trigger("change");
                
                select_ajax("{{ url('bidum/anggaran/realisasi/get-uraian') }}","uraian","Uraian",kode_dipa,data.id)
                
                $("#uraian").prop("disabled", false);
            
        });    

        function select_ajax(url,type,placeholder,kode_dipa,kode_bidang=""){
            $.ajax({
                url: url+"/"+kode_dipa+"/"+kode_bidang, 
                method: "GET",
                dataType: "json",
                success: function (result) {

                    if ($('#'+type).data('select2')) {

                        $("#"+type).val("");
                        $("#"+type).trigger("change");
                        $("#"+type).empty().trigger("change");

                    }
                    
                    $("#"+type).select2({ data: result.data,placeholder: "Pilih "+placeholder,allowClear: true, dropdownParent: $("#add") });

                }
            });
        }

        function edit_realisasi(e) {
            let id_realisasi = e.attr('data-id');

            let action = `{{ url('bidum/anggaran/realisasi') }}/${id_realisasi}`;
            var url = `{{ url('bidum/anggaran/realisasi/edit') }}/${id_realisasi}`;


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#add').modal('show');
                    $("#modal-title").html("Edit Realisasi Anggaran")
                    $('#add form').attr('action', action);
                    $(`#${response.uraian.kode_dipa}`).prop("checked", true);
                    select_ajax("{{ url('bidum/anggaran/realisasi/get-bidang') }}","bidang","Bidang",response.uraian.kode_dipa)
                    setTimeout(function(){
                        $("#bidang").val(response.uraian.kode_bidang).trigger('change.select2')
                        select_ajax("{{ url('bidum/anggaran/realisasi/get-uraian') }}","uraian","Uraian",response.uraian.kode_dipa,response.uraian.kode_bidang)
                    }, 100);
                    var check_uraian = setInterval(function() {
                        if ($('#uraian option').length) {
                            $('#uraian').val(response.id_uraian).trigger('change.select2');
                            clearInterval(check_uraian);
                        }
                    }, 100);
                    const tgl_realisasi = $('#tgl_realisasi').flatpickr({
                        altInput: true,
                        altFormat: "j F Y",
                        dateFormat: "Y-m-d",
                        defaultDate: response.tgl_realisasi,
                    });
                    $('#jumlah').val(formatRupiah(response.jumlah.toString(),'Rp'));
                    $("[name='_method']").val("PUT");
                }
            });
        }

        $("#add").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Realisasi Anggaran")
            $('#add form')[0].reset();
            $('#add form').attr('action', "{{ route('bidum.anggaran.realisasi_store') }}");
            $("[name='_method']").val("POST");
            $("#bidang").empty();
            $("#uraian").empty();

        });
    </script>
    
    <script type="text/javascript">
        var rupiah = document.getElementById('jumlah');
        rupiah.addEventListener('keyup', function(e) {
            rupiah.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp' + rupiah : '');
        }
    </script>
@endsection
