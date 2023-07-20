@extends('partials.template')

@section('page_style')
    <style>
        .underline {
            text-decoration: underline;
        }

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

        .flatpickr-wrapper {
            display: block;
        }
    </style>
    <style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0;}
                .tg td{border-color:black;border-style:solid;border-width:1px;font-size:12px;
                  overflow:hidden;padding:5px 5px;word-break:normal;}
                .tg th{border-color:black;border-style:solid;border-width:1px;;font-size:10px;
                  font-weight:normal;overflow:hidden;padding:5px 5px;word-break:normal;}
                .tg .tg-gvcd{background-color:#ffffff;border-color:#ffffff;text-align:left;vertical-align:top;font-size: 15px}
                .tg .tg-v0nz{background-color:#ffffff;border-color:#ffffff;text-align:left;vertical-align:top;font-size: 15px}
    </style>  
@endsection

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-2">
                    <div class="row">
                        <div class="col-6">
                            <h2 class="content-header-title float-left mb-0">Detail Renprod </h2>
                        </div>

                        {{-- Modal --}}
                        <div class="modal fade text-left" id="form_prod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel18">Input Hasil Produksi</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">     
                                        <form> 
                                            <div class="form-group form-input">
                                                <label class="form-label" for="jml">Jumlah Produksi</label>
                                                <input type="number" name="jml" class="form-control" placeholder="Jumlah Produksi" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fp-human-friendly">Tanggal Expired</label>
                                                <input type="text" name="tgl" class="form-control flatpickr-human-friendly" placeholder="Tanggal Expired" required />
                                                <div class="invalid-feedback exp-fb">Tanggal harus diisi</div>
                                            </div>
                                            @csrf
                                            <input type="hidden" name="_id" />
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary">Simpan Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-1">
                            <div class="card-body">
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
                                        @foreach($data->lafi as $d)
                                            <div class="badge badge-light-primary badge-sm mr-25">
                                                {{$d}}
                                            </div>
                                        @endforeach
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="data-renprod table table-striped table-responsive-xl">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>No. Bets</th>
                                            @if(!Auth::user()->id_faskes)
                                            <th>Lafi</th>
                                            @endif
                                            <th>Tanggal Selesai Produksi</th>
                                            <th class="text-center">Jumlah Hasil Produksi</th>
                                            <th>Tanggal Expired</th>
                                            <th>Aksi</th>
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
    var table_;
    $( document ).ready(function() {
        $(".flatpickr-human-friendly").flatpickr({
            static: true,
            altInput: true,
            altFormat: 'd/m/Y',
            minDate: "today",
            dateFormat: 'Y-m-d'
        });
        table_ = $('.data-renprod').DataTable({
            ajax: '{{ url("lafibiovak/persediaan/list-detail") . "/" . request()->segment(4) }}',
            columns: [
              { data: 'DT_RowIndex',
                className: 'text-center', },
              { data: 'no_bets',
                className: 'text-center', },
              @if(!Auth::user()->id_faskes)
              { data: 'id_pelaksana',
                className: 'text-center', },
              @endif
              { data: 'tgl_selesai_prod',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    return (data ?
                        new Date(data).toLocaleString('id-ID', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit'
                        }) : 'Belum Selesai'
                    );
                }
              },
              { data: 'jml_hasil_produksi', className: 'text-right',
                render: function(data, type, full, meta) {
                    return (formatRupiah(data));
                }
              },
              { data: 'tgl_expired',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    return (data ?
                        new Date(data).toLocaleString('id-ID', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit'
                        }) : '-'
                    );
                }
              },
              { data: 'action',
                className: 'text-center',
                orderable: false,
                searchable: false
              },
            ],
            "drawCallback": function(settings) {
                feather.replace();
            }
        });

        $("input[name=tgl]").change(function() {
            $('.exp-fb').css('display', 'none');
        });

        $(".modal-footer button").click(function() {
            if ($('form')[0].checkValidity() && $('input[name=tgl]').val() != '') {
                $(this).prop('disabled', true);
                $(this).text('Menyimpan...');
                $.ajax({
                    url: "{{ url('lafibiovak/persediaan/input') }}",
                    method: 'post',
                    dataType: "json",
                    data: $('form').serialize(),
                    success: function(res) {
                        if (!res.error) table_.ajax.reload();
                        Swal.fire({
                            title: 'Info',
                            text: res.message,
                            icon: 'info',
                        });
                    }
                }).always(function() {
                    $(".modal-footer button").prop('disabled', false);
                    $(".modal-footer button").text('Simpan Data');
                    $('#form_prod').modal('hide');
                });
            } else {
                $('form').addClass('was-validated');
                if ($('input[name=tgl]').val() == '') $('.exp-fb').css('display', 'block');
            }
        });
    });

    function edit_prod(e) {
        $('input[name=_id]').val(e.attr('data-id'));
        $('input[name=jml]').val(e.attr('data-jml'));
        document.querySelector(".flatpickr-human-friendly")._flatpickr.setDate(e.attr('data-exp'));
        $('#form_prod').modal('show');
    }
</script>
@endsection
