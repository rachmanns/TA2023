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

        table.dataTable tbody td {
            vertical-align: top;
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
                            <h2 class="content-header-title float-left mb-0">Masukkan Ke Gudang</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2 col-12 my-auto">
                                    <span class='badge badge-light-primary font-small-4'><span id="checkeds">0</span> Barang
                                        Terpilih</span>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <select class="select2 form-control form-control-lg">
                                        <option selected disabled>Pilih Gudang</option>
                                        <option>Gudang 1</option>
                                        <option>Gudang 2</option>
                                        <option>Gudang 3</option>
                                    </select>
                                </div>
                                <div class="col-lg-7 col-12">
                                    <button class="btn btn-primary" id="btn_inp" disabled>Masukkan Barang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="barang-masuk table table-striped">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>id</th>
                                            <th class="text-center">Nama Bekkes/Alkes</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">Exp Date</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            {{-- Edit --}}
                            <div class="modal fade text-left" id="edit" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel18" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel18">Pendataan Expired Date</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h4 class="font-weight-bolder">Ponstal 500 Mg</h4>
                                            <h5 class="font-weight-bolder">Jumlah <span class="text-primary">46.000
                                                    Kaplet</span></h5>
                                            <div class="text-warning">
                                                <i data-feather="info" class="mr-50 align-middle"></i>
                                                <span>Pastikan Jumlah Barang Sesuai</span>
                                            </div>

                                            <section class="form-control-repeater mt-1">
                                                <form class="invoice-repeater" novalidate>
                                                    <div data-repeater-list="invoice">
                                                        <div data-repeater-item>
                                                            <div class="row d-flex align-items-end">
                                                                <div class="col-md-5 col-12">
                                                                    <div class="form-group">
                                                                        <label for="fp-human-friendly">Expired</label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Expired" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-5 col-12">
                                                                    <div class="form-group">
                                                                        <label for="itemcost">Jumlah</label>
                                                                        <input type="number" class="form-control"
                                                                            aria-describedby="itemcost" placeholder="Jumlah"
                                                                            required min="1" />
                                                                        <div class="invalid-feedback">Jumlah harus diisi dan
                                                                            lebih dari 0</div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-2 col-12 mt-50 text-right">
                                                                    <div class="form-group">
                                                                        <button
                                                                            class="btn btn-outline-danger text-nowrap px-1"
                                                                            data-repeater-delete type="button">
                                                                            <i data-feather="x"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2 mb-1">
                                                        <div class="col-6">
                                                            <button id="btn_exp" class="btn btn-icon btn-outline-primary"
                                                                type="button" data-repeater-create>
                                                                <i data-feather="plus" class="mr-25"></i>
                                                                <span>Tambah Exp Date</span>
                                                            </button>
                                                        </div>
                                                        <div class="col-6 text-right">
                                                            <button id="btn_save" type="button"
                                                                class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </div>
                                                    @csrf
                                                </form>
                                            </section>
                                        </div>
                                    </div>
                                </div>
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
        var data = [],
            id, table_, currExp;
        var defdata = {
            exp: null,
            jml: null
        };

        function table_reload() {
            table_ = $('.barang-masuk').DataTable({
                scrollX: true,
                ajax: '{{ route('dobekkes.barang_masuk.list_barang', request()->segment(3)) }}',
                destroy: true,
                columns: [{
                        data: 'responsive_id'
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'id'
                    }, // used for sorting so will hide this column
                    {
                        data: 'nama_matkes'
                    },
                    {
                        data: 'jml'
                    },
                    {
                        data: 'exp_date'
                    },
                    {
                        data: 'action'
                    }
                ],
                columnDefs: [{
                        className: 'control',
                        orderable: false,
                        responsivePriority: 2,
                        targets: 0
                    },
                    {
                        targets: 1,
                        orderable: false,
                        responsivePriority: 3,
                        render: function(data, type, full, meta) {
                            return (
                                '<div class="custom-control custom-checkbox"> <input class="custom-control-input dt-checkboxes" type="checkbox" value="" id="checkbox' +
                                data +
                                '" /><label class="custom-control-label" for="checkbox' +
                                data +
                                '"></label></div>'
                            );
                        },
                        checkboxes: {
                            selectAllRender: '<div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                        }
                    },
                    {
                        targets: 2,
                        visible: false
                    },
                    {
                        responsivePriority: 1,
                        className: 'text-center',
                        targets: 4
                    },
                    {
                        className: 'text-center',
                        targets: [5]
                    },
                    {
                        targets: -1,
                        orderable: false,
                    }
                ],
                order: [
                    [2, 'desc']
                ],
                displayLength: 7,
                lengthMenu: [7, 10, 25, 50, 75, 100],
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function(row) {
                                var data = row.data();
                                return 'Details of ' + data['full_name'];
                            }
                        }),
                        type: 'column',
                        renderer: function(api, rowIdx, columns) {
                            var data = $.map(columns, function(col, i) {
                                return col.title !==
                                    '' // ? Do not show row in modal popup if title is blank (for check box)
                                    ?
                                    '<tr data-dt-row="' +
                                    col.rowIndex +
                                    '" data-dt-column="' +
                                    col.columnIndex +
                                    '">' +
                                    '<td>' +
                                    col.title +
                                    ':' +
                                    '</td> ' +
                                    '<td>' +
                                    col.data +
                                    '</td>' +
                                    '</tr>' :
                                    '';
                            }).join('');

                            return data ? $('<table class="table"/>').append(data) : false;
                        }
                    }
                },
                "drawCallback": function(settings) {
                    feather.replace();
                },
                initComplete: function(settings, json) {
                    $('input[type="checkbox"]').change(function() {
                        cb = $('.dt-checkboxes:checked').length;
                        $('#checkeds').text(cb);
                        $('#btn_inp').prop('disabled', !cb);
                    });
                }
            });
        }
        $(document).ready(function() {
            table_reload();

            $("#btn_save").click(function() {
                if ($('form')[0].checkValidity()) {
                    jumlah = 0;
                    $("[data-repeater-item]").each(function() {
                        jumlah += parseInt($(this).find('input[type="number"]').val());
                    });
                    if (jumlah > parseInt($('.modal-body h5 span').text())) {
                        Swal.fire({
                            title: 'Info',
                            text: 'Jumlah melebihi stok',
                        });
                        return;
                    }
                    data[id] = [];
                    exp = '';
                    jml = '';
                    $("[data-repeater-item]").each(function() {
                        d = {
                            id: id,
                            exp: $(this).find('input[type="hidden"]').val(),
                            jml: $(this).find('input[type="number"]').val()
                        };
                        data[id].push(d);
                        jml += '<div>' + d.jml + ' ' + $('#sat' + id).html() + '</div>';
                        exp_alt = $(this).find('input[type="text"]').val();
                        exp += '<div>' + (exp_alt == null || exp_alt.length < 5 ? '-' : exp_alt) +
                            '</div>';
                    });
                    $('#jml' + id).html(jml);
                    $('#exp' + id).html(exp);
                    $('#edit').modal('hide');
                } else $('form').addClass('was-validated');
            });

            $('#btn_exp').click(function() {
                $("[data-repeater-item]").last().find('input[type="hidden"]').remove();
                $("[data-repeater-item]").last().find('input[type="text"]').flatpickr({
                    altInput: true,
                    altFormat: 'd/m/Y',
                    minDate: "today",
                    defaultDate: currExp,
                    dateFormat: 'Y-m-d'
                });
            });

            $("#btn_inp").click(function() {
                if (!$('select').val()) {
                    Swal.fire({
                        title: 'Info',
                        text: 'Gudang belum dipilih',
                    });
                    return;
                }
                var fd = [];
                $('.dt-checkboxes:checked').each(function() {
                    id = $(this).attr('id').substr(8);
                    if (!data[id]) {
                        data[id] = [{
                            id: id,
                            ...defdata
                        }];
                        data[id][0].jml = $('[data-id="' + id + '"]').attr('data-jml');
                    }
                    for (i = 0; i < data[id].length; i++) {
                        fd.push(data[id][i]);
                    }
                });
                $(this).prop('disabled', true);
                $(this).text('Menyimpan...');
                $.ajax({
                    url: '{{ route('dobekkes.barang_masuk.input_barang_gudang') }}',
                    method: 'post',
                    dataType: "json",
                    data: '_token=' + $('input[name=_token]').val() + '&form_data=' + JSON
                        .stringify(fd) + '&idg=' + $('select').val(),
                    success: function(res) {
                        if (res.error) $(".modal-footer button").prop('disabled', false);
                        else {
                            $('#checkeds').text('0');
                            data = [];
                            table_reload();
                            Swal.fire({
                                title: 'Info',
                                text: res.message,
                            });
                        }
                    }
                }).always(function() {
                    $("#btn_inp").text('Masukkan Barang');
                });
            });
        });

        function edit_exp(e) {
            id = e.attr('data-id');
            $('.modal-body h4').text(e.attr('data-nama'));
            $('.modal-body h5 span').text(e.attr('data-jml'));
            $('form').removeClass('was-validated');
            $("[data-repeater-list='invoice']").html('');
            if (!data[id]) data[id] = [{
                id: id,
                ...defdata
            }];
            for (i = 0; i < data[id].length; i++) {
                currExp = data[id][i].exp;
                $('#btn_exp').click();
                $("[data-repeater-item]").eq(i).find('input[type="number"]').val(data[id][i].jml);
            }
            currExp = null;
            $('#edit').modal('show');
        }
    </script>
@endsection
