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
                                <label class="form-label">Kategori*</label>
                                <div class="row mb-1">
                                    <div class="col-2">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="Distributor" name="kategori" class="custom-control-input" value="Distributor" checked />
                                            <label class="custom-control-label" for="Distributor">Distributor</label>
                                        </div>   
                                    </div>
                                    <div class="col-2">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="FKTP" name="kategori" class="custom-control-input" value="FKTP" />
                                            <label class="custom-control-label" for="FKTP">FKTP</label>
                                        </div>   
                                    </div>
                                    <div class="col-2">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="FKTL" name="kategori" class="custom-control-input" value="FKTL" />
                                            <label class="custom-control-label" for="FKTL">FKTL</label>
                                        </div>   
                                    </div>
                                    <div class="col-2">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="RSS" name="kategori" class="custom-control-input" value="RSS" />
                                            <label class="custom-control-label" for="RSS">RS Sandaran</label>
                                        </div>   
                                    </div>
                                </div>
                                <div id="sel-tu" class="form-group form-input" style="width:75%">
                                    <label class="form-label" for="tujuan">Tujuan Distribusi*</label>
                                    <input type="text" name="tujuan" class="form-control" placeholder="Distributor" value="{{ isset($data)&&$data->kategori=='Distributor' ? $data->tujuan : '' }}" required />
                                    <div class="invalid-feedback select-tu"> Distributor harus diisi</div>
                                </div>
                                <div id="sel-fk" class="form-group form-input" style="width:75%;display:none">
                                    <select class="form-control form-control-lg" name="faskes">
                                        <option selected disabled>Nama Faskes</option>
                                    </select>
                                    <div class="invalid-feedback select-fk">Faskes harus diisi</div>
                                </div>
                                <div class="form-group form-input" style="width:75%">
                                    <label for="fp-human-friendly">Tanggal Distribusi*</label>
                                    <input type="text" name="tgl" class="form-control flatpickr-human-friendly" placeholder="Tanggal Distribusi" required />
                                    <div class="invalid-feedback select-tgl">Tanggal harus diisi</div>
                                </div>
                                <div class="form-group form-input" style="width:75%">
                                    <label class="form-label" for="nama">Nama Produk/Satuan/Kemasan*</label>
                                    <select class="select2 form-control form-control-lg" name="produk" required>
                                        <option selected disabled>Nama Produk</option>
                                        @foreach($prods as $p)
                                        <option value="{{$p->id}}" {{isset($data->id)&&$data->id_kemasan==$p->id ? 'selected' : ''}} >{{$p->nama_produk}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback select-pr">Produk harus diisi</div>
                                </div>

                                <h5 class="font-weight-bolder">Data Produk</h5>

                                <div action="#" class="invoice-repeater">
                                    <div data-repeater-list="lafi">
                                        <div data-repeater-item>
                                            <div class="row d-flex align-items-end">
                                                <div class="col-md-4 col-6">
                                                    <div class="form-group">
                                                        <label for="no">No. Bets*</label>
                                                        <select class="form-control form-control-lg" name="bets" required>
                                                            <option selected disabled>No. Bets</option>
                                                        </select>
                                                        <div class="invalid-feedback select-no" style="display:block;visibility:hidden">No. Bets harus dipilih dan berbeda</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-6">
                                                    <div class="form-group">
                                                        <label for="jml">Jumlah Distribusi*</label>
                                                        <input type="number" class="form-control" name="jml" placeholder="Jumlah Distribusi" min="1" disabled required />
                                                        <div class="invalid-feedback select-jml" style="display:block;visibility:hidden">&nbsp;</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-6 text-right">
                                                    <div class="form-group">
                                                        <button class="btn btn-outline-danger text-nowrap" style="margin-top:-60px" data-repeater-delete type="button">
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
                                            <button class="btn btn-icon btn-outline-primary" type="button" data-repeater-create disabled>
                                                <i data-feather="plus" class="mr-25"></i>
                                                <span>Tambah Baru</span>
                                            </button>
                                        </div>
                                        <div class="col-6 text-right">
                                            <button class="btn btn-icon btn-primary btn-save" type="button">
                                                <span>Simpan Data</span>
                                            </button>
                                        </div>
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
            $("input[name=tgl]").change(function() {
                $('.select-tgl').css('display', 'none');
            });
            $("input[name='kategori']").change(function() {
                x = $(this).val();
                if (x == 'Distributor') {
                    $('input[name=tujuan]').prop('required', true);
                    $('#sel-tu').css('display', '');
                    $('#sel-fk').css('display', 'none');
                    $('.select-tu').css('display', '');
                    $('.select-fk').css('display', 'none');
                } else {
                    $('input[name=tujuan]').prop('required', false);
                    $('#sel-tu').css('display', 'none');
                    $('#sel-fk').css('display', '');
                    $('.select-tu').css('display', 'none');
                    $('.select-fk').css('display', '');
                    $('select[name=faskes]').empty();
                    $('select[name=faskes]').select2({
                        dropdownAutoWidth: true,
                        width: '100%',
                        placeholder: 'Pilih Faskes',
                        dropdownParent: $('select[name=faskes]').parent(),
                        data: rs[x],
                    });
                    $('select[name=faskes]').change(function() {
                        $('.select-fk').css('display', 'none');
                    });
                    $('select[name=faskes]').val(null).trigger('change');
                }
            });
            $(".btn-save").click(function() {
                lafiKosong = 0;
                $("[data-repeater-item]").each(function() {
                    if ($(this).find('input').val() == '' || parseInt($(this).find('input').val()) > parseInt($(this).find('input').attr('max'))) $(this).find('.select-jml').css('visibility', 'visible');
                    if ($(this).find('select').val() == null) {
                        lafiKosong++;
                        $(this).find('.select-no').css('visibility', 'visible');
                    }
                });
                if ($('form')[0].checkValidity() && $('select[name=produk]').val() != null && $('[data-repeater-item]').length != 0 && lafiKosong == 0 && $('input[name=tgl]').val() != '' && ($("input[name='kategori']:checked").val() == 'Distributor' || ($("input[name='kategori']:checked").val() && $('select[name=faskes]').val() != null))) {
                    $(this).prop('disabled', true);
                    $(this).text('Menyimpan...');
                    $.ajax({
                        url: "{{ url('lafibiovak/distribusi/input') }}",
                        method: "POST",
                        dataType: "json",
                        data: $('form').serialize() @if(isset($data)) + '&_id={{request()->segment(4)}}' @endif,
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
                    if ($('select[name=produk]').val() == null) $('.select-pr').css('display', 'block');
                    if ($("input[name='kategori']:checked").val() != 'Distributor' && $('select[name=faskes]').val() == null) $('.select-fk').css('display', 'block');
                    if ($('input[name=tgl]').val() == '' || $('select[name=produk]').val() == null || lafiKosong > 0) {}
                    else if ($('[data-repeater-item]').length == 0) Swal.fire({
                        title: 'Info',
                        text: 'Jumlah distribusi belum ada'
                    });
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
                            bets = res.bets;
                            max = res.max;
                            if (bets.length > 0) $('button[data-repeater-create]').prop('disabled', false);
                            @if(isset($data))
                            for (i=0;i<tp.length;i++) {
                                $('button[data-repeater-create]').click();
                                $("[data-repeater-item]").eq(i).find('select').val(tp[i].id_detil_renprod).trigger('change');
                                $("[data-repeater-item]").eq(i).find('input').val(tp[i].jumlah);
                            }
                            @endif
                        }
                    }
                });
            });
            $('button[data-repeater-create]').click(function() {
                if ($('[data-repeater-item]').length == bets.length) $('button[data-repeater-create]').prop('disabled', true);
                var inp = $("[data-repeater-item]").last().find('input');
                inp.keyup(function() {
                    if ($(this).val() == '') $(this).parent().find('.select-jml').css('visibility', 'visible');
                    else $(this).parent().find('.select-jml').css('visibility', 'hidden');
                });
                var sel = $("[data-repeater-item]").last().find('select');
                sel.wrap('<div class="position-relative"></div>');
                sel.select2({
                    data: bets,
                    dropdownAutoWidth: true,
                    width: '100%',
                    placeholder: 'No. Bets',
                    dropdownParent: sel.parent()
                });
                sel.val(null).trigger('change');
                sel.on('change', function (e) {
                    var val = $(this).val();
                    var exist = false;
                    $("[data-repeater-item] select").not($(this)).each(function() {
                        if ($(this).val() == val) exist = true;
                    });
                    if (exist) {
                        $(this).val(null).trigger('change');
                        $(this).parent().parent().find('.select-no').css('visibility', 'visible');
                    } else {
                        $(this).parent().parent().find('.select-no').css('visibility', 'hidden');
                        $(this).parent().parent().parent().parent().find('input[type=number]').attr('max', max[val]);
                        $(this).parent().parent().parent().parent().find('.select-jml').html('Jumlah Distribusi harus diisi antara 1-' + max[val]);
                    }
                    $(this).parent().parent().parent().parent().find('input[type=number]').prop('disabled', exist).trigger('change');
                });
                $("[data-repeater-item]").last().find('button[data-repeater-delete]').click(function() {
                    $('button[data-repeater-create]').prop('disabled', false);
                });
            });
            $('[data-repeater-list]').html('');
            @if(isset($data))
            document.querySelector(".flatpickr-human-friendly")._flatpickr.setDate('{{$data->tgl_distribusi}}');
            $('#{{$data->kategori}}').prop("checked", true).trigger('change');
            if ($("input[name='kategori']:checked").val() != 'Distributor') $('select[name=faskes]').val('{{$data->id_rs}}').trigger('change');
            tp = JSON.parse('{!!json_encode($data->detil_distribusi)!!}');
            $('select[name=produk]').val('{{$data->id_kemasan}}').trigger('change');
            @endif
        });
        var rs = JSON.parse('{!!json_encode($faskes)!!}');
        var tp, bets, max;
    </script>
@endsection