@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Input Barang TM</h2>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12 mt-50">
                    <h4 class="text-secondary">No BA: KJB/11/DN/PUSKES TNI/XI/2019/OPS</h4>
                    <h4 class="text-secondary">Jenis Barang : Alkes</h4>
                </div>    
            </div>   
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="#" class="invoice-repeater">
                                    <div data-repeater-list="invoice">
                                        <div data-repeater-item>
                                            <div class="row d-flex align-items-end">
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="no">No Kontrak</label>
                                                        <input type="text" class="form-control" id="no"  placeholder="No Kontrak" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12">
                                                    <div class="form-group">
                                                        <label for="naam">Nama Barang</label>
                                                        <input type="text" class="form-control" id="nama"  placeholder="Nama Barang" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12">
                                                    <div class="form-group">
                                                        <label for="jml">Jumlah Barang</label>
                                                        <input type="text" class="form-control" id="jml"  placeholder="Jumlah Barang" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12">
                                                    <div class="form-group">
                                                        <label for="harga">Harga Satuan</label>
                                                        <input type="text" class="form-control" id="harga"  placeholder="Harga Satuan" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12">
                                                    <div class="form-group">
                                                        <label for="total">Total</label>
                                                        <input type="text" class="form-control" id="total"  placeholder="Total" />
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-12 text-right">
                                                    <div class="form-group">
                                                        <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                            <i data-feather="trash"></i>
                                                            {{-- <span>Hapus</span> --}}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-icon btn-outline-primary" type="button" data-repeater-create>
                                                <i data-feather="plus" class="mr-25"></i>
                                                <span>Tambah Barang</span>
                                            </button>
                                        </div>
                                        <div class="col-6 text-right">
                                            <button class="btn btn-icon btn-primary" type="button">
                                                <span>Simpan Data</span>
                                            </button>
                                        </div>
                                    </div>
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