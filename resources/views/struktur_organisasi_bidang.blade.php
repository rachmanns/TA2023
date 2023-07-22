@extends('partials.template')

@section('page_style')
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/jquery.orgchart.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/plugins/extensions/ext-component-toastr.min.css') }}">
    <script src="{{ url('assets/js/highcharts.js') }}"></script>
    <script src="{{ url('assets/js/sankey.js') }}"></script>
    <script src="{{ url('assets/js/organization.js') }}"></script>
    <script src="{{ url('assets/js/exporting.js') }}"></script>
    <script src="{{ url('assets/js/accessibility.js') }}"></script>

    <style>
        div.orgChart div.node {
            min-width: 200px;
            min-height: 100px;
        }

        .highcharts-background {
            fill: transparent;
        }

        .highcharts-credits {
            display: none;
        }

        h4 {
            font-size: 1rem;
            color: white;
        }
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
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Code Changes: Add Style for horizontal scroll & class card for container -->
                <div class="card" style="overflow-x: auto;">
                    <div id="orgChart"></div>
                </div>
                <div id="consoleOutput">
                </div>
            </div>
        </div>
    </div>

    <!-- END: Content-->
@endsection
@section('page_script')
    <script src="{{ url('assets/js/jquery.orgchart.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>

    <script type="text/javascript">
        var orgData = {!! $orgdata !!};

        $(function() {

            var personil_data = [];
            $.ajax({
                type: "get",
                url: "{{ url('/org_personil/personil/') }}",
                dataType: "json",
                success: function(res) {
                    if (!res.error) {
                        personil_data = res.data;
                    }
                }
            });

            org_chart = $('#orgChart').orgChart({
                data: orgData,
                showControls: false,
                allowEdit: false,
                allowHTML: true,
                onChangeLabel: function(node) {
                    if (node.data.name != "") {
                        $.ajax({
                            type: "post",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ url('/org_personil/update/') }}/" + node.data.id,
                            dataType: "json",
                            data: node.data,
                            success: function(res) {

                                toastr['info'](res.message, 'Progress Bar', {
                                    closeButton: true,
                                    tapToDismiss: false,
                                    progressBar: true,
                                });
                            }
                        });
                    }
                }
            });
        });

        // just for example purpose
        function log(text) {
            $('#consoleOutput').append('<p>' + text + '</p>')
        }
    </script>
@endsection
