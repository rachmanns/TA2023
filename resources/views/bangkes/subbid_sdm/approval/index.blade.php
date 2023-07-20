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
                <div class="content-header-left col-md-9 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Daftar Approval</h2>
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
                                                aria-selected="true"><span class="font-medium-4 font-weight-bolder">Tenaga Medis</span></a>
                                            <a class="nav-item nav-link m-2 mb-0" id="nav-paramedis-tab" data-toggle="tab"
                                                href="#nav-paramedis" role="tab" aria-controls="nav-paramedis"
                                                aria-selected="false"><span class="font-medium-4 font-weight-bolder">Paramedis</span></a>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-nakes" role="tabpanel"
                                            aria-labelledby="nav-nakes-tab">
                                            <div class="row mb-1">
                                                <div class="col-md-2 ml-1">
                                                        <select id="status_dokter" class="select2 form-control">
                                                            <option value="Disetujui">Disetujui</option>
                                                            <option value="Ditolak">Ditolak</option>
                                                        </select>
                                                </div>
                                                <div class="col-2">
                                                    <button class="btn btn-primary" id="submit-dokter">Proses</button>
                                                </div>
                                                <div class="col-md-7 text-right">
                                                    <h3>0 Dipilih</h3>
                                                </div>
                                            </div>
                                            <table class="table" id="dokter-table">
                                                <thead>
                                                    <tr>
                                                        <th>id</th>
                                                        <th style="min-width: 150px;">Sebaran</th>
                                                        <th style="min-width: 150px;" class="text-center">Kategori</th>
                                                        <th style="min-width: 150px;">Spesialis</th>
                                                        <th style="min-width: 200px;">Nama</th>
                                                        <th>Matra</th>
                                                        <th>Pangkat/NRP/NIP</th>
                                                        <th>Jabatan Struktural</th>
                                                        <th>Jabatan Fungsional</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="nav-paramedis" role="tabpanel"
                                            aria-labelledby="nav-paramedis-tab">
                                            <div class="row mb-1">
                                                <div class="col-md-2 ml-1">
                                                        <select id="status_paramedis" class="select2 form-control">
                                                            <option value="Disetujui">Disetujui</option>
                                                            <option value="Ditolak">Ditolak</option>
                                                        </select>
                                                </div>
                                                <div class="col-2">
                                                    <button class="btn btn-primary" id="submit-paramedis">Proses</button>
                                                </div>
                                                <div class="col-md-7 text-right">
                                                    <h3>0 Dipilih</h3>
                                                </div>
                                            </div>
                                            <table class="table" id="paramedis-table">
                                                <thead>
                                                    <tr>
                                                        <th>id</th>
                                                        <th style="min-width: 150px;">Sebaran</th>
                                                        <th style="min-width: 150px;" class="text-center">Kategori</th>
                                                        <th>Ijazah</th>
                                                        <th style="min-width: 200px;">Nama</th>
                                                        <th>Matra</th>
                                                        <th>Pangkat/NRP/NIP</th>
                                                        <th>Jabatan Struktural</th>
                                                        <th>Jabatan Fungsional</th>
                                                        <th>Keterangan</th>
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
        $('#dokter-table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                scrollX : true,
                ajax: "{{ url('bangkes/approval-nakes/get_dokter') }}",
                columns: [
                    {
                        data: 'id_dokter',
                        name: 'id_dokter'
                    },
                    {
                        data: 'sebaran',
                        name: 'sebaran'
                    },
                    {
                        data: 'kategori_dokter',
                        name: 'kategori_dokter'
                    },
                    {
                        data: 'nama_spesialis',
                        name: 'nama_spesialis'
                    },
                    {
                        data: 'nama_dokter',
                        name: 'nama_dokter'
                    },
                    {
                        data: 'matra',
                        name: 'matra'
                    },
                    {
                        data: 'pangkat_korps',
                        name: 'pangkat_korps'
                    },
                    {
                        data: 'jabatan_struktural',
                        name: 'jabatan_struktural'
                    },
                    {
                        data: 'jabatan_fungsional',
                        name: 'jabatan_fungsional'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    }
                ],
                columnDefs: [
                    {
                        // For Checkboxes
                        targets: 0,
                        orderable: false,
                        responsivePriority: 3,
                        render: function (data, type, full, meta) {
                            return (
                            '<div class="custom-control custom-checkbox"> <input class="custom-control-input dt-checkboxes dokter-checkbox" type="checkbox" value="" id="checkbox' +
                            data +
                            '" /><label class="custom-control-label" for="checkbox' +
                            data +
                            '"></label></div>'
                            );
                        },
                        checkboxes: {
                            selectAllRender:
                            '<div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                        }
                    }
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });

            $('#paramedis-table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                scrollX : true,
                ajax: "{{ url('bangkes/approval-nakes/get_paramedis') }}",
                columns: [
                    {
                        data: 'id_paramedis',
                        name: 'id_paramedis'
                    },
                    {
                        data: 'sebaran',
                        name: 'sebaran'
                    },
                    {
                        data: 'jenis_paramedis',
                        name: 'jenis_paramedis'
                    },
                    {
                        data: 'jenis_ijazah',
                        name: 'jenis_ijazah'
                    },
                    {
                        data: 'nama_paramedis',
                        name: 'nama_paramedis'
                    },            
                    {
                        data: 'matra',
                        name: 'matra'
                    },
                    {
                        data: 'pangkat',
                        name: 'pangkat'
                    },
                    {
                        data: 'jabatan_struktural',
                        name: 'jabatan_struktural'
                    },
                    {
                        data: 'jabatan_fungsional',
                        name: 'jabatan_fungsional'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    }
                ],
                columnDefs: [
                    {
                        // For Checkboxes
                        targets: 0,
                        orderable: false,
                        responsivePriority: 3,
                        render: function (data, type, full, meta) {
                            return (
                            '<div class="custom-control custom-checkbox"> <input class="custom-control-input dt-checkboxes paramedis-checkbox" type="checkbox" value="" id="checkbox' +
                            data +
                            '" /><label class="custom-control-label" for="checkbox' +
                            data +
                            '"></label></div>'
                            );
                        },
                        checkboxes: {
                            selectAllRender:
                            '<div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                        }
                    }
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
    
            });

            $('#submit-dokter').click(function(){
                let checked_dokter = [];
                let status_dokter = $('#status_dokter').val();
                $('.dokter-checkbox:checked').each(function(index, value) {
                    let id_dokter = this.id.substr(8);
                    checked_dokter.push(id_dokter)
                });

                

                let data = {
                    _token:"{{ csrf_token() }}",
                    status_dokter:status_dokter,
                    checked_dokter:checked_dokter,
                }

                approve(data,'dokter');
            })

            $('#submit-paramedis').click(function(){
                let checked_paramedis = [];
                let status_paramedis = $('#status_paramedis').val();
                $('.paramedis-checkbox:checked').each(function(index, value) {
                    let id_paramedis = this.id.substr(8);
                    checked_paramedis.push(id_paramedis)
                });

                

                let data = {
                    _token:"{{ csrf_token() }}",
                    status_paramedis:status_paramedis,
                    checked_paramedis:checked_paramedis,
                }

                approve(data,'paramedis');
            })

            function approve(data,ket_peserta) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: "PUT",
                            url: "{{ url('bangkes/approval-nakes/approve-') }}"+ket_peserta,
                            data: data,
                            success: function(response) {
                                 
                            }
                        })

                        Swal.fire(
                        'Updated!',
                        'Your file has been updated.',
                        'success'
                        ).then(()=>{
                            setTimeout(function () { $('#'+ket_peserta+'-table').DataTable().ajax.reload(); }, 1000);
                        })
                    }
                })
            }
    </script>
@endsection
