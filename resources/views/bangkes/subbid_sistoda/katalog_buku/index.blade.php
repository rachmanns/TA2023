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
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol> --}}
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <section id="knowledge-base-search">
                    <div class="row">
                        <div class="col-12">
                            <div class="card knowledge-base-bg"
                                style="background-image: url('../../../app-assets/images/banner/banner.png')">
                                <div class="card-body">
                                    <h2 class="text-primary text-center">Daftar Katalog Buku Sistoda</h2>
                                    <p class="card-text mb-2 text-center">
                                        <span>Silahkan Menggunakan Sistem Pencarian untuk Menemukan Buku Dengan Cepat</span>
                                    </p>
                                    <form class="kb-search-input">
                                        <div class="row">
                                            {{-- <div class="col-6">
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i data-feather="search"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="searchbar"
                                                        placeholder="Ask a question..." />
                                                </div>
                                            </div> --}}
                                            <div class="col-12">
                                                <select id="id_kat_buku" class="form-control select2">
                                                    <option selected disabled>Select</option>
                                                    @foreach ($kategori_buku as $kb)
                                                        <option value="{{ $kb->id_kat_buku }}">{{ $kb->nama_kat_buku }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {{-- <section id="knowledge-base-search">
                    <div class="row">
                        <div class="col-12">
                            <div class="card knowledge-base-bg"
                                style="background-image: url('../../../app-assets/images/banner/banner.png')">
                                <div class="card-body">
                                    <h1 class="text-primary text-center">Daftar Katalog Buku Sistoda</h1>
                                    <p class="card-text text-center mb-2">
                                        <span>Silahkan Menggunakan Sistem Pencarian untuk Menemukan Buku Dengan Cepat</span>
                                    </p>
                                    <form class="kb-search-input">
                                        <div class="row justify-content-center">
                                            <div class="col-5">
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i data-feather="search"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="searchbar"
                                                        placeholder="Ask a question..." />
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <select id="id_provinsi" class="form-control select2">
                                                    <option selected disabled>Select</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> --}}

                <!-- BEGIN: Content-->
                <div class="ecommerce-application">
                    <div class="content-wrapper">
                        <div class="content-detached">
                            <div class="content-body">
                                <!-- E-commerce Content Section Starts -->
                                <section id="ecommerce-header">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body pb-0">
                                                    <div class="ecommerce-header-items">
                                                        <div class="search-results my-auto">
                                                            {{-- <h4>{{ $count_buku }} judul telah
                                                                tersedia!</h4> --}}
                                                        </div>
                                                        {{-- <div class="result-toggler">
                                                            <button type="button"
                                                                class="btn btn-outline-primary btn-lg waves-effect"><i
                                                                    data-feather="filter"
                                                                    class="font-medium-3 mr-50"></i>Short By</button>
                                                        </div> --}}
                                                    </div>
                                                    {{-- <a href="/detail_buku">
                                                        <div class="card bg-light-secondary mt-2">
                                                            <div class="card-body p-0">
                                                                <div class="row my-auto">
                                                                    <div class="col-md-2 col-12">
                                                                        <img src="../../../app-assets/images/pages/eCommerce/buku.png" alt="img-placeholder" height="170px"/>
                                                                    </div>
                                                                    <div class="col-md-6 col-12 my-auto">
                                                                        <div class="item-options">
                                                                            <div class="item-wrapper">
                                                                                <div class="item-cost">
                                                                                    <h4>PERATURAN BARIS BERBARIS TENTARA NASIONAL INDONESIA</h4>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 col-12 my-auto text-center">
                                                                        <div class="item-options">
                                                                            <div class="item-wrapper">
                                                                                <div class="item-cost">
                                                                                    <h4>Perpang</h4>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 col-12 my-auto text-center">
                                                                        <div class="item-options">
                                                                            <div class="item-wrapper">
                                                                                <div class="item-cost">
                                                                                    <h4>2022</h4>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="/detail_buku">
                                                        <div class="card bg-light-secondary mt-2">
                                                            <div class="card-body p-0">
                                                                <div class="row my-auto">
                                                                    <div class="col-md-2 col-12">
                                                                        <img src="../../../app-assets/images/pages/eCommerce/buku.png" alt="img-placeholder" height="170px"/>
                                                                    </div>
                                                                    <div class="col-md-6 col-12 my-auto">
                                                                        <div class="item-options">
                                                                            <div class="item-wrapper">
                                                                                <div class="item-cost">
                                                                                    <h4>PERATURAN BARIS BERBARIS TENTARA NASIONAL INDONESIA</h4>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 col-12 my-auto text-center">
                                                                        <div class="item-options">
                                                                            <div class="item-wrapper">
                                                                                <div class="item-cost">
                                                                                    <h4>Perpang</h4>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 col-12 my-auto text-center">
                                                                        <div class="item-options">
                                                                            <div class="item-wrapper">
                                                                                <div class="item-cost">
                                                                                    <h4>2022</h4>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a> --}}
                                                    <table id="katalog-buku">

                                                    </table>
                                                </div>
                                            </div>
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
@endsection
@section('page_script')
    <script>

        $(function(){
            katalog_list();
        })

        $('#id_kat_buku').change(function(){
            let id_kat_buku = $(this).val();
            katalog_list(id_kat_buku);
        })

        function katalog_list(id_kat_buku='') {
            let data = {id_kat_buku:id_kat_buku,_token:"{{ csrf_token() }}"}
            $('#katalog-buku').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                        url: "{{ url('/bangkes/katalog-buku/list') }}",
                        method: 'POST',
                        data: data
                    },
                columns: [
                    {
                        data: 'row_buku',
                        name: 'row_buku'
                    }
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                },
    
            });
        }
    </script>
@endsection
