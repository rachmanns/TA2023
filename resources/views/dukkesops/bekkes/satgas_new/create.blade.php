@extends('partials.template')

@section('main')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="row breadcrumbs-top">
            <div class="col-12 mb-1">
                @if (isset($bekkes_penugasan))
                    <a href="{{ url('dukkesops/bekkes-satgas/'. $bekkes_penugasan->jenis_satgas) }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                @else
                    <a href="{{ url('dukkesops/bekkes-satgas/'. request()->segment(3)) }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>                
                @endif
            </div>
            <div class="col-12">
                <h2 class="content-header-title float-left"> @if (isset($bekkes_penugasan)) Edit @else Tambah @endif Data Satgas Operasi</h2>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (isset($bekkes_penugasan))
                                <form action="{{ url('dukkesops/bekkes-satgas/'.$bekkes_penugasan->id_bekkes_penugasan) }}" class="default-form" autocomplete="off">
                                    @method('PUT')
                            @else
                                <form action="{{ url('dukkesops/bekkes-satgas') }}" class="default-form" autocomplete="off" method="POST">
                            @endif
                                <input type="hidden" name="jenis_satgas" value="{{ $bekkes_penugasan->jenis_satgas??request()->segment(3) }}">
                                @csrf
                                <div class="row">
                                    <div class="form-group form-input col-md-6 col-12">
                                        <label class="form-label">Nama Satgas</label>
                                        <input type="text" class="form-control" placeholder="Nama Satgas" name="nama_satgas" value="{{ $bekkes_penugasan->nama_satgas??null }}">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input col-md-6 col-12">
                                        <label class="form-label">Operasi</label>
                                        <input type="text" class="form-control" placeholder="Operasi" name="operasi" value="{{ $bekkes_penugasan->operasi??null }}">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input col-md-3 col-12">
                                        <label class="form-label">Tanggal Berangkat Ops</label>
                                        <input type="text" class="form-control flatpickr-basic" placeholder="Tanggal Berangkat Ops" name="tgl_berangkat" value="{{ $bekkes_penugasan->tgl_berangkat??null }}">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input col-md-3 col-12">
                                        <label class="form-label">Tanggal Kembali Ops</label>
                                        <input type="text" class="form-control flatpickr-basic" placeholder="Tanggal Kembali Ops" name="tgl_kembali" value="{{ $bekkes_penugasan->tgl_kembali??null }}">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input col-md-6 col-12">
                                        <label class="form-label">Jumlah Personil</label>
                                        <input type="number" class="form-control" placeholder="Jumlah Personil" name="jumlah_pers" value="{{ $bekkes_penugasan->jumlah_pers??null }}">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-md-12 col-12 mb-1">
                                        <label class="form-label">Apakah Daerah ini Endemik ?</label>
                                        <div class="demo-inline-spacing">
                                            <div class="custom-control custom-radio mt-0">
                                                <input type="radio" id="customRadio1" name="endemik" class="custom-control-input" value="1"
                                                    @isset($bekkes_penugasan)
                                                        {{ ($bekkes_penugasan->endemik == 1)?'checked':'' }}
                                                    @endisset
                                                />
                                                <label class="custom-control-label" for="customRadio1">Ya</label>
                                            </div>
                                            <div class="custom-control custom-radio mt-0">
                                                <input type="radio" id="customRadio2" name="endemik" class="custom-control-input" value="0"
                                                    @isset($bekkes_penugasan)
                                                        {{ ($bekkes_penugasan->endemik == 0)?'checked':'' }}
                                                    @endisset
                                                />
                                                <label class="custom-control-label" for="customRadio2">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-input col-md-12 col-12">
                                        <label class="form-label">Keterangan</label>
                                        <textarea class="form-control" rows="3" name="keterangan">{{ $bekkes_penugasan->keterangan??null }}</textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-12">
                                        <h5 class="font-weight-bolder">Perangkat</h5>
                                    </div>
                                    <div class="col-12">
                                    <section id="dbp_repeater">
                                            <div data-repeater-list="detail_bekkes_penugasan">
                                                <div data-repeater-item>
                                                    <div class="row d-flex align-items-end">
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group form-input">
                                                                <label class="form-label">Nama Perangkat</label>
                                                                <select class="select2 form-control id_mas_bek" name="id_mas_bek">
                                                                    <option selected disabled>Pilih Nama Perangkat</option>
                                                                    @foreach ($master_bekkes as $mb)
                                                                        <option value="{{ $mb->id_mas_bek }}">{{ $mb->nama_bekkes }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5 col-12">
                                                            <div class="form-group">
                                                                <label>Jumlah Kat</label>
                                                                <input type="text" class="form-control" placeholder="Jumlah Kat" name="jumlah" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 col-12 text-right">
                                                            <div class="form-group">
                                                                <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                                    <i data-feather="trash"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <button class="btn btn-icon btn-outline-primary" type="button" data-repeater-create>
                                                        <i data-feather="plus" class="mr-25"></i>
                                                        <span>Tambah Data</span>
                                                    </button>
                                                </div>
                                                <div class="col-md-6 col-12 text-right">
                                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                                </div>
                                            </div>
                                    </section>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
@section('page_script')
    <script>

        feather.replace();

        $( document ).ready(function() {
            $(".id_mas_bek").select2({tags: true}); 
        });

        let dbp_repeater = $('#dbp_repeater').repeater({
            initEmpty: true,
            show: function () {
                $(this).slideDown();
                let pointer = this;
                $(this).find('.select2').removeClass('select2-hidden-accessible');
                $(this).find('.select2-container').remove();
                $(this).find('.select2').select2({tags: true});
            },
            hide: function (deleteElement) {
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        })

        @if(isset($detail_bp))
            fill_repeater({!! json_encode($detail_bp) !!})
        @endif

        function fill_repeater(detail_bp) {
            let detail_bp_data = [];

            detail_bp.forEach((element) => {
                detail_bp_data.push({
                    id_mas_bek:element.id_mas_bek,
                    jumlah:element.jumlah
                })
            });
            dbp_repeater.setList(detail_bp_data)
        }
    </script>
@endsection