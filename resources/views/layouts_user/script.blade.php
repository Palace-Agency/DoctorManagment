<!-- latest jquery-->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>

<!-- Bootstrap js-->
<script src="{{asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
<!-- feather icon js-->
<script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
<!-- scrollbar js-->
<script src="{{asset('assets/js/scrollbar/simplebar.js')}}"></script>
<script src="{{asset('assets/js/scrollbar/custom.js')}}"></script>
<!-- Sidebar jquery-->
<script src="{{asset('assets/js/config.js')}}"></script>
<!-- Plugins JS start-->
<script src="{{asset('assets/js/sidebar-menu.js')}}"></script>
<script src="{{asset('assets/js/sidebar-pin.js')}}"></script>


<script src="{{asset('assets/js/slick/slick.min.js')}}"></script>
<script src="{{asset('assets/js/slick/slick.js')}}"></script>
<script src="{{asset('assets/js/header-slick.js')}}"></script>

{{-- <script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script> --}}
<!-- calendar js-->
<script src="{{asset('assets/js/dashboard/default.js')}}"></script>
<script src="{{asset('assets/js/notify/index.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom1.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-range-picker/moment.min.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-range-picker/datepicker-range-custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.bundle.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/typeahead-custom.js')}}"></script>
<script src="{{asset('assets/js/height-equal.js')}}"></script>
<script src="{{asset('assets/js/animation/wow/wow.min.js')}}"></script>
<!-- Plugins JS Ends-->

<!-- Theme js-->
<script src="{{asset('assets/js/script.js')}}"></script>
{{-- <script src="{{asset('assets/js/theme-customizer/customizer.js')}}"></script> --}}
<!-- Plugin used-->
{{-- <script>new WOW().init();</script> --}}
<script src="{{asset('assets/js/flat-pickr/flatpickr.js')}}"></script>
    <script src="{{asset('assets/js/flat-pickr/custom-flatpickr.js')}}"></script>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"  crossorigin="anonymous"></script>
{{-- search box for select --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

{{-- alert --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    function confirmation(ev) {
        ev.preventDefault();
        var utlToRedirect = ev.currentTarget.getAttribute('href');
        // console.log(utlToRedirect);
        swal({
                title: "Are you sure you want to delete this Item ?",
                text: "You  won't be able to revert this delete ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    // Submit the form if the user confirms deletion
                    document.getElementById('deleteForm').submit();
                    // window.location.href = utlToRedirect;

                }else{
                    window.location.href = utlToRedirect;

                }
            });


    }
    function confirm(ev) {
        ev.preventDefault();
        var utlToRedirect = ev.currentTarget.getAttribute('href');
        // console.log(utlToRedirect);
        swal({
                title: "Are you sure you want to delete this Item ?",
                text: "You  won't be able to revert this delete ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willCancel) => {
                if (willCancel) {
                    window.location.href = utlToRedirect;
                }
            });


    }
</script>

<script src="{{ asset('assets/js/owlcarousel/owl.carousel.js') }}"></script>
<script src="{{ asset('assets/js/owlcarousel/owl-custom.js') }}"></script>
<script src="{{ asset('assets/js/height-equal.js') }}"></script>
<script src="{{asset('assets/js/form-wizard/form-wizard.js')}}"></script>
<script src="{{asset('assets/js/form-wizard/image-upload.js')}}"></script>

  <script src="{{asset('assets/js/chart/chartjs/chart.min.js')}}"></script>
    <script src="{{asset('assets/js/chart/chartjs/chart.custom.js')}}"></script>


@yield('script')

