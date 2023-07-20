@extends('partials.template')

@section('page_style')
    <style>
                .tg  {border-collapse:collapse;border-spacing:0;}
                .tg td{border-color:black;border-style:solid;border-width:1px;font-size:12px;
                  overflow:hidden;padding:5px 5px;word-break:normal;}
                .tg th{border-color:black;border-style:solid;border-width:1px;;font-size:10px;
                  font-weight:normal;overflow:hidden;padding:5px 5px;word-break:normal;}
                .tg .tg-gvcd{background-color:#ffffff;border-color:#ffffff;text-align:left;vertical-align:top;font-size: 15px}
                .tg .tg-v0nz{background-color:#ffffff;border-color:#ffffff;text-align:left;vertical-align:top;font-size: 15px}
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
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="/lafibiovak/renprod?produksi=true"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">Edit Timeline Produksi</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if(!isset(Auth::user()->id_faskes))
                                <div class="form-group form-input">
                                    <label class="form-label">Lafi Kecil</label>
                                    <select class="select2 form-control form-control-lg" onchange="location.href='{{request()->url()}}?lafi='+this.value">
                                        <option selected disabled>Pilih Lafi Kecil</option>
                                        <option value="Lafiad" @if(request()->lafi=='Lafiad') selected @endif >Lafi Puskesad</option>
                                        <option @if(request()->lafi=='Lafial') selected @endif >Lafial</option>
                                        <option @if(request()->lafi=='Lafiau') selected @endif >Lafiau</option>
                                        <option value="Labiovak" @if(request()->lafi=='Labiovak') selected @endif >Labiovak Puskesad</option>
                                        <option value="Labiomed" @if(request()->lafi=='Labiomed') selected @endif >Labiomed Puskesad</option>
                                    </select>
                                </div>
                                @endif
                                @if(isset($data))
                                <table class="tg">
                                    <tr>
                                        <td class="tg-v0nz" style="width: 200px">Nama Produk</td>
                                        <td class="tg-v0nz">:</td>
                                        <td class="tg-gvcd font-weight-bolder">{{$data->kemasan->produk->nama_produk}} / {{$data->kemasan->satuan_produk->nama_satuan}} / {{$data->kemasan->nama_kemasan}}</td>
                                        <td class="tg-v0nz" style="width: 100px"></td>
                                        <td class="tg-v0nz" style="width: 250px">Tahun Anggaran</td>
                                        <td class="tg-v0nz">:</td>
                                        <td class="tg-gvcd font-weight-bolder">{{$data->periode_produksi}}</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-v0nz" style="width: 200px">Bets</td>
                                        <td class="tg-v0nz">:</td>
                                        <td class="tg-gvcd font-weight-bolder">{{$data->kemasan->bets}}</td>
                                        <td class="tg-v0nz"></td>
                                        <td class="tg-v0nz" style="width: 250px">Jumlah Batch</td>
                                        <td class="tg-v0nz">:</td>
                                        <td class="tg-gvcd font-weight-bolder">{{$data->bets}}</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-v0nz" style="width: 200px">Jumlah Renprod</td>
                                        <td class="tg-v0nz">:</td>
                                        <td class="tg-gvcd font-weight-bolder">{{$data->renprod}}</td>
                                        <td class="tg-v0nz"></td>
                                        <td class="tg-v0nz" style="width: 250px">Assign Ke Lafi</td>
                                        <td class="tg-v0nz">:</td>
                                        <td class="tg-gvcd">
                                            <div class="badge badge-light-primary badge-sm mr-25">{{$data->lafi}}</div>
                                        </td>
                                    </tr>
                                </table>
                                @php $no = 0; @endphp
                                @foreach($data->detil_renprod as $d)
                                @php $no++; @endphp
                                <section id="accordion-with-margin" class="mb-2">
                                    <div class="collapse-icon">
                                        <div class="collapse-margin" id="accordionExample">
                                            <div class="card">
                                                <div class="card-header" data-toggle="collapse" role="button" data-target="#c{{$d->id_detil_renprod}}" aria-expanded="false" aria-controls="c{{$d->id_detil_renprod}}">
                                                    <span class="lead collapse-title"> <i data-feather="command" class="font-medium-5 mr-75"></i> Bets <span id="lbl_{{$d->id_detil_renprod}}">{{$d->no_bets ?? $no}} </span></span>
                                                </div>
                                                <div id="c{{$d->id_detil_renprod}}" class="collapse" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <div class="row d-flex align-items-end">
                                                            <div class="col-md-6 col-6">
                                                <form id="form_{{$d->id_detil_renprod}}">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label">No. Bets</label>
                                                        <input type="text" class="form-control" name="nobets" placeholder="No. Bets" value="{{$d->no_bets}}" required />
                                                        <div class="invalid-feedback">Nomor harus diisi</div>
                                                    </div>
                                                    @php
                                                    $thp = array();
                                                    $d->load('progress_produksi');
                                                    foreach($d->progress_produksi as $p) {
                                                        $thp[$p->id_tahap] = "['" . substr($p->tgl_rencana_mulai, 0, 10) . "', '" . substr($p->tgl_rencana_selesai, 0, 10) . "']";
                                                    }
                                                    @endphp
                                                    <div class="row">
                                                        <div class="col-md-6">Tahap Produksi</div>
                                                        <div class="col-md-6">Tanggal Rencana Mulai & Selesai</div>
                                                    </div>
                                                    @foreach($data->kemasan->satuan_produk->tahap_produksi as $tahap)
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <input type="text" class="form-control" value="{{$tahap->nama_tahap}}" readonly />  
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <input type="text" id="tgl_{{$d->id_detil_renprod}}{{$tahap->id_tahap}}" name="progress[{{$tahap->id_tahap}}]" class="form-control flatpickr-range tgl_{{$d->id_detil_renprod}}" placeholder="Tanggal" data-val="{!!$thp[$tahap->id_tahap] ?? ''!!}" required />
                                                            <div class="invalid-feedback tgl-fb">Tanggal harus diisi</div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-6 text-right">
                                                                <button class="btn btn-icon btn-primary" type="button" id="btn_{{$d->id_detil_renprod}}">
                                                                    <span>Simpan Data</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                @endforeach
                                @endif
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
        $( document ).ready(function() {
            $('.flatpickr-range').flatpickr({
                mode: 'range',
                altInput: true,
                altFormat: 'd/m/Y',
                dateFormat: 'Y-m-d'
            });
            $('.flatpickr-range').each(function() {
                if ($(this).attr('id') && $(this).data('val') != '') this._flatpickr.setDate(eval($(this).data('val')));
            });
            $('.flatpickr-range').change(function() {
                $(this).parent().find('.tgl-fb').css('display', 'none');
            });
            $('.btn-icon').click(function() {
                id = $(this).attr('id').substr(4);
                $('#form_' + id).removeClass('was-validated');
                tglKosong = 0;
                $('.tgl_' + id).each(function() {
                    if ($(this).val() == '') {
                        tglKosong++;
                        $(this).parent().find('.tgl-fb').css('display', 'block');
                    }
                });
                if ($('#form_' + id)[0].checkValidity() && tglKosong == 0) {
                    $(this).prop('disabled', true);
                    $(this).text('Menyimpan...');
				    $.ajax({
                        url: '/lafibiovak/produksi/input',
                        method: "POST",
                        dataType: "json",
                        data: $('#form_' + id).serialize() + '&_id=' + id + '&_token=' + $('[name="csrf-token"]').attr('content'),
                        success: function (res) {
                            Swal.fire({
                                title: 'Info',
                                text: res.message,
                                icon: 'info',
                            });
                            if (!res.error) {
                                $('#lbl_' + id).html($('#form_' + id).find('[name=nobets]').val());
                            }
                        }
                    }).always(function() {
                        $("#btn_" + id).prop('disabled', false);
                        $("#btn_" + id).text('Simpan Data');
                    });
                } else {
                    $('#form_' + id).addClass('was-validated');
                }
            });
        });
    </script>
@endsection