@extends('partials.template')

@section('page_style')
    <style>
        .fc-license-message {
            display: none !important
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
    </style>
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/monthpicker.css')}}">
    <script src="{{ url('assets/js/monthpicker.js')}}"></script>
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
                        <div class="col-md-12 col-12">
                            <h2 class="content-header-title float-left">Timeline Produksi</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="content-header-left text-md-left col-md-2 col-12 d-md-block d-none">
                    <input type="text" id="periode" class="form-control bg-white" placeholder="Periode" />
                </div>
                <div class="content-header-left text-md-left col-md-4 col-12 d-md-block d-none">
                    <select class="select2 form-control form-control-lg" id="fprod">
                        <option value="*" selected>Semua Produk</option>
                        @foreach($prods as $p)
                        <option value="{{$p->id_kemasan}}">{{$p->produk->nama_produk}} / {{$p->satuan_produk->nama_satuan}} / {{$p->nama_kemasan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="content-header-left text-md-left col-md-2 col-12 d-md-block d-none">
                @if(!isset(Auth::user()->id_faskes))
                    <select class="select2 form-control form-control-lg" id="flafi">
                        <option value="*" selected>Semua Lafi</option>
                        <option value="Lafiad">Lafi Puskesad</option>
                        <option>Lafial</option>
                        <option>Lafiau</option>
                        <option value="Labiovak">Labiovak Puskesad</option>
                        <option value="Labiomed">Labiomed Puskesad</option>
                    </select>
                @endif
                </div>
                @if(isset(Auth::user()->id_faskes))
                <div class="text-right col-md-4 col-12 d-md-block d-none">
                    <a href="/lafibiovak/renprod?produksi=true"><button class="btn btn-primary">Edit Timeline Produksi</button></a>
                </div>
                @endif
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="position-relative">
                            <div class="card shadow-none border-0 mb-0 rounded">
                                <div class="card-body pb-0">
                                    <div id="coba"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade text-left" id="calendarModal" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel18" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel18">Edit Status Produksi</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group form-input">
                                    <label class="form-label">No. Bets</label>
                                    <input type="text" class="form-control" id="nobets" readonly />
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">Tahap Produksi</label>
                                    <input type="text" class="form-control" id="tahap" readonly />
                                </div>
                                <div>
                                    <label class="form-label">Lafi Kecil</label>
                                    <input type="text" class="form-control" id="lafik" readonly />
                                </div>
                                <div class="mt-1">
                                    <label class="form-label">Status</label>
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="belum" name="status" value="Belum Mulai"
                                                    class="custom-control-input" />
                                                <label class="custom-control-label" for="belum">Belum Mulai</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="berla" name="status" value="Berlangsung"
                                                    class="custom-control-input" />
                                                <label class="custom-control-label" for="berla">Berlangsung</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="seles" name="status" value="Selesai"
                                                    class="custom-control-input" />
                                                <label class="custom-control-label" for="seles">Selesai</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Simpan Data</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('page_js')
    <script src="{{ url('assets/js/fullcalendar-main.min.js') }}"></script>
    <script src="{{ url('assets/js/fullcalendar-locales-all.min.js') }}"></script>
@endsection

@section('page_script')
    <script>
        var calendar, id;
        document.addEventListener('DOMContentLoaded', function() {
            $('#periode').flatpickr({
                altInput: true,
                altFormat: 'F Y',
                defaultDate: '{{date("Y-m")}}',
                plugins: [
                    new monthSelectPlugin({
                        dateFormat: "Y-m",
                    })
                ]
            });
            $('#periode').change(function() {
                loadCalendar();
            });
            $('#flafi').change(function() {
                loadCalendar();
            });
            $('#fprod').change(function() {
                loadCalendar();
            });
            $(".modal-footer button").click(function() {
                $(this).prop('disabled', true);
                $(this).text('Menyimpan...');
                $.ajax({
                    url: "{{ url('lafibiovak/produksi/update-status') }}",
                    method: 'post',
                    dataType: "json",
                    data: 'status=' + $('input[name=status]:checked').val() + '&_id=' + id + '&_token=' + $('[name="csrf-token"]').attr('content'),
                    success: function(res) {
                        if (!res.error) {
                            Swal.fire({
                                title: 'Info',
                                text: res.message,
                                icon: 'info',
                            });
                            loadCalendar();
                        }
                    }
                }).always(function() {
                    $(".modal-footer button").prop('disabled', false);
                    $(".modal-footer button").text('Simpan');
                    $('#calendarModal').modal('hide');
                });
            });
            function fetchEvents(info, successCallback) {
                // Fetch Events from API endpoint reference
                param = 'periode=' + info.startStr.substr(0, 7);
                if ($('#flafi').val() != null && $('#flafi').val() != '*') param += '&lafi=' + $('#flafi').val();
                if ($('#fprod').val() != '*') param += '&prod=' + $('#fprod').val();

                $.ajax({
                    url: '{{ url("lafibiovak/produksi/list") }}?' + param,
                    type: 'GET',
                    success: function(result) {
                        // Get requested calendars as Array
                        successCallback(result.data);
                    },
                    error: function(error) {
                        // console.log(error);
                    }
                });

            }

          function loadCalendar() {
            var calendarEl = document.getElementById('coba');

            calendar = new FullCalendar.Calendar(calendarEl, {
                navLinks: true,
                height: 300,
                initialView: 'resourceTimelineMonth',
                height: '70%',
                dayHeaders: true,
                html: true,
                initialDate: $('#periode').val(),
                editable: false,
                locale: 'id',
                eventClick: function(event, jsEvent, view) {
                    var d = event.event._def.extendedProps;
                    $('#nobets').val(d.no_bets);
                    $('#tahap').val(d.nama_tahap);
                    $('#lafik').val(d.lafi);
                    $('#' + d.status.substr(0, 5).toLowerCase()).prop('checked', true).trigger('change');
                    id = d.id_progress;
                    $('#calendarModal').modal();
                },
                resourceAreaHeaderContent: 'Produk',
                refetchResourcesOnNavigate: true,
                resources: function(fetchInfo, successCallback, failureCallback) {
                    param = 'periode=' + fetchInfo.startStr.substr(0, 7);
                    if ($('#flafi').val() != null && $('#flafi').val() != '*') param += '&lafi=' + $('#flafi').val();
                    if ($('#fprod').val() != '*') param += '&prod=' + $('#fprod').val();
                    $.ajax({
                        url: '{{ url("lafibiovak/produksi/list-produk") }}?' + param,
                        type: 'GET',
                        success: function(result) {
                            successCallback(result.data);
                        },
                        error: function(error) {
                            // console.log(error);
                        }
                    });
                },
                events: fetchEvents,
                eventContent: function(info){
                    return {html: info.event.title};
                }

            });

            calendar.render();
          }
            loadCalendar();
        });
    </script>
@endsection
