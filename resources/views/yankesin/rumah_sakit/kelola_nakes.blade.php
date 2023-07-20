@extends('partials.template')

@section('page_style')
<style>
    .underline { text-decoration: underline; }
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
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Daftar Nakes</h2>
                        </div>
                    </div>
                </div>   
            </div>    
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{ $rs->nama_rs }} </b></h2>
                        </div>
                    </div>
                </div>
            </div>        
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <nav class="nav-justified">
                                        <div class="nav nav-tabs mb-0" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active m-2 mb-0" id="nav-nakes-tab" data-toggle="tab"
                                                href="#nav-nakes" role="tab" aria-controls="nav-nakes"
                                                aria-selected="true"><span class="font-medium-4 font-weight-bolder">Data Medis</span></a>
                                            <a class="nav-item nav-link m-2 mb-0" id="nav-paramedis-tab" data-toggle="tab"
                                                href="#nav-paramedis" role="tab" aria-controls="nav-paramedis"
                                                aria-selected="false"><span class="font-medium-4 font-weight-bolder">Data Paramedis</span></a>
                                            <a class="nav-item nav-link m-2 mb-0" id="nav-nonmedis-tab" data-toggle="tab"
                                                href="#nav-nonmedis" role="tab" aria-controls="nav-nonmedis"
                                                aria-selected="false"><span class="font-medium-4 font-weight-bolder">Data Nakes Lainnya</span></a>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-nakes" role="tabpanel"
                                            aria-labelledby="nav-nakes-tab">
                                            <div class="card-header border-bottom pt-0">
                                                <h4 class="card-title">Daftar Medis</h4>
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#nakes">Edit Data Medis</button></a>
                                            </div>

                                            {{-- Modal Nakes --}}
                                            <div class="modal fade text-left" id="nakes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel18">Edit Data Medis</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body"> 
                                                            <div class="row">
                                                                <div class="col-md-6 col-12 mb-1">
                        
                                                                </div>
                                                                <div class="col-md-6 col-12 mb-1">
                                                                    Medis Honorer
                                                                </div>
                                                            </div>
                                                            <form id="form_nakes">
                                                                @for ($i=0;$i<count($data2);$i++)
                                                                @php $n = strrpos($data2[$i], ' '); @endphp
                                                                <div class="row">
                                                                    <div class="col-md-6 col-12 mb-1">
                                                                        {{substr($data2[$i], 0, $n)}}
                                                                    </div>
                                                                    @for ($j=0;$j<1;$j++)
                                                                    <div class="col-md-6 col-12 mb-1">
                                                                        <div class="form-group">
                                                                            <input type="number" class="form-control" name="d{{$data1[$data2[$i+$j]]['idf']}}" placeholder="Jumlah" value="{{$data1[$data2[$i+$j]]['jumlah']}}" min="0" required />
<div class="invalid-feedback">Jumlah harus diisi</div>
                                                                        </div>
                                                                    </div>
                                                                    @endfor
                                                                </div>
                                                                @endfor
                                                                @csrf
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button id="btn_nakes" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Code Changes: Remove table-responsive-lg -->
                                            <table class="dt-nakes table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Medis</th>
                                                        <th>Jumlah Medis Honorer</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="nav-paramedis" role="tabpanel"
                                            aria-labelledby="nav-paramedis-tab">
                                            <div class="card-header border-bottom pt-0">
                                                <h4 class="card-title">Daftar Paramedis</h4>
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#paramedis">Edit Data Paramedis</button></a>
                                            </div>

                                            {{-- Modal Paramedis --}}
                                            <div class="modal fade text-left" id="paramedis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel18">Edit Data Paramedis</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body"> 
                                                            <div class="row">
                                                                <div class="col-md-6 col-12 mb-1">
                        
                                                                </div>
                                                                <div class="col-md-6 col-12 mb-1">
                                                                    Paramedis Honorer
                                                                </div>
                                                            </div>
                                                            <form id="form_paramedis">
                                                                @for ($i=0;$i<count($datap2);$i++)
                                                                @php $n = strrpos($datap2[$i], 'Honorer') === false ? strlen($datap2[$i]) : strrpos($datap2[$i], ' '); @endphp
                                                                <div class="row">
                                                                    <div class="col-md-6 col-12 mb-1">
                                                                        {{substr($datap2[$i], 0, $n)}}
                                                                    </div>
                                                                    @for ($j=0;$j<1;$j++)
                                                                    <div class="col-md-6 col-12 mb-1">
                                                                        <div class="form-group">
                                                                            <input type="number" class="form-control" name="d{{$datap1[$datap2[$i+$j]]['idf']}}" placeholder="Jumlah" value="{{$datap1[$datap2[$i+$j]]['jumlah']}}" min="0" required />
