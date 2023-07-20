@extends('partials.template')

@section('main')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left">Edit Faskes Rujukan - {{ $pos_satgas->nama_pos ?? null }}</h2>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h4 class="mb-0">Faskes Rujukan</h4>
                                <span class="font-small-3">Isi dengan data faskes rujukan/terdekat dari pos</span>
                            </div>
                            <div class="form-group">
                                <label>Radius Pencarian (Dalam km)</label>
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <input type="number" class="form-control" placeholder="Radius Pencarian" />
                                    </div>
                                    <div class="col-md-5 col-12">
                                        <button class="btn btn-primary btn-cari">Cari Faskes</button>
                                        <span class="ml-1 info-cari" style="color:red"></span>
                                    </div>
                                </div>
                            </div>
                          <form method="post">
                            <h5 class="mt-2"><b>Faskes Militer</b></h5>
                            <div class="faskesmil-repeater">
                                <div data-repeater-list="faskesmil">
                                    <div data-repeater-item>
                                        <div class="row d-flex align-items-end">
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label>Nama Faskes</label>
                                                    <select class="select2-f form-control" name="id_rs">
                                                        <option disabled selected>Nama Faskes</option>
                                                        @foreach ($rs as $rps)
                                                        <option value="{{ $rps->id_rs }}">{{ $rps->nama_rs }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label>Jarak</label>
                                                    <input type="text" class="form-control jarak" name="jarak" placeholder="Jarak" onkeypress="return event.key === '.' || (Number(event.key) >= 0 && Number(event.key) <= 9)" />
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label>Jalur Evakuasi</label>
                                                    <select class="select2-e form-control" name="evakuasi">
                                                        <option disabled selected>Jalur Evakuasi</option>
                                                        @foreach ($tipe as $t)
                                                        <option value="{{ $t }}">{{ $t }}</option>
                                                        @endforeach
                                                    </select>
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
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-icon btn-outline-primary" type="button" data-repeater-create>Tambah Data</button>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <h5 class="mt-2"><b>Faskes Pemda/Swasta</b></h5>
                            <div class="faskesps-repeater">
                                <div data-repeater-list="faskesps">
                                    <div data-repeater-item>
                                        <div class="row d-flex align-items-end">
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label>Nama Faskes</label>
                                                    <select class="select2-f form-control" name="id_rs_pem_swas">
                                                        <option disabled selected>Nama Faskes</option>
                                                        @foreach ($rs_pemda_swasta as $rps)
                                                        <option value="{{ $rps->id_rs_pem_swas }}">{{ $rps->nama_rs }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label>Jarak</label>
                                                    <input type="text" class="form-control jarak" name="jarak" placeholder="Jarak" onkeypress="return event.key === '.' || (Number(event.key) >= 0 && Number(event.key) <= 9)" />
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label>Jalur Evakuasi</label>
                                                    <select class="select2-e form-control" name="evakuasi">
                                                        <option disabled selected>Jalur Evakuasi</option>
                                                        @foreach ($tipe as $t)
                                                        <option value="{{ $t }}">{{ $t }}</option>
                                                        @endforeach
                                                    </select>
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
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn btn-icon btn-outline-primary" type="button" data-repeater-create>Tambah Data</button>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-primary">Simpan Data</button>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAy9Rzj0GcZLwnkce6cFU92eXnQSo0EIG8&libraries=geometry" async defer></script>
<script>
    feather.replace()
    let rs_form, rsps_form;
    let rs = {!! json_encode($rs) !!}
    let rsps = {!! json_encode($rs_pemda_swasta) !!}
    let tipe = {!! json_encode($tipe) !!}
    $( document ).ready(function() {
        rs_form = $('.faskesmil-repeater').repeater({
            initEmpty: true,
            show: function () {
                $(this).slideDown();
                let pointer = this;
                $(this).find('.select2-f').select2({data: rs});
                $(this).find('.select2-e').select2({data: tipe});
                $(this).find('.select2-f').change(function() {
                    val = $(this).val();
                    d = rs.find(function(r) { return r.id_rs == val });
                    if (d.latitude == null || d.longitude == null) y = '';
                    else y = hitungJarak(d.latitude, d.longitude);
                    $(this).parent().parent().parent().parent().find('.jarak').val(y);
                });
                if ($(this).find('.select2-f').val() == rs[0].id_rs) $(this).find('.select2-f').val(rs[0].id_rs).trigger('change');
            },
            hide: function (deleteElement) {
                if(confirm('Hapus faskes ini?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        });

        rsps_form = $('.faskesps-repeater').repeater({
            initEmpty: true,
            show: function () {
                $(this).slideDown();
                let pointer = this;
                $(this).find('.select2-f').select2({data: rsps});
                $(this).find('.select2-e').select2({data: tipe});
                $(this).find('.select2-f').change(function() {
                    val = $(this).val();
                    d = rsps.find(function(r) { return r.id_rs_pem_swas == val });
                    if (d.latitude == null || d.longitude == null) y = '';
                    else y = hitungJarak(d.latitude, d.longitude);
                    $(this).parent().parent().parent().parent().find('.jarak').val(y);
                });
                if ($(this).find('.select2-f').val() == rsps[0].id_rs_pem_swas) $(this).find('.select2-f').val(rsps[0].id_rs_pem_swas).trigger('change');
            },
            hide: function (deleteElement) {
                if(confirm('Hapus faskes ini?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        })

        $('.btn-cari').click(function() {
            $(this).prop('disabled', true);
            $('.info-cari').html('Sedang melakukan pencarian ...');
          setTimeout(function() {
            let jarak_rs = rs_pos_data, jarak_rsps = rsps_pos_data;
            var x = parseInt($('input[type=number]').val()), y;
            for (var i = 0; i < rs.length; i++) {
                d = rs_pos_data.find(function(r) { return r.id_rs == rs[i].id_rs });
                if (rs[i].latitude == null || rs[i].longitude == null || d != null) continue;
                y = hitungJarak(rs[i].latitude, rs[i].longitude);
                if (y<x) jarak_rs.push({
                    id_rs: rs[i].id_rs,
                    jarak: y,
                });
            }
            for (var i = 0; i < rsps.length; i++) {
                d = rsps_pos_data.find(function(r) { return r.id_rs_pem_swas == rsps[i].id_rs_pem_swas });
                if (rsps[i].latitude == null || rsps[i].longitude == null || d != null) continue;
                y = hitungJarak(rsps[i].latitude, rsps[i].longitude);
                if (y<x) jarak_rsps.push({
                    id_rs_pem_swas: rsps[i].id_rs_pem_swas,
                    jarak: y,
                });
            }
            rs_form.setList(jarak_rs);
            rsps_form.setList(jarak_rsps);
            $('.btn-cari').prop('disabled', false);
            $('.info-cari').html('');
          }, 100);
        });

        @if(isset($rs_pos))
            fill_repeater({!! json_encode($rs_pos) !!})
        @endif

    });

    function hitungJarak(lat, lng) {
        var clicked = new google.maps.LatLng({{ $pos_satgas->latitude }}, {{ $pos_satgas->longitude }});
        y = google.maps.geometry.spherical.computeDistanceBetween (new google.maps.LatLng(parseFloat(lat), parseFloat(lng)), clicked);
        return parseFloat((y/1000).toFixed(2));
    }

    let rs_pos_data = [], rsps_pos_data = [];
    function fill_repeater(rs_pos) {
        rs_pos.forEach((element) => {
            if (element.jarak == null) {
                if (element.tipe == 'M' && element.rs_militer.latitude != null && element.rs_militer.longitude != null) {
                    element.jarak = hitungJarak(element.rs_militer.latitude, element.rs_militer.longitude);
                } else if (element.tipe != 'M' && element.rs_pemda_swasta.latitude != null && element.rs_pemda_swasta.longitude != null) {
                    element.jarak = hitungJarak(element.rs_pemda_swasta.latitude, element.rs_pemda_swasta.longitude);
                }
            }
            if (element.tipe == 'M') rs_pos_data.push({
                id_rs: element.id_rs_pem_swas,
                jarak: element.jarak,
                evakuasi: element.evakuasi
            });
            else rsps_pos_data.push({
                id_rs_pem_swas: element.id_rs_pem_swas,
                jarak: element.jarak,
                evakuasi: element.evakuasi
            });
        });
        if (rs_pos_data.length > 0) rs_form.setList(rs_pos_data);
        if (rsps_pos_data.length > 0) rsps_form.setList(rsps_pos_data);
    }

</script>
@endsection
