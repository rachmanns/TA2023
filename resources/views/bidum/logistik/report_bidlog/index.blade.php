@extends('partials.template')
@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top mb-1">
                        <div class="col-6">
                            <h2 class="content-header-title float-left mb-0">Report</h2>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <input type="text" id="fp-range" class="form-control bg-white" placeholder="Periode" />
                            <input type="hidden" id="from_date">
                            <input type="hidden" id="to_date">
                        </div>
                        <div class="col-9 text-right">
                            <a href="{{ route('bidum.logistik.report.create') }}"><button class="btn btn-primary">Upload
                                    Dokumen</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="accordion-with-margin">
                    <div class="row">
                        <div class="col-sm-12 collapse-icon">
                            <div class="collapse-margin" id="accordionExample">
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
        let kategori_laporan = {!! json_encode($kategori_laporan) !!}
        
        $(function(){
            const startOfMonth = moment().startOf('month').format('YYYY-MM-DD');
            const endOfMonth   = moment().endOf('month').format('YYYY-MM-DD');

            $.each(kategori_laporan, function(key, value) {
                $('#accordionExample').append(`
                    <div class="card">
                        <div class="card-header" id="headingOne" data-toggle="collapse" role="button" data-target="#collapseOne-${value.id_kat_lap}" aria-expanded="false" aria-controls="collapseOne">
                            <span class="lead collapse-title">${value.nama_kat_lap} </span>
                        </div>

                        <div id="collapseOne-${value.id_kat_lap}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <table class="table table-striped" id="${value.id_kat_lap}-table">
                                    <thead>
                                        <tr>
                                            <th>Periode Laporan</th>
                                            <th>Tanggal Upload</th>
                                            <th class="text-center">File</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                `)

                report_list(value.id_kat_lap, startOfMonth, endOfMonth)
            });
        })

        function report_list(id_kategori,from_date,to_date) {
            var table = $('#'+id_kategori+'-table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: "{{ url('bidum/logistik/report/list') }}/"+id_kategori+'/'+from_date+'/'+to_date,
                columns: [
                    {
                        data: 'periode_laporan',
                        name: 'periode_laporan'
                    },
                    {
                        data: 'tgl_upload',
                        name: 'tgl_upload'
                    },
                    {
                        data: 'file',
                        name: 'file',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });
        }

        $("#fp-range").flatpickr({
            mode: 'range',
            onChange: function(selectedDate) {
                let _this = this;
                let dateArr = selectedDate.map(function(date) {
                    return _this.formatDate(date, 'Y-m-d');
                });

                let start = dateArr[0];
                let end = dateArr[1];
                $('#from_date').val(start)
                $('#to_date').val(end)


                 $.each(kategori_laporan, function(key, value) {
                    report_list(value.id_kat_lap, start, end)
                });
            }
        })

    </script>
@endsection