<div class="invalid-feedback">Jumlah harus diisi</div>
                                                                        </div>
                                                                    </div>
                                                                    @endfor
                                                                </div>
                                                                @endfor
                                                                @csrf
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button id="btn_paramedis" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="dt-paramedis table table-striped table-responsive-lg">
                                                <thead>
                                                    <tr>
                                                        <th>Paramedis</th>
                                                        <th>Jumlah Paramedis Honorer</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="nav-nonmedis" role="tabpanel"
                                            aria-labelledby="nav-nonmedis-tab">
                                            <div class="card-header border-bottom pt-0">
                                                <h4 class="card-title">Daftar Nakes Lainnya</h4>
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#nonmedis">Edit Data Nakes Lainnya</button></a>
                                            </div>

                                            {{-- Modal Non-Medis --}}
                                            <div class="modal fade text-left" id="nonmedis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel18">Edit Data Nakes Lainnya</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">

                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Nakes Lainnya TNI
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Nakes Lainnya PNS
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Nakes Lainnya Honorer
                                                                </div>
                                                            </div>
                                                            <form id="form_nonmedis">
                                                                @for ($i=0;$i<count($datan2)/3;$i++)
                                                                @php $n = strrpos($datan2[$i*3], ' '); @endphp
                                                                <div class="row">
                                                                    <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                        {{substr($datan2[$i*3], 0, $n)}}
                                                                    </div>
                                                                    @for ($j=0;$j<3;$j++)
                                                                    <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                        <div class="form-group">
                                                                            <input type="number" class="form-control" name="d{{$datan1[$datan2[$i*3+$j]]['idf']}}" placeholder="Jumlah" value="{{$datan1[$datan2[$i*3+$j]]['jumlah']}}" min="0" required />
<div class="invalid-feedback">Jumlah harus diisi</div>
                                                                        </div>
                                                                    </div>
                                                                    @endfor
                                                                </div>
                                                                @endfor
                                                                @csrf
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button id="btn_nonmedis" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="dt-nonmedis table table-striped table-responsive-lg">
                                                <thead>
                                                    <tr>
                                                        <th>Nakes Lainnya</th>
                                                        <th>Jumlah Nakes Lainnya TNI</th>
                                                        <th>Jumlah Nakes Lainnya PNS</th>
                                                        <th>Jumlah Nakes Lainnya Honorer</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Multilingual -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        $( document ).ready(function() {
            dt_nakes_table = $('.dt-nakes').DataTable({
                ajax: '/yankesin/data-nakes/Nakes/{{ $rs->id_rs }}',
                columns: [
                    { data: 'nakes' },
                    { data: 'honorer' }
                ],
                columnDefs: [{
                    className: 'control',
                    orderable: false,
                    targets: 0
                },{
                    className: 'text-center',
                    targets: [1]
                }]
            });
            dt_paramedis_table = $('.dt-paramedis').DataTable({
                ajax: '/yankesin/data-nakes/Paramedis/{{ $rs->id_rs }}',
                columns: [
                    { data: 'paramedis' },
                    { data: 'honorer' }
                ],
                columnDefs: [{
                    className: 'control',
                    orderable: false,
                    targets: 0
                },{
                    className: 'text-center',
                    targets: [1]
                }]
            });
            dt_nonmedis_table = $('.dt-nonmedis').DataTable({
                ajax: '/yankesin/data-nakes/Non-Medis/{{ $rs->id_rs }}',
                columns: [
                    { data: 'non-medis' },
                    { data: 'tni' },
                    { data: 'pns' },
                    { data: 'honorer' }
                ],
                columnDefs: [{
                    className: 'control',
                    orderable: false,
                    targets: 0
                },{
                    className: 'text-center',
                    targets: [1,2,3]
                }]
            });
            $('.modal-footer button').click(function() {
                id = $(this).attr('id').substr(4);
                if (!$('#form_'+id)[0].checkValidity()) {
                    $('#form_'+id).addClass('was-validated');
                    return;
                }
                $(this).prop('disabled', true);
                $(this).text('Menyimpan...');
				$.ajax({
                    url: '/yankesin/input/nakes',
                    method: "POST",
                    dataType: "json",
                    data: $('#form_'+id).serialize()+'&id_rs={{ $rs->id_rs }}',
                    success: function (res) {
                        if (!res.error) {
                            eval('dt_'+id+'_table.ajax.reload()');
                            Swal.fire({
                                title: 'Info',
                                text: res.message,
                                icon: 'info',
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            });
                            $('#form_'+id).removeClass('was-validated');
                        }
                    }
                }).always(function() {
                    $('#btn_'+id).prop('disabled', false);
                    $('#btn_'+id).text('Simpan');
                    $('#'+id).modal('hide');
                });
            });
        });
    </script>
@endsection