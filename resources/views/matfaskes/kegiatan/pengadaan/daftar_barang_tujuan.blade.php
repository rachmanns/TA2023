@extends('partials.template')
@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
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
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Daftar Barang</h2>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6 mt-50">
                    <h4 class="text-secondary">No Kontrak: {{ $kontrak->nomor_kontrak }}</h4>
                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-outline-primary mr-75" data-toggle="modal" data-target="#edit">Edit Daftar Barang</button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#impor">Tambah Daftar Barang</button>
                    @include('matfaskes.kegiatan.pengadaan.import_daftar_barang')
                    @include('matfaskes.kegiatan.pengadaan.edit_barang')
                </div>
            </div>
            <div class="card mb-1">
                <div class="card-body font-weight-bold">
                    TOTAL KESELURUHAN HARGA BARANG: Rp{{  number_format($total_harga, 0, ',', '.'); }}
                </div>
            </div>
            @error('file')
                <div class="demo-spacing-0">
                    <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                        <div class="alert-body">
                            <i data-feather="info" class="mr-50 align-middle"></i>
                            {{ $message }}
                        </div>
                    </div>
                </div>
            @enderror
            <div class="content-body">
                <section id="accordion-with-margin">
                    <div class="row">
                        <div class="col-sm-12 collapse-icon">
                            <div class="collapse-margin" id="accordionExample">
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
            $("#ada").click(function() {
                $("#check-ada").show();
            });

            $("#tidak-ada").click(function() {
                $("#check-ada").hide();
                $("#penerima").val(null);
                $("#tujuan_penggunaan").val(null);
            });

            $(".template").change(function () {
                let template = $(this).val();
                if (template == 'kat') {
                    $("#download_template").attr('href',"{{ url('matfaskes/pengadaan/download') }}");
                } else {
                    $("#download_template").attr('href',"{{ url('template/detail_barang') }}");
                }
            });

            let rencana_pengeluaran = {!! json_encode($data) !!}

            $.each(rencana_pengeluaran, function(key, value) {
                let url = window.location.protocol + "//" + window.location.host + "/" + 'matfaskes/pengadaan/daftar-barang/destroy-rencana-pengeluaran'
                let grouping_html = `
                    <div class="card">
                        <div class="card-header" id="headingOne" data-toggle="collapse" role="button" data-target="#collapseOne-${key}" aria-expanded="false" aria-controls="collapseOne">
                            <span class="lead collapse-title">Tujuan: ${value} (Total Jumlah Harga Barang: Rp0)</span>
                            ${key != 'other'? '<button title="Delete" type="button" data-id="'+key+'"  data-url="'+url+'" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button>':'' }
                        </div>

                        <div id="collapseOne-${key}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="table-responsive border rounded">
                                    <table class="table table-striped" id="${key}-table">
                                        <thead>
                                            <tr>
                                                <th>Kategori Bekkes/Alkes</th>
                                                <th>Nama Bekkes/Alkes</th>
                                                <th>Satuan</th>
                                                <th>Jumlah</th>
                                                <th>Harga Satuan</th>
                                                <th>Jumlah Harga</th>
                                                <th>Ket</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                $('#accordionExample').append(grouping_html)

                var table = $(`#${key}-table`).DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ url('matfaskes/pengadaan/daftar-barang/list-tujuan/') }}" +
                        '/{{ $kontrak->id_kontrak }}/kontrak/' + key,
                    columns: [{
                            data: 'kategori_barang',
                            name: 'kategori_barang',
                            visible: false
                        },
                        {
                            data: 'nama_matkes',
                            name: 'nama_matkes'
                        },
                        {
                            data: 'satuan_brg',
                            name: 'satuan_brg'
                        },
                        {
                            data: 'jumlah',
                            name: 'jumlah'
                        },
                        {
                            data: 'harga_satuan',
                            name: 'harga_satuan'
                        },
                        {
                            data: 'jumlah_harga',
                            name: 'jumlah_harga'
                        },
                        {
                            data: 'ket',
                            name: 'ket'
                        },

                    ],
                    order: [
                        [0, 'desc']
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
                                    `<th colspan="6" class="group text-center font-medium-1" style="background-color:#F3F2F7;">Kategori: ${(group !== null)?group:'Lainnya'}</th>`
                                );

                                last = group;
                            }
                        });
                    }
                })
            });
        });
    </script>
@endsection
