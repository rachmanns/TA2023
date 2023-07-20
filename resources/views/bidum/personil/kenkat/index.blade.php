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

        .flatpickr-wrapper {
            display: block;
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
                            <h2 class="content-header-title float-left">Daftar Kenkat - <span id="periode_month">{{ date('F Y', strtotime($date)) }}</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <select id="filter_date" class="form-control select2">
                            <option selected disabled>Pilih Periode</option>
                            @foreach ($target_tmt_kenkat as $key => $item)
                                @php
                                    $target_tmt = date('Y-m', strtotime($item->target_tmt_kenkat));
                                @endphp
                                <option value="{{ $item->target_tmt_kenkat }}" {{ ($target_tmt == $date)?'selected':'' }} >{{ date('F Y', strtotime($item->target_tmt_kenkat)) }}</option>
                            @endforeach
                        </select>
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
                                    <table class="table table-striped table-responsive-xl" id="list-kenkat">
                                        <thead>
                                            <tr>
                                                <th>Nama Personil</th>
                                                <th>Pangkat Saat Ini</th>
                                                <th>TMT Pangkat</th>
                                                <th>Periode Kenkat</th>
                                                <th>Keterangan</th>
                                                <th class="text-center" style="min-width: 150px;">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Multilingual -->
            </div>
        </div>
    </div>

    @include('bidum.personil.kenkat.modal.disetujui')
    @include('bidum.personil.kenkat.modal.ditolak')
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        $(".flatpickr-basic").flatpickr({
            static: true,
        });
        
        $(document).ready(function() {
            list_kenkat('{{ $date }}');
        });

        $('#filter_date').on('change',function() {
            list_kenkat($(this).val());
            $('#periode_month').text(moment($(this).val()).format("MMMM YYYY"));
        })

        function list_kenkat(date) {
            var url = `{{ route('bidum.personil.list_kenkat', ':date') }}`;
            url = url.replace(':date', date);

            var table = $('#list-kenkat').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: url,
                columns: [{
                        data: 'personil.nama',
                        name: 'personil.nama'
                    },
                    {
                        data: 'pangkat_terakhir',
                        name: 'pangkat_terakhir'
                    },
                    {
                        data: 'tmt_pangkat_terakhir',
                        name: 'tmt_pangkat_terakhir'
                    },
                    {
                        data: 'target_tmt_kenkat',
                        name: 'target_tmt_kenkat'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });
        }

        function disetujui(e) {
            var id_list_ukp = e.attr('data-id');
            var url = "{{ route('bidum.personil.get_kenkat', ':list_ukp') }}";
            url = url.replace(':list_ukp', id_list_ukp);

            // $('#disetujui').modal('show');

            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    $('#nama').text(response.personil.nama)
                    $('#nama_pangkat_terakhir').text(response.personil.nama_pangkat_terakhir)
                    $('#tmt_pangkat_terakhir').text(response.personil.tmt_pangkat_terakhir)
                    $('#pangkat_baru').val(response.personil.pangkat.parent.nama_pangkat)
                    $('#tmt_pangkat').val(response.target_tmt_kenkat)
                    $('#id_list_ukp').val(id_list_ukp)
                    $('#id_personil').val(response.personil.id_personil)
                    $('#id_pangkat').val(response.personil.pangkat.parent.id_pangkat)
                    $('#disetujui').modal('show');
                }
            });
        }

        function ditolak(e) {
            var id_list_ukp = e.attr('data-id');
            var url = "{{ route('bidum.personil.get_kenkat', ':list_ukp') }}";
            url = url.replace(':list_ukp', id_list_ukp);

            // $('#disetujui').modal('show');

            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    $('#nama-ditolak').text(response.personil.nama)
                    $('#pangkat-ditolak').text(response.personil.nama_pangkat_terakhir)
                    $('#tmt_pangkat-ditolak').text(response.personil.tmt_pangkat_terakhir)
                    $('#id_personil_ditolak').val(response.personil.id_personil)
                    $('#id_list_ukp_ditolak').val(id_list_ukp)
                    $('#ditolak').modal('show');
                }
            });
        }

        $(document).on('submit', '.kenkat-form', function (event) {
            event.preventDefault();
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var button = $(this).find(':submit');
                        button.prop('disabled', true)
                        button.text('Menyimpan...');
                        store_data(this, button);
                    }
                })

        });

        function store_data(content, button) {
    $('input').blur();
    let form_data = new FormData(content);
    let action = $(content).attr("action");
    $.ajax({
      url: action,
      type: 'POST',
      data: form_data,
      processData: false,  // tell jQuery not to process the data
      contentType: false,  // tell jQuery not to set contentType
      cache: false,
      success: function (response) {
        if (response.error) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: response.message
          })
        } else {
          Swal.fire(
            'Success!',
            response.message,
            'success'
          ).then(() => {
            if (response.modal) {
              setTimeout(function () { $(response.table).DataTable().ajax.reload(); }, 1000);
              var reset_form = content;
              // $(reset_form).removeClass('was-validated');
              reset_form.reset();
              $(response.modal).modal('hide');
            }
          });
        }
      },
      error: (xhr, status, error) => {
        const {
          responseJSON: response
        } = xhr;
        if (response.errors) {
          for (let form_data in response.errors) {
            let form_name = form_data.replace(/\.(\d+)\.(\w+)/g, "[$1][$2]");

            $(`[name^="${form_name}"]`, content).addClass('is-invalid');
            $(`[name^="${form_name}"]`, content).parents('.form-input').find(
              '.invalid-feedback').addClass('d-block');
            $(`[name^="${form_name}"]`, content).parents('.form-input').find(
              '.invalid-feedback').html(response.errors[form_data][0]);
            $(`[name^="${form_name}"]`, content).parents('.form-input').find(
              '.invalid-tooltip').html(response.errors[form_data][0]);
          }
        } else {
          Swal.fire({
            title: "Error",
            text: response.message,
            icon: "error",
            heightAuto: false
          })
        }
      }
    }).always(function () {
      button.prop('disabled', false);
      button.text('Simpan Data');
      // $('#upload').modal('hide');
    });
  }

    </script>
@endsection
