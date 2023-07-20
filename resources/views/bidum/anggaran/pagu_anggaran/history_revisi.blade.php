@extends('partials.template')

@section('page_style')
    <style>
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
                <div class="content-header-left col-md-9 col-12">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">History Revisi</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-pagu">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Tambah</th>
                                                    <th>Kurang</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($revisi as $r)
                                                    <tr>
                                                        <td>{{ date('d-m-Y',strtotime($r->created_at)) }}</td>
                                                        <td>Rp{{ indonesian_money_format($r->tambah) }}</td>
                                                        <td>Rp{{ indonesian_money_format($r->kurang) }}</td>
                                                    </tr>
                                                @empty
                                                    Data Not Found
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ $revisi->links() }}
                </section>
                <!--/ Multilingual -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        var table = $('#table-pagu').DataTable({
        });
    </script>
@endsection
