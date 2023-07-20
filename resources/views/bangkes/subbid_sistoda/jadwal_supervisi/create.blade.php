@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="{{ route('bangkes.jadwal-supervisi.index') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Jadwal Supervisi</h2>
                </div>
            </div>
            @if (isset($supervisi))
                <form action="{{ route('bangkes.jadwal-supervisi.update',$supervisi->id_supervisi) }}" class="default-form" autocomplete="off">
                    @method('PUT')
            @else
                <form action="{{ route('bangkes.jadwal-supervisi.store') }}" class="default-form" autocomplete="off">
            @endif
                @csrf
                <div class="content-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="tgl">Tanggal</label>
                                                <input type="text" id="tgl" class="form-control flatpickr-basic" placeholder="Tanggal" name="tgl" value="{{ $supervisi->tgl??null }}"/>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="topik">Topik</label>
                                                <input type="text" id="topik" class="form-control" placeholder="Topik" name="topik" value="{{ $supervisi->topik??null }}">
                                                <div class="invalid-feedback"></div>
                                            </div>                                        
                                        </div>
                                    </div>
                                    <h5>Lokasi Supervisi</h5>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="satuan">Satuan</label>
                                                <input type="text" id="satuan" class="form-control" placeholder="Satuan" name="satuan" value="{{ $supervisi->satuan??null }}">
                                                <div class="invalid-feedback">Satuan harus diisi</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="id_provinsi">Provinsi</label>
                                                <select id="id_provinsi" class="form-control select2" name="provinsi">
                                                    <option selected disabled>Pilih Provinsi</option>
                                                    @foreach ($provinsi as $item)
                                                        <option value="{{ $item->id_provinsi }}"
                                                            @isset($supervisi)
                                                                {{ $supervisi->kota_kab->id_provinsi == $item->id_provinsi?'selected':'' }}
                                                            @endisset
                                                            >{{ $item->nama_provinsi }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="id_kotakab">Kota</label>
                                                <select name="id_kotakab" id="id_kotakab" class="form-control"></select>
                                                <div class="invalid-feedback">Kota harus diisi</div>
                                            </div>                                     
                                        </div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label for="customFile1">File Laporan Kegiatan</label>
                                        <div class="custom-file">
                                            <input type="file" name="file_lap_keg" class="custom-file-input" id="customFile1"/>
                                            <label class="custom-file-label" for="customFile1">File Laporan Kegiatan</label>
                                        </div>
                                        <div class="invalid-feedback"></div>
                                    </div>
    
                                    <h5>Panitia Internal</h5>
                                    <label class="form-label">Panitia Internal</label>
                                    <select class="select2 form-control" name="panitia_internal[]" multiple>
                                        @foreach ($personil as $p)
                                            @if(in_array($p->nrp, $panitia_internal))
                                                <option value="{{ $p->nrp }}" selected="true">{{ $p->nama }}</option>
                                            @else
                                                <option value="{{ $p->nrp }}">{{ $p->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
    
                                    <h5 class="mt-2">Panitia Eksternal</h5>
                                    <div id="panitia-ext-repeater">
                                        <div data-repeater-list="panitia_eksternal">
                                            <div data-repeater-item>
                                                <div class="row d-flex align-items-end">
                                                    <div class="col-md-2 col-6">
                                                        <div class="form-group">
                                                            <label for="nama">Nama</label>
                                                            <input type="text" class="form-control" placeholder="Nama" name="nama_panitia_eksternal" required />
                                                            <div class="invalid-feedback">Nama harus diisi</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-6">
                                                        <div class="form-group">
                                                            <label for="nrp">NRP</label>
                                                            <input type="text" class="form-control" placeholder="NRP" name="nrp_panitia_eksternal" required />
                                                            <div class="invalid-feedback">NRP harus diisi</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-6">
                                                        <div class="form-group">
                                                            <label for="asal">Asal Satuan</label>
                                                            <input type="text" class="form-control" placeholder="Asal Satuan" name="satuan_panitia_eksternal" required />
                                                            <div class="invalid-feedback">Asal Satuan harus diisi</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-6">
                                                        <div class="form-group">
                                                            <label for="jabatan">Jabatan</label>
                                                            <input type="text" class="form-control" placeholder="Jabatan" name="jabatan_panitia_eksternal" required />
                                                            <div class="invalid-feedback">Jabatan harus diisi</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-6">
                                                        <div class="form-group">
                                                            <label for="pangkat">Pangkat</label>
                                                            <input type="text" class="form-control" placeholder="Pangkat" name="pangkat_panitia_eksternal" required />
                                                            <div class="invalid-feedback">Jabatan harus diisi</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-6 text-right">
                                                        <div class="form-group">
                                                            <button class="btn btn-outline-danger text-nowrap" data-repeater-delete type="button">
                                                                <i data-feather="trash" class="mr-50"></i>
                                                                <span>Hapus</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6">
                                                <button class="btn btn-icon btn-outline-primary" type="button" data-repeater-create>
                                                    <i data-feather="plus" class="mr-25"></i>
                                                    <span>Tambah Baru</span>
                                                </button>
                                            </div>
                                            <div class="col-6 text-right">
                                                <button class="btn btn-icon btn-primary" type="submit">
                                                    <span>Simpan Data</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        $(function(){
            select_kotakab({{ $supervisi->kota_kab->id_provinsi??null }})
            setTimeout(function(){$("#id_kotakab").val("{{ $supervisi->kota_kab->id_kotakab??null }}").trigger('change.select2')}, 1000);
        })

        $(document).on('change', '#id_provinsi', function() {
            var id_provinsi = $(this).val();
            select_kotakab(id_provinsi)
        });

        function select_kotakab(id_provinsi){
            $.ajax({
                url: "{{ url('bangkes/kotakab/list') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id_provinsi": id_provinsi
                },
                method: "POST",
                dataType: "json",
                success: function (result) {
                    
                    $("#id_kotakab").empty().trigger("change");
                    
                    $("#id_kotakab").select2({ data: result.data,placeholder: "Pilih Kota/Kab",allowClear: true });

                }
            });
        }

        let panitia_ext_repeater = $('#panitia-ext-repeater').repeater({
            initEmpty: true,
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        })
        
        @if(isset($panitia_eksternal))
            fill_repeater({!! json_encode($panitia_eksternal) !!})
        @endif

        function fill_repeater(panitia_eksternal) {
            let panitia_ext_data = [];

            panitia_eksternal.forEach((element) => {
                panitia_ext_data.push({
                    nama_panitia_eksternal:element.nama,
                    nrp_panitia_eksternal:element.nrp,
                    satuan_panitia_eksternal:element.satuan,
                    jabatan_panitia_eksternal:element.jabatan,
                    pangkat_panitia_eksternal:element.pangkat,
                })
            });
            panitia_ext_repeater.setList(panitia_ext_data)
        }
    </script>
@endsection