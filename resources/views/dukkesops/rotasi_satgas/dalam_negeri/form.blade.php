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
                <a href="{{ url('dukkesops/rotasi-satgas/'.request()->segment(4)) }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
            </div>
            <div class="col-12">
                <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Rotasi Pos Satgas</h2>
            </div>
        </div>
        @if (isset($penugasan_satgas))
            <form action="{{ url('dukkesops/rotasi-satgas/'.$penugasan_satgas->id_tugas) }}" class="default-form" autocomplete="off">
                @method('PUT')
        @else
            <form action="{{ url('dukkesops/rotasi-satgas') }}" class="default-form" autocomplete="off" method="POST">
        @endif
            @csrf
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group form-input">
                                    <label class="form-label">Satgas Ops</label>
                                    @if (isset($penugasan_satgas))
                                        <input type="text" value="{{ $penugasan_satgas->nama_satgas }}" class="form-control" readonly>
                                        <input type="hidden" name="id_satgas_ops" value="{{ $penugasan_satgas->id_satgas_ops }}">
                                    @else
                                        <select class="select2 form-control" name="id_satgas_ops" id="id_satgas_ops">
                                            <option selected disabled>Pilih Satgas Ops</option>
                                            @foreach ($satgas_ops as $so)
                                                <option value="{{ $so->id_satgas_ops }}">{{ $so->nama_kat_satgas }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <div class="invalid-feedback">Harap pilih satgas terlebih dahulu.</div>
                                </div>
                                {{-- <div class="form-group form-input">
                                    <label class="form-label">Batalyon</label>
                                    <input type="text" class="form-control" placeholder="Batalyon" name="nama_batalyon" value="{{ $penugasan_satgas->nama_batalyon ?? null }}"/>
                                    <div class="invalid-feedback"></div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group form-input">
                                            <label class="form-label">Tanggal Berangkat</label>
                                            <input type="text" class="form-control flatpickr-basic" placeholder="Tanggal Berangkat" name="dept_date" value="{{ $penugasan_satgas->dept_date ?? null }}"/>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group form-input">
                                            <label class="form-label">Tanggal Pulang</label>
                                            <input type="text" class="form-control flatpickr-basic" placeholder="Tanggal Pulang" name="arrv_date" value="{{ $penugasan_satgas->arrv_date ?? null }}"/>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                @if (isset($penugasan_satgas))
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label">Batalyon</label>
                                                <input type="text" class="form-control" placeholder="Batalyon" name="nama_batalyon" value="{{ $penugasan_satgas->nama_batalyon ?? null }}"/>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-12 mb-1">
                                            <label for="">Apakah banyak batalyon?</label>
                                            <div class="demo-inline-spacing">
                                            <div class="custom-control custom-radio mt-0">
                                                <input class="custom-control-input batalyon_check" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="tidak" onclick="show1();">
                                                <label class="custom-control-label" for="inlineRadio2">Tidak</label>
                                            </div>
                                            <div class="custom-control custom-radio mt-0">
                                                <input class="custom-control-input batalyon_check" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="ya" onclick="show2();">
                                                <label class="custom-control-label" for="inlineRadio1">Ya</label>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div id="message" style="display: none;">
                                                <div class="demo-spacing-0">
                                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                                        <div class="alert-body">
                                                            Harap pilih satgas terlebih dahulu.
                                                        </div>
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="field_batalyon"></div>
                                </div>
                                @endif
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Simpan Data</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<!-- END: Content-->
@endsection
@section('page_script')
    <script>

        function show1(){
            document.getElementById('message').style.display ='none';
        }
        function show2(){
            document.getElementById('message').style.display = 'block';
        }

        let id_satgas_ops;
        let batalyon_check;

        $('.batalyon_check').change(function(){
            batalyon_check = $(this).val();
            field_batalyon(batalyon_check, id_satgas_ops);
        })

        $('#id_satgas_ops').change(function(){
            id_satgas_ops = $(this).val()
            field_batalyon(batalyon_check, id_satgas_ops);
        })

        function field_batalyon(batalyon_check, id_satgas_ops) {
            $.ajax({
                method: "POST",
                url: `{{ url('dukkesops/rotasi-satgas/field-batalyon') }}`,
                data: { _token: "{{ csrf_token() }}", batalyon_check: batalyon_check, id_satgas_ops:id_satgas_ops },
                success: function (response) {
                    $('#field_batalyon').html(response);
                }
            })
        }
        
    </script>
@endsection