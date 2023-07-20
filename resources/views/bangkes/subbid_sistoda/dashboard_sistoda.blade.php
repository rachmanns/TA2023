@extends('partials.template')

@section('page_style')
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/calendars/fullcalendar.min.css')}}">

    <style>
        .fc-h-event {
            border: #ffffff;
            border: 1px solid var(--fc-event-bg-color,#ffffff);
            background-color: #ffffff;
            background-color: var(--fc-event-border-color,#ffffff);
            padding: 0px;
        }

        .fc .fc-daygrid-event-harness .fc-event {
            white-space: unset !important;
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
                            <h2 class="content-header-title float-left mb-0">Dashboard Sistoda</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section>
                    <div class="row match-height">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Jumlah Buku</h4>
                                    @foreach ($jumlah_buku as $buku)
                                        <a data-id="{{ $buku->id_kat_buku }}" onclick="detail_jumlah($(this))"><div class="border rounded shadow p-2 mt-2">
                                        {{-- <a data-id="{{ $buku->id_kat_buku }}" data-toggle="modal" data-target="#detail" onclick="detail_jumlah($(this))"><div class="border rounded shadow p-2 mt-2"> --}}
                                            <div class="row">
                                                <div class="col-md-3 col-12">
                                                    <div class="avatar bg-light-danger p-50 m-0">
                                                        <div class="avatar-content">
                                                            <i data-feather="cpu" class="font-medium-5"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-12">
                                                    <h2 class="font-weight-bolder mb-0">{{ $buku->buku_count }}</h2>
                                                    <p class="card-text">{{ $buku->nama_kat_buku }}</p>
                                                </div>
                                            </div>
                                        </div></a>
                                    @endforeach

                                    <!-- Modal -->
                                    <div class="modal fade text-left" id="detail" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="modal-title">Detail Jumlah Buku ( Kategori: Perpang )</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                {{-- <form action="" autocomplete="off" method="POST"> --}}
                                                    <div class="modal-body p-0">
                                                        <table class="table table-striped" id="table-detail-buku">
                                                            <thead>
                                                                <tr>
                                                                    <th>No. Buku</th>
                                                                    <th style="min-width: 300px;">Judul</th>
                                                                    <th>Kategori</th>
                                                                    <th>Tahun Terbit</th>
                                                                    <th style="min-width: 300px;">Abstrak</th>
                                                                    <th class="text-center"  style="min-width: 150px;">File Buku</th>
                                                                    {{-- <th class="text-center" style="min-width: 100px;">Aksi</th> --}}
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                {{-- </form> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade text-left" id="detail-timeline" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="modal-title">Detail Sosialisasi</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="" autocomplete="off" method="POST">
                                                    <div class="modal-body">
                                                        <div class="row">                                    
                                                            <div class="col-md-12 col-12 mb-1">
                                                                <p class="card-text mb-0">Judul Buku</p>
                                                                <h4 class="font-weight-bolder" id="judul">PETUNJUK PENYELENGGARAAN PENGELOLAAN BIDANG FARMASI, BIOMEDIS DAN VAKSIN DI LINGKUNGAN TENTARA NASIONAL INDONESIA</h4>
                                                            </div>
                                                            <div class="col-md-3 col-6">
                                                                <p class="card-text mb-0">Tanggal</p>
                                                                <h4 class="font-weight-bolder" id="tgl">3 Februari 2022</h4>
                                                            </div>
                                                            <div class="col-md-2 col-6">
                                                                <p class="card-text mb-0">No. Buku</p>
                                                                <h4 class="font-weight-bolder" id="nomor">080501</h4>
                                                            </div>
                                                            <div class="col-md-3 col-6">
                                                                <p class="card-text mb-0">Jumlah Peserta</p>
                                                                <h4 class="font-weight-bolder" id="jml">40</h4>
                                                            </div>
                                                            <div class="col-md-4 col-6">
                                                                <p class="card-text mb-0">Lokasi Sosialisasi</p>
                                                                <h4 class="font-weight-bolder" id="lokasi">LAFIAD BANDUNG</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="app-calendar overflow-hidden border">
                                <div class="row no-gutters">
                                    <!-- Calendar -->
                                    <div class="col position-relative">
                                        <div class="card shadow-none border-0 mb-0 rounded-0">
                                            <div class="card-header">
                                                <h4>Timeline Kegiatan Sistoda</h4>
                                            </div>
                                            <div class="card-body pb-0">
                                                <div id="sistoda"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="body-content-overlay"></div>
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
    <script src="{{ url('app-assets/vendors/js/calendar/fullcalendar.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('sistoda');
            // document.getElementByTagName('sistoda')[0].style.color = 'white';

            var calendar = new FullCalendar.Calendar(calendarEl, {
                navLinks: true,
                height: 300,
                initialView: 'dayGridMonth',
                height: '70%',
                html: true,
                dayHeaders: true,
                initialDate: {!! json_encode($kegiatan_sistoda['initial_date']) !!},
                editable: false,
                eventContent: function( arg ) {
                return { html: arg.event.title };
            },
                events: 
                @if(!empty($kegiatan_sistoda['events']))
                    {!! json_encode($kegiatan_sistoda['events']) !!}
                @else
                    []            
                @endif,

                // eventClick: function(calEvent, jsEvent, view) {
                eventClick: function(info) {
                    let id = info.event._def.publicId;
                    let prefix = info.event._def.extendedProps.prefix;
                    $('#detail-timeline').modal();
                    $.ajax({
                        method: "GET",
                        url: `{{ url('bangkes/sistoda/detail-jadwal/${id}/${prefix}') }}`,
                        success:function(response){
                            $('#judul').text(response.judul)
                            $('#tgl').text(response.tgl)
                            $('#nomor').text(response.nomor)
                            $('#jml').text(response.jml)
                            $('#lokasi').text(response.lokasi)
                        },
                        error:function(jqXHR, textStatus, errorThrown){
                            alert('Data Not Found')
                        }
                    });
                }

            });

            calendar.render();
        });

        $('#table-detail-buku').DataTable({
            scrollX: true
        });

        $('#table-detail-timeline').DataTable({
            scrollX: true
        });

        function detail_jumlah(e) {
            let id_kat_buku = e.attr('data-id');
            $('#detail').modal('show');
            $('#table-detail-buku').DataTable({
                destroy: true,
                scrollX: true,
                ajax: `{{ url('/bangkes/sistoda/detail-jumlah/${id_kat_buku}') }}`,
                columns: [
                    {
                        data: 'no_buku',
                        name: 'no_buku'
                    },
                    {
                        data: 'nama_buku',
                        name: 'nama_buku'
                    },
                    {
                        data: 'kategori_buku.nama_kat_buku',
                        name: 'kategori_buku.nama_kat_buku'
                    },
                    {
                        data: 'tahun_terbit',
                        name: 'tahun_terbit'
                    },
                    {
                        data: 'abstraksi',
                        name: 'abstraksi'
                    },
                    {
                        data: 'file_buku',
                        name: 'file_buku'
                    },
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     searchable: false
                    // }
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }

            });
        }
    </script>
@endsection