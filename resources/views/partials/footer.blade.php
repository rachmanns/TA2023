    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2022<a
                    class="ml-25" href="https://technoinfinity.co.id" target="_blank">Techno Infinity</a></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ url('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ url('app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/charts/chart.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/forms/wizard/bs-stepper.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/extensions/moment.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    {{-- <script src="{{ url('app-assets/vendors/js/calendar/fullcalendar.min.js') }}"></script> --}}
    <script src="{{ url('app-assets/js/scripts/components/components-bs-toast.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/extensions/swiper.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ url('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ url('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ url('app-assets/js/scripts/charts/chart-chartjs.js') }}"></script>
    <script src="{{ url('app-assets/js/scripts/cards/card-statistics.js') }}"></script>
    <script src="{{ url('app-assets/js/scripts/tables/table-datatables-basic.js') }}"></script>
    <script src="{{ url('app-assets/js/scripts/forms/pickers/form-pickers.js') }}"></script>
    <script src="{{ url('app-assets/js/scripts/components/components-modals.js') }}"></script>
    <script src="{{ url('app-assets/js/scripts/pages/app-ecommerce-wishlist.js') }}"></script>
    <script src="{{ url('app-assets/js/scripts/charts/chart-apex.js') }}"></script>
    <script src="{{ url('app-assets/js/scripts/components/components-dropdowns.js') }}"></script>
    <script src="{{ url('app-assets/js/scripts/forms/form-select2.js') }}"></script>
    <script src="{{ url('app-assets/js/scripts/forms/form-wizard.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script src="{{ url('js/content.js') }}"></script>
    <script src="{{ url('app-assets/js/scripts/forms/form-repeater.js') }}"></script>
    <script src="{{ url('app-assets/js/scripts/pages/page-knowledge-base.js') }}"></script>
    <!-- <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script> -->
    <script src="{{ url('assets/js/npmcdn-flatpickr.js') }}"></script>
    <script src="{{ url('app-assets/js/scripts/extensions/ext-component-blockui.js') }}"></script>
    <script src="{{ url('app-assets/js/scripts/pages/app-user-edit.js') }}"></script>    
    <script src="{{ url('app-assets/js/scripts/pages/page-account-settings.js') }}"></script>
    <script src="{{ url('app-assets/js/scripts/extensions/ext-component-swiper.js') }}"></script>
    <!-- END: Page JS-->

    {{-- Year Picker --}}
    <link rel="stylesheet" href="{{ url('assets/css/yearpicker.css') }}" />
    <script src="{{ url('assets/js/yearpicker.js') }}"></script>
    @yield('page_js')

    <script>
        flatpickr.localize(flatpickr.l10ns.id);
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

    <script>
        $(document).ready(function() {
            $(".yearpicker").yearpicker({
                startYear: new Date().getFullYear() - 10,
                endYear: new Date().getFullYear() + 10,
            });
            $(".yearpicker-full").yearpicker({
            });

            $("#example2").yearpicker({
                startYear: new Date().getFullYear() - 10,
                endYear: new Date().getFullYear() + 10,
                onChange: function(value) {
                    $('#OutputContainer').html(value);
                }
            });
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp' + rupiah : '');
        }
    </script>
    @yield('page_script')
    </body>
    <!-- END: Body-->

    </html>
