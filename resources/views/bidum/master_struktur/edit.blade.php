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
    <input type="hidden" id="id_" value="{{ $id_ }}" />
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-md-12">
                            <h2 class="content-header-title float-left">Edit Struktur Organisasi {{$data->nama_struktur}}</h2>
                        </div>
                        {{-- <div class="col-md-6 text-right">
                            <button class="btn btn-outline-primary mr-75" onclick="openModal()">Preview</button>

                            <!-- Modal -->
                            <div class="modal fade" id="preview" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Preview</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <figure class="highcharts-figure">
                                                <div id="container"></div>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div id="orgChart"></div>
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

        function  openModal() {
                
                $.ajax({
                    type: "get",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('/org_personil/preview/') }}/" + $("#id_").val(),
                    dataType: "json",
                    success: function(res) {
                        $("#preview").modal("show");
                        if (!res.error) org_highchart(res.data.datas, res.data.nodes);
                    }
                });

            }
        $(function() {

            var jabatan_data = [];
            $.ajax({
                type: "get",
                url: "{{ url('/org_personil/jabatan/') }}",
                dataType: "json",
                success: function(res) {
                    if (!res.error) {
                        jabatan_data = res.data;
                    }
                }
            });

            org_chart = $('#orgChart').orgChart({
                data: orgData,
                showControls: true,
                allowEdit: true,
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
                },
                onAddNode: function(node) {
                    $.ajax({
                        type: "post",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('/org_personil/store/') }}",
                        dataType: "json",
                        data: node.data,
                        success: function(res) {
                            org_chart.newNode(node.data.id,res.data.bidang_id,res.data.id, res.html);
                            toastr['info'](res.message, 'Progress Bar', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                            });
                        }
                    });


                },
                onDeleteNode: function(node) {
                    Swal.fire({
                        title: 'Apakah Anda Yakin?',
                        text: "Anda tidak akan bisa mengembalikan data yang sudah dihapus",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Tidak'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                type: "DELETE",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                url: "{{ url('/org_personil/delete/') }}" +
                                    `/${node.data.id}`,
                                success: function(response) {
                                    if (response.error) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: response.message
                                        })
                                    } else {
                                        org_chart.deleteNode(node.data.id);
                                        Swal.fire({
                                            icon: 'success',
                                            title: response.message,
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    }
                                }
                            });


                        }
                    })
                },
                onClickNode: async function(node) {
                    const {
                        value: person
                    } = await Swal.fire({
                        title: 'Pilih Jabatan',
                        input: 'select',
                        inputOptions: jabatan_data,
                        inputPlaceholder: 'List Jabatan',
                        showCancelButton: true,
                        didOpen: () => {
                            $(".swal2-select").select2({
                                dropdownParent: $(".swal2-container"),
                            });
                        },
                        inputValidator: (value) => {
                            return new Promise((resolve) => {
                                resolve();
                            })
                        }
                    })

                    if (person) {
                        $.ajax({
                            type: "post",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ url('/org_personil/update/') }}/" + node.data.id,
                            dataType: "json",
                            data: {
                                "personil": person
                            },
                            success: function(res) {
                                if (!res.error) org_chart.updateNode(node.data.id, res.html,res.jabatan)
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

    <script>
        function org_highchart(datas = [], nodes = []) {

            Highcharts.chart('container', {
                chart: {
                    height: 800,
                    inverted: true
                },

                title: {
                    text: 'STRUKTUR ORGANISASI'
                },

                accessibility: {
                    point: {
                        descriptionFormatter: function (point) {
                            console.log(point);
                            var nodeName = point.toNode.name,
                                nodeId = point.toNode.id,
                                nodeDesc = nodeName === nodeId ? nodeName : nodeName + ', ' + nodeId,
                                parentDesc = point.fromNode.id;
                            return point.index + '. ' + nodeDesc + ', reports to ' + parentDesc + '.';
                        }
                    }
                },

                series: [{
                    type: 'organization',
                    name: 'Highsoft',
                    keys: ['from', 'to'],
                    data: datas,

                    nodes: nodes,
                    colorByPoint: false,
                    color: '#007ad0',
                    dataLabels: {
                        color: 'white'
                    },
                    borderColor: 'white',
                    nodeWidth: 65
                }],
                // series: [{
                //     type: 'organization',
                //     name: 'Puskes TNI',
                //     keys: ['from', 'to'],
                //     data: [
                //         ['Kapuskes', 'Wakapuskes'],
                //         ['Wakapuskes', 'BIDUM'],
                //         ['Wakapuskes', 'DUKKESOPS'],
                //         ['Wakapuskes', 'YANKESIN'],
                //         ['Wakapuskes', 'BANGKES'],
                //         ['Wakapuskes', 'MATFASKES'],
                //         ['Wakapuskes', 'LAVIBIOVAK'],
                //         ['Wakapuskes', 'KERMABAKTIKES'],
                //         ['Wakapuskes', 'DOBEKKES'],
                //         ['Wakapuskes', 'TAUD'],
                //         ['Wakapuskes', 'PAKU'],
                //         ['Wakapuskes', 'SATLAKKES'],
                //     ],

                //     nodes: [{
                //         id: 'Kapuskes',
                //         title: 'KAPUSKES',
                //         name: 'dr. Budiman, Sp.BE, RE(K).,MARS',
                //         image: ``,
                //         column: 0,

                //     }, {
                //         id: 'Wakapuskes',
                //         title: 'WAKAPUSKES',
                //         name: 'dr. Guntoro, Sp.BP-RE(K)',
                //         image: ``,
                //         column: 1,

                //     }, {
                //         id: 'BIDUM',
                //         title: 'KABID UM',
                //         name: 'dr. Asnominanda, Sp.THT.KL',
                //         column: 2,
                //         image: ``
                //     }, {
                //         id: 'DUKKESOPS',
                //         title: 'KABID DUKKESOPS',
                //         name: 'dr. Moh. Birza Rizaldi, Sp.OG., M.A.R.S.',
                //         column: 2,
                //         image: ``
                //     }, {
                //         id: 'YANKESIN',
                //         title: 'KABID YANKESIN',
                //         name: 'dr. R.M Tjahja Nurrobi, M.Kes.,Sp.OT (K) Hand',
                //         column: 2,
                //         image: ``
                //     }, {
                //         id: 'BANGKES',
                //         title: 'KABID BANGKES',
                //         name: 'dr. Nunung Joko Nugroho',
                //         column: 3,
                //         image: ``
                //     }, {
                //         id: 'MATFASKES',
                //         title: 'KABID MATFASKES',
                //         name: 'Asngari, S.Si.,Apti',
                //         column: 3,
                //         image: ``
                //     }, {
                //         id: 'LAVIBIOVAK',
                //         title: 'KA LAVIBIOVAK',
                //         name: 'Drs. Nur Abdul Goni, M.Si',
                //         column: 3,
                //         image: ``
                //     }, {
                //         id: 'KERMABAKTIKES',
                //         title: 'KA UNIT KERMABAKTIKES',
                //         name: 'drg. Zelvya Purnama Rika, Sp.Kga., F.I.C.D., CIQnR',
                //         column: 4,
                //         image: ``
                //     }, {
                //         id: 'DOBEKKES',
                //         title: 'KA DOBEKKES',
                //         name: 'M.Washiluddin AR, SKM.,MKKK',
                //         column: 4,
                //         image: ``
                //     }, {
                //         id: 'TAUD',
                //         title: 'KA TAUD',
                //         name: '-',
                //         column: 4
                //     }, {
                //         id: 'PAKU',
                //         title: 'PAKU',
                //         name: '-',
                //         column: 5
                //     }, {
                //         id: 'SATLAKKES',
                //         title: 'KA SATLAKKES',
                //         name: '-',
                //         column: 5
                //     }],
                //     colorByPoint: false,
                //     color: '#007ad0',
                //     dataLabels: {
                //         color: 'white'
                //     },
                //     borderColor: 'white',
                //     nodeWidth: 80
                // }],
                tooltip: {
                    outside: false
                },
                exporting: {
                    allowHTML: true,
                    sourceWidth: 800,
                    sourceHeight: 600
                }

            });
        }
    </script>
@endsection
