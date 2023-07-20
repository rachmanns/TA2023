@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="/lafibiovak/distribusi"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">{{ isset($data)?'Edit':'Tambah' }} Distribusi</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                              <form>
                                <h5 class="font-weight-bolder">Data Produk</h5>
                                <div class="form-group form-input">
                                    <label for="fp-human-friendly">Tanggal Distribusi*</label>
                                    <input type="text" name="tgl" class="form-control flatpickr-human-friendly" placeholder="Tanggal Distribusi" required />
                                    <div class="invalid-feedback select-tgl">Tanggal harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label" for="nama">Nama Produk/Satuan/Kemasan*</label>
                                    <select class="select2 form-control form-control-lg" name="produk" required>
                                        <option selected disabled>Nama Produk</option>
                                        @foreach($prods as $p)
                                        <option value="{{$p->id}}" {{isset($data->id)&&$data->id_kemasan==$p->id ? 'selected' : ''}} >{{$p->nama_produk}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback select-pr">Produk harus diisi</div>
                                </div>

                                <div class="form-group form-input">
                                    <label class="form-label" for="no">Kode Produksi*</label>
                                    <select class="form-control form-control-lg select2" name="bets" required>
                                        <option selected disabled>Kode Produksi</option>
                                    </select>
                                    <div class="invalid-feedback select-no">Kode Produksi harus diisi</div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group form-input">
                                            <label class="form-label" for="">Produsen</label>
                                            <select id="produsen" name="produsen" class="form-control select2" disabled>
                                                <option selected disabled>&nbsp;</option>
                                                <option>Lafi Puskesad</option>
                                                <option>Lafial</option>
                                                <option>Lafiau</option>
                                                <option>Labiovak Puskesad</option>
                                                <option>Labiomed Puskesad</option>
                                            </select>
                                            <div class="invalid-feedback select-prod">Produsen harus diisi</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group form-input">
                                            <label class="form-label" for="">Expired Date</label>
                                            <input type="text" id="expdate" name="expdate" class="form-control flatpickr-human-friendly" />
                                            <div class="invalid-feedback select-tgle">Expired date harus diisi</div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <h5 class="font-weight-bolder">Dobekkes</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group form-input">
                                            <label class="form-label" for="">Jumlah Masuk*</label>
                                            <input type="number" name="dbmsk" id="dbmsk" class="form-control jml" value="{{ $data->dobek_masuk ?? '' }}" required />
                                            <div class="invalid-feedback">Jumlah harus diisi</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group form-input">
                                            <label class="form-label" for="">Sisa Stok</label>
                                            <input type="number" id="dbsisa" class="form-control" value="{{ isset($data) ? $data->dist_masuk - $data->dist_keluar : '' }}" readonly />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group form-input">
                                            <label class="form-label" for="">Jumlah Keluar*</label>
                                            <input type="number" name="dbkel" id="dbkel" class="form-control jml" value="{{ $data->dobek_keluar ?? '' }}" required />
                                            <div class="invalid-feedback">Jumlah harus diisi</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group form-input">
                                            <label class="form-label" for="">Keterangan</label>
                                            <input type="text" name="dbket" class="form-control" value="{{ $data->dobek_ket ?? '' }}" />
                                        </div>
                                    </div>
                                </div>
                                <h5 class="font-weight-bolder">Distributor</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group form-input">
                                            <label class="form-label" for="">Jumlah Masuk*</label>
                                            <input type="number" name="dimsk" id="dimsk" class="form-control jml" value="{{ $data->dist_masuk ?? '' }}" required />
                                            <div class="invalid-feedback">Jumlah harus diisi</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group form-input">
                                            <label class="form-label" for="">Sisa Stok</label>
                                            <input type="number" id="disisa" class="form-control" value="{{ isset($data) ? $data->dobek_masuk - $data->dobek_keluar : '' }}" readonly />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group form-input">
                                            <label class="form-label" for="">Jumlah Keluar*</label>
                                            <input type="number" name="dikel" id="dikel" class="form-control jml" value="{{ $data->dist_keluar ?? '' }}" required />
                                            <div class="invalid-feedback">Jumlah harus diisi</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group form-input">
                                            <label class="form-label" for="">Keterangan</label>
                                            <input type="text" name="diket" class="form-control" value="{{ $data->dist_ket ?? '' }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-input">
                                    <label for="customFile1">Upload File Laporan</label>
                                    <div class="custom-file">
                                        <input type="file" name="file_dist" class="custom-file-input" id="customFile1" />
                                        <label class="custom-file-label" for="customFile1">Upload File Laporan</label>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-icon btn-primary btn-save" type="button">
                                            <span>Simpan Data</span>
                                        </button>
                                    </div>
                                </div>
                                @csrf
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
        $(document).ready(function() {
            $(".flatpickr-human-friendly").flatpickr({
                altInput: true,
                altFormat: 'd/m/Y',
                dateFormat: 'Y-m-d'
            });
            document.querySelector("#expdate")._flatpickr.set('clickOpens', false);
            $("#expdate").parent().find('.flatpickr-human-friendly').css('background', '#eee');
            $("input[name=tgl]").change(function() {
                $('.select-tgl').css('display', 'none');
            });
            $("input[name=expdate]").change(function() {
                $('.select-tgle').css('display', 'none');
            });
            $(".btn-save").click(function() {
                $('form').removeClass('was-validated');
                if ($('form')[0].checkValidity() && $('input[name=tgl]').val() != '' && $('input[name=expdate]').val() != '' && $('select[name=produsen]').val() != null && $('select[name=produk]').val() != null && $('select[name=bets]').val() != null) {
                    $(this).prop('disabled', true);
                    $(this).text('Menyimpan...');
                    $('select[name=produsen]').prop('disabled', false);
                    form_data = new FormData($('form')[0]);
                    @if(isset($data)) form_data.append('_id', '{{request()->segment(4)}}'); @endif
                    $.ajax({
                        url: "{{ url('lafibiovak/distribusi/input') }}",
                        method: "POST",
                        data: form_data,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            Swal.fire({
                                title: 'Info',
                                text: res.message,
                                icon: 'info',
                            }).then(function() {
                                if (!res.error) location.href = '/lafibiovak/distribusi';
                            });
                        }
                    }).always(function() {
                        $(".btn-save").prop('disabled', false);
                        $(".btn-save").text('Simpan Data');
                    });
                } else {
                    $('form').addClass('was-validated');
                    if ($('input[name=tgl]').val() == '') $('.select-tgl').css('display', 'block');
                    if ($('input[name=expdate]').val() == '' && $('select[name=produsen]').prop('disabled') == false) $('.select-tgle').css('display', 'block');
                    if ($('select[name=produk]').val() == null) $('.select-pr').css('display', 'block');
                    if ($('select[name=bets]').val() == null) $('.select-no').css('display', 'block');
                    if ($('select[name=produsen]').val() == null) $('.select-prod').css('display', 'block');
                }
            });
            $('select[name=produk]').change(function() {
                $('.select-pr').css('display', 'none');
                $.ajax({
                    type: "get",
                    dataType: "json",
                    url: "{{ url('/lafibiovak/distribusi/get-bets') }}/" + $(this).val(),
                    success: function (res) {
                        if (!res.error) {
                            exp = res.exp;
                            $('#produsen').prop('disabled', true).val(null).trigger('change');
                            document.querySelector("#expdate")._flatpickr.set('clickOpens', false);
                            document.querySelector("#expdate")._flatpickr.setDate(null);
                            $("#expdate").parent().find('.flatpickr-human-friendly').css('background', '#eee');
                            ada = false;
                            if (tp != null) {
                                for(i=0;i<res.bets.length;i++) {
                                    if (tp == res.bets[i].id) {
                                        ada = true;
                                        break;
                                    }
                                }
                                if (!ada) res.bets.push({'id':tp, 'text':tp});
                            }
                            initSel2(res.bets);
                            @if(isset($data))
                            if (tp != null) {
                                $('select[name=bets]').val(tp).trigger('change');
                                if (!ada) {
                                    $('#produsen').val('{{$data->produsen}}').trigger('change');
                                    document.querySelector("#expdate")._flatpickr.setDate('{{$data->exp_date}}');
                                }
                                tp = null;
                            }
                            @endif
                        }
                    }
                });
            });
            $('select[name=bets]').change(function() {
                if ($(this).val() == null) return;
                $('.select-no').css('display', 'none');
                val = $('option[value=' + $(this).val() + ']').text();
                if (val.lastIndexOf('(') == -1) {
                    $('#produsen').prop('disabled', false).val(null).trigger('change');
                    document.querySelector("#expdate")._flatpickr.set('clickOpens', true);
                    $("#expdate").parent().find('.flatpickr-human-friendly').css('background', '#fff');
                    document.querySelector("#expdate")._flatpickr.setDate(null);
                } else {
                    $('#produsen').prop('disabled', true).val(val.substring(val.lastIndexOf('(') + 1, val.length - 1)).trigger('change');
                    document.querySelector("#expdate")._flatpickr.set('clickOpens', false);
                    $("#expdate").parent().find('.flatpickr-human-friendly').css('background', '#eee');
                    document.querySelector("#expdate")._flatpickr.setDate(exp[$(this).val()]);
                }
            });
            $('select[name=bets]').select2({
                tags: true,
                createTag: function (params) {
                    var term = $.trim(params.term);
                    if (term === '') return null;
                    return {
                        id: term.toUpperCase(),
                        text: 'Kode Produksi: ' + term.toUpperCase(),
                        newTag: true
                    }
                },
                templateSelection: function (data) {
                    return data.text.indexOf('Kode Produksi:') == -1 ? data.text.toUpperCase() : data.text.substr(15).toUpperCase();
                },
            });
            $('select[name=produsen]').change(function() {
                if ($(this).val() == null) return;
                $('.select-prod').css('display', 'none');
            });
            $('select[name=produsen]').select2({
                placeholder: '',
            });
            $('.jml').keyup(function() {
                name = $(this).attr('name').substr(0, 2);
                if ($(this).val() == '' || $('#' + name + 'msk').val() == '' || $('#' + name + 'kel').val() == '') return;
                $('#' + name + 'sisa').val(parseInt($('#' + name + 'msk').val()) - parseInt($('#' + name + 'kel').val()));
            });
            @if(isset($data))
            document.querySelector("input[name=tgl]")._flatpickr.setDate('{{$data->tgl_distribusi}}');
            tp = '{{$data->kode_produksi}}';
            $('select[name=produk]').val('{{$data->id_kemasan}}').trigger('change');
            @endif
        });
        var tp, exp;
        function initSel2(bets) {
            var sel = $('select[name=bets]');
            sel.empty();
            sel.select2({
                data: bets,
                tags: true,
                createTag: function (params) {
                    var term = $.trim(params.term);
                    if (term === '') return null;
                    return {
                        id: term.toUpperCase(),
                        text: 'Kode Produksi: ' + term.toUpperCase(),
                        newTag: true
                    }
                },
                templateSelection: function (data) {
                    return data.text.indexOf('Kode Produksi:') == -1 ? data.text.toUpperCase() : data.text.substr(15).toUpperCase();
                },
            });
            sel.val(null).trigger('change');
        }
    </script>
@endsection