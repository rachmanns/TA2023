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
                        <h2 class="content-header-title float-left">Rekap Dokter</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-1">
            <div class="content-header-left text-md-left col-md-3 col-12 d-md-block d-none">
                <select class="select2 form-control form-control-lg" id="matra">
                    <option disabled selected>Matra</option>
                    @foreach ($matra as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <div class="content-header-left text-md-left col-md-3 col-12 d-md-block d-none">
                <select class="select2 form-control form-control-lg" id="jenis_spesialis">
                    <option selected>Semua Spesialis</option>
                    @foreach ($jenis_spesialis as $js)
                        <option value="{{ $js->id_spesialis }}">{{ $js->nama_spesialis }}</option>
                    @endforeach
                </select>
            </div>
            <div class="content-header-left text-md-left col-md-3 col-12 d-md-block d-none">
                <select class="select2 form-control form-control-lg" id="id_kategori_dokter">
                    <option disabled selected>Kategori Dokter</option>
                    @foreach ($kategori_dokter as $kd)
                        <option value="{{ $kd->id_kategori_dokter }}">{{ $kd->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="content-body">
            <section id="multilingual-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <table class="table table-striped" id="dokter">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="min-width: 150px;">Kategori</th>
                                        <th style="min-width: 200px;">Nama</th>
                                        <th>Matra</th>
                                        <th style="min-width: 200px;">Pangkat/NRP/NIP</th>
                                        <th>Jabatan Struktural</th>
                                        <th>Jabatan Fungsional</th>
                                        <th style="min-width: 200px;">Ket</th>
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
@endsection
@section('page_script')
<script>

        let matra = '';
        let jenis_spesialis = '';
        let id_kategori_dokter = '';

        $(function(){
            get_rekap_dokter(matra,jenis_spesialis,id_kategori_dokter)
        })

        $('#matra').change(function(){
            matra = $(this).val();
            get_rekap_dokter(matra,jenis_spesialis,id_kategori_dokter);
        });

        $('#jenis_spesialis').change(function(){
            jenis_spesialis = $(this).val();
            get_rekap_dokter(matra,jenis_spesialis,id_kategori_dokter);
        });

        $('#id_kategori_dokter').change(function(){
            id_kategori_dokter = $(this).val();
            get_rekap_dokter(matra,jenis_spesialis,id_kategori_dokter);
        });

    function get_rekap_dokter(matra,jenis_spesialis,id_kategori_dokter) {

        let data = {
            matra:matra,
            jenis_spesialis:jenis_spesialis,
            id_kategori_dokter:id_kategori_dokter
        };

        $('#dokter').DataTable({
            destroy: true,
            // processing: true,
            // serverSide: true,
            scrollX: true,
            ajax: {
                url: "{{ url('bangkes/rekap-dokter/get') }}",
                method: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            columns: [
                {
                    data: 'kategori_dokter',
                    name: 'kategori_dokter'
                },
                {
                    data: 'nama_dokter',
                    name: 'nama_dokter',
                },
                {
                    data: 'matra',
                    name: 'matra'
                },
                {
                    data: 'pangkat_korps',
                    name: 'pangkat_korps'
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
                    data: 'keterangan',
                    name: 'keterangan'
                }
            ],
            "drawCallback": function(settings) {
                feather.replace();
            }
    
        });
    }

</script>
@endsection