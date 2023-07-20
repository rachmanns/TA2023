@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="{{ url('/lafibiovak/renprod') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">{{ isset($data)?isset($data->status_produksi)?'Detil':'Edit':'Tambah' }} Rencana Produksi</h2>
                </div>
            </div>  
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <section class="modern-horizontal-wizard mb-0">
                                    <div class="bs-stepper wizard-modern modern-wizard-example">
                                        <div class="bs-stepper-header">
                                            <div class="step" data-target="#account-details-modern">
                                                <button type="button" class="step-trigger">
                                                    <span class="bs-stepper-box">
                                                        <i data-feather="file-text" class="font-medium-3"></i>
                                                    </span>
                                                    <span class="bs-stepper-label">
                                                        <span class="bs-stepper-title">Produk</span>
                                                    </span>
                                                </button>
                                            </div>
                                            <div class="line">
                                                <i data-feather="chevron-right" class="font-medium-2"></i>
                                            </div>
                                            <div class="step" data-target="#personal-info-modern">
                                                <button type="button" class="step-trigger">
                                                    <span class="bs-stepper-box">
                                                        <i data-feather="link" class="font-medium-3"></i>
                                                    </span>
                                                    <span class="bs-stepper-label">
                                                        <span class="bs-stepper-title">Renprod (Bets)</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        <hr class="m-0">
                                        <div class="bs-stepper-content">
                                          <form method="post" action="{{ url('/lafibiovak/renprod/input') }}">
                                            <div id="account-details-modern" class="content">
                                                <div class="row">
                                                    <div class="col-6"> 
                                                        <div class="form-group form-input">
                                                            <label class="form-label">Nama Produk</label>
                                                            <select class="select2 form-control form-control-lg" name="produk">
                                                                <option selected disabled>Nama Produk</option>
                                                                @foreach($prods as $p)
                                                                <option value="{{$p->id_kemasan}}" {{isset($data->id_kemasan)&&$data->id_kemasan==$p->id_kemasan ? 'selected' : ''}} >{{$p->produk->nama_produk}} / {{$p->satuan_produk->nama_satuan}} / {{$p->nama_kemasan}}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback select-fb">Produk harus diisi</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="tahun">Tahun Anggaran</label>
                                                            <div class="input-group input-group-merge form-input">
                                                                <input type="number" name="tahun"
                                                                    class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun Anggaran"
                                                                    onkeypress="return event.key === 'Enter'"
                                                                    required />
                                                                <div class="invalid-feedback">Tahun harus diisi</div>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i data-feather="calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6" >
                                                        <div class="form-group form-input">
                                                            <label class="form-label" for="bets">Bets</label>
                                                            <input type="text" id="bets" class="form-control" placeholder="Bets" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-6" >
                                                        <div class="form-group form-input">
                                                            <label class="form-label" for="jml">Jumlah Renbut (RKO)</label>
                                                            <input type="text" id="jml" class="form-control" placeholder="Jumlah Renbut (RKO)" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group form-input">
                                                            <label class="form-label" for="persediaan">Persediaan Awal</label>
                                                            <input type="text" id="persediaan" class="form-control" placeholder="Persediaan Awal" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group form-input">
                                                            <label class="form-label" for="spp">Jumlah Batch</label>
                                                            <input type="number" name="spp" min="1" class="form-control" placeholder="Jumlah Batch Diproduksi" required value="{{$data->jml_spp ?? ''}}" />
                                                            <div class="invalid-feedback">Total harus diisi minimal 1</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group form-input">
                                                            <label class="form-label" for="renprod">Jumlah Renprod</label>
                                                            <input type="text" id="renprod" class="form-control" placeholder="Jumlah Renprod" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group form-input">
                                                            <label>Assign ke Lafi</label>
                                                            <select class="select2 form-control" name="lafi[]" id="lafi" multiple placeholder="Pilih Lafi">
                                                                <option value="Lafiad">Lafi Puskesad</option>
                                                                <option>Lafial</option>
                                                                <option>Lafiau</option>
                                                                <option value="Labiovak">Labiovak Puskesad</option>
                                                                <option value="Labiomed">Labiomed Puskesad</option>
                                                            </select>
                                                            <div class="invalid-feedback select-la">Lafi harus dipilih minimal 1</div>
                                                        </div>
                                                    </div>
                                                </div>                                                
                                                <h5 class="font-weight-bolder mt-1">Kebutuhan Bahan Produksi</h5>
                                                @foreach($kat as $k)
                                                <div class="form-group form-input">
                                                    <label>{{$k->nama_kategori}}</label>
                                                    <select class="select2 form-control" id="k{{$k->id_kategori}}" multiple>
                                                    @foreach($k->bahan_produksi as $bp)
                                                        <option value="{{$bp->id_bahan_produksi}}"
                                                        @if(isset($data) && in_array($bp->id_bahan_produksi, $data->bp))
                                                        selected
                                                        @endif
                                                        >{{$bp->nama_bahan_produksi}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                @endforeach
                                                <div class="row">
                                                    <div class="col-12 text-right">
                                                        <button type="button" class="btn btn-primary next">
                                                            <span class="align-middle d-sm-inline-block d-none">Selanjutnya</span>
                                                        </button>
                                                        <button type="button" class="btn-next" style="display:none"></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="personal-info-modern" class="content">
                                                <div class="content-header">
                                                    <h4 class="mb-0">Produk : <span class="text-primary font-weight-bolder" id="lbl_produk"></span><span class="bullet bullet-xs bullet-primary ml-1 mb-25 mr-1"></span>Jumlah Batch : <span class="text-primary font-weight-bolder" id="lbl_spp"></span></h4>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5 class="font-weight-bolder">Pembagian Bets ke Lafi Kecil</h5>
                                                    </div>
                                                </div>
                                                <div class="row" id="rbets"></div>
                                                <div class="row">
                                                    <div class="col-6"></div>
                                                    <div class="col-12">
                                                        <h5 class="font-weight-bolder">Pembagian Bahan Baku ke Lafi Kecil</h5>
                                                    </div>
                                                </div>
                                                @foreach($kat as $k)
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="mb-50">{{$k->nama_kategori}}</p>
                                                    </div>
                                                </div>
                                                <div class="row formkat" id="r{{$k->id_kategori}}"></div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <hr class="m-0 pb-1">
                                                    </div>
                                                </div>
                                                @endforeach

                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ url('/lafibiovak/renprod') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                                                    <button type="button" class="btn btn-primary btn-save">Simpan Data</button>
                                                </div>
                                            </div>
                                            @if(isset($data))
                                            <input type="hidden" name="id" value="{{request()->segment(4)}}" />
                                            @endif
                                            @csrf
                                          </form>
                                        </div>
                                    </div>
                                </section>
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
        var colors_ = {
            Lafiad: 'success',
            Lafial: 'info',
            Lafiau: 'primary',
            Labiomed: 'danger',
            Labiovak: 'warning',
        };
        var bahan = JSON.parse('{!!$bahan!!}');
        var cat = JSON.parse('{!!$cat!!}');
        var betslafi = [];
        var bahanlafi = [];
        $(document).ready(function() {
            $(".btn-save").click(function() {
                jumlah = 0;
                $("[data-lafi]").each(function() {
                    if ($(this).val() != '') jumlah += parseInt($(this).val());
                });
                jmlBatchSama = jumlah == parseInt($('input[name=spp]').val());
                stokAda = true;
                brgErr = '';
                for(i=0;i<cat.length;i++) {
                    var d = $('#k' + cat[i]).val();
                    for(x=0;x<d.length;x++) {
                        jumlah = 0;
                        $("[data-" + d[x] + "]").each(function() {
                            if ($(this).val() != '') jumlah += parseInt($(this).val());
                        });
                        if (jumlah > bahan[d[x]].stok) {
                            stokAda = false;
                            brgErr = bahan[d[x]].nama;
                            break;
                        }
                    }
                    if (!stokAda) break;
                }
                if ($('form')[0].checkValidity() && jmlBatchSama && stokAda) {
                    $(this).prop('disabled', true);
                    $(this).text('Menyimpan...');
                    $.ajax({
                        url: $('form').attr('action'),
                        method: "POST",
                        dataType: "json",
                        data: $('form').serialize(),
                        success: function(res) {
                            Swal.fire({
                                title: 'Info',
                                text: res.message,
                                icon: 'info',
                            }).then(function() {
                                if (!res.error) location.href = '/lafibiovak/renprod';
                            });
                        }
                    }).always(function() {
                        $(".btn-save").prop('disabled', false);
                        $(".btn-save").text('Simpan Data');
                    });
                } else {
                    $('form').addClass('was-validated');
                    if (!jmlBatchSama) Swal.fire({
                        title: 'Info',
                        text: 'Jumlah batch di Lafi harus sama dengan total batch',
                    });
                    else if (!stokAda) Swal.fire({
                        title: 'Info',
                        text: 'Total bahan baku ' + brgErr + ' di Lafi melebihi stok',
                    });
                }
            });
            $('select#lafi').change(function() {
                $('.select-la').css('display', 'none');
            });
            $('select[name=produk]').change(function() {
                $('.select-fb').css('display', 'none');
                $.ajax({
                    type: "get",
                    url: "{{ url('/lafibiovak/kemasan') }}/" + $(this).val() + "?renprod=true",
                    success: function (res) {
                        if (!res.error) {
                            $('#bets').val(res.data.bets);
                        }
                    }
                });
                if ($('input[name=tahun]').val() != '') $.ajax({
                    type: "get",
                    url: "{{ url('/lafibiovak/renprod/get-persediaan') }}/?id=" + $(this).val() + '&tahun=' + $('input[name=tahun]').val(),
                    success: function (res) {
                        if (!res.error) {
                            $('#jml').val(res.data.jml);
                            $('#persediaan').val(res.data.persediaan);
                        }
                    }
                });
            });
            $('input[name=tahun]').change(function() {
                if ($(this).val() != '') $('.input-group-append').css('display', '');
                if ($('select[name=produk]').val() != null) $.ajax({
                    type: "get",
                    url: "{{ url('/lafibiovak/renprod/get-persediaan') }}/?id=" + $('select[name=produk]').val() + '&tahun=' + $(this).val(),
                    success: function (res) {
                        if (!res.error) {
                            $('#jml').val(res.data.jml);
                            $('#persediaan').val(res.data.persediaan);
                        }
                    }
                });
            });
            $('input[name=spp]').keyup(function() {
                if ($(this).val() == '' || $('#bets').val() == '') $('#renprod').val('');
                else $('#renprod').val(formatRupiah((parseInt($(this).val())*parseInt($('#bets').val().replace('.', ''))).toString()));
            });
            $('.next').click(function() {
				$('#rbets').html('');
                $('.formkat').html('');
                if ($('form')[0].checkValidity() && $('select[name=produk]').val() != null && $('select#lafi').val().length != 0) {
                    $('form').removeClass('was-validated');
                    $('#lbl_produk').html($('option[value=' + $('select[name=produk]').val() + ']').text());
                    $('#lbl_spp').html($('input[name=spp]').val());
                    var laf = $('select#lafi').val();
                    var html = '';
                    for(i=0;i<laf.length;i++) {
                        html += '<div class="col-md-1">' +
                                    '<div class="form-group form-input">' +
                                        '<label class="form-label text-' + colors_[laf[i]] + ' font-small-1">' + laf[i] + '</label>' +
                                        '<input type="number" class="form-control form-control-sm" name="betslafi[' + laf[i] + ']" data-lafi min="1" value="' + (betslafi[laf[i]] ?? '') + '" required />' +
                                        '<div class="invalid-feedback">Jumlah harus diisi minimal 1</div>' +
                                    '</div>' +
                                '</div>';
                    }
                    $('#rbets').html(html);
                    for(i=0;i<cat.length;i++) {
                        var d = $('#k' + cat[i]).val();
                        html = '';
                        if (d.length == 0) html = '<div class="col-md-1">&nbsp;-&nbsp;</div>';
                        else for(x=0;x<d.length;x++) {
                            if (bahanlafi[d[x]] != null) {
                                for(lf in bahanlafi[d[x]]) bahan[d[x]].stok += bahanlafi[d[x]][lf];
                            }
                            html += '<div class="col-md-6">' +
                                        '<h6 class="mb-0">' +
                                            '<span class="text-primary font-weight-bolder">' + bahan[d[x]].nama + '</span>' +
                                            '<span class="bullet bullet-xs bullet-primary ml-1 mb-25 mr-1"></span>' +
                                            'Persediaan : <span class="text-primary font-weight-bolder">' + bahan[d[x]].stok + ' ' + (bahan[d[x]].satuan ?? '') + '</span>' +
                                        '</h6>' +
                                        '<div class="row">';
                            for(y=0;y<laf.length;y++) {
                                html += '<div class="col-md-2">' +
                                    '<div class="form-group form-input">' +
                                        '<label class="form-label text-' + colors_[laf[y]] + ' font-small-1">' + laf[y] + '</label>' +
                                        '<input type="number" class="form-control form-control-sm" name="bhn[' + d[x] + '][' + laf[y] + ']" data-' + d[x] + ' min="1" value="' + (bahanlafi[d[x]] ? bahanlafi[d[x]][laf[y]] : '') + '" required />' +
                                        '<div class="invalid-feedback">Jumlah harus diisi minimal 1</div>' +
                                    '</div>' +
                                '</div>';
                            }
                            html += '</div></div>';
                        }
                        $('#r' + cat[i]).html(html);
                    }
                    $('.btn-next').click();
                } else {
                    $('form').addClass('was-validated');
                    if ($('select[name=produk]').val() == null) $('.select-fb').css('display', 'block');
                    if ($('select#lafi').val().length == 0) $('.select-la').css('display', 'block');
                }
            });
            //$('[data-repeater-list]').html('');
            //$('button[data-repeater-create]').click();
            @if(isset($data))
            $('input[name=tahun]').val({{$data->periode_produksi}});
            $('input[name=spp]').val({{$data->jml_spp}});
            $('select[name=produk]').trigger('change');
            $('#renprod').val(formatRupiah('{{$data->renprod}}'));
            bahanlafi = JSON.parse('{!!json_encode($data->bahan)!!}');
            var tp = JSON.parse('{!!json_encode($data->lafi)!!}');
            var laf = [];
            for (i=0;i<tp.length;i++) {
                laf.push(tp[i].pel);
                betslafi[tp[i].pel] = tp[i].jml;
            }
            $('select#lafi').val(laf).trigger('change');
            @if(isset($data->status_produksi))
            $('input').prop('readonly', true);
            $('select').prop('disabled', true);
            $('input[name=tahun]').prop('disabled', true);
            $('button').remove();
            @endif
            @endif
        });
    </script>
@endsection