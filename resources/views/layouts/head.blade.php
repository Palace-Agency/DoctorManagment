<link rel="icon" href="{{asset("assets/images/favicon.png")}}" type="image/x-icon">
<link rel="shortcut icon" href="{{asset("assets/images/favicon.png")}}" type="image/x-icon">
<!-- Google font-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset("assets/css/font-awesome.css")}}">
<!-- ico-font-->
<link rel="stylesheet" type="text/css" href="{{asset("assets/css/vendors/icofont.css")}}">
<!-- Themify icon-->
<link rel="stylesheet" type="text/css" href="{{asset("assets/css/vendors/themify.css")}}">
<!-- Flag icon-->
<link rel="stylesheet" type="text/css" href="{{asset("assets/css/vendors/flag-icon.css")}}">
<!-- Feather icon-->
<link rel="stylesheet" type="text/css" href="{{asset("assets/css/vendors/feather-icon.css")}}">
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{asset("assets/css/vendors/slick.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("assets/css/vendors/slick-theme.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("assets/css/vendors/scrollbar.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("assets/css/vendors/animate.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("assets/css/vendors/datatables.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("assets/css/vendors/date-range-picker/flatpickr.min.css")}}">
<!-- Plugins css Ends-->
<!-- Bootstrap css-->
<link rel="stylesheet" type="text/css" href="{{asset("assets/css/vendors/bootstrap.css")}}">
<!-- App css-->
<link rel="stylesheet" type="text/css" href="{{asset("assets/css/style.css")}}">
<link id="color" rel="stylesheet" href="{{asset("assets/css/color-1.css")}}" media="screen">
<!-- Responsive css-->
<link rel="stylesheet" type="text/css" href="{{asset("assets/css/responsive.css")}}">

{{-- search box for select --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/scrollable.css')}}" />

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/owlcarousel.css') }}"/>
<style>
    .owl-next>span {
        position: absolute;
        top: 55px;
        right: -13px;
        background-color: black;
        color: white;
        border-radius: 50%;
        width: 20px;
    }

    .owl-prev>span {
        position: absolute;
        /* right: 0px; */
        top: 55px;
        left: -13px;
        background-color: black;
        color: white;
        border-radius: 50%;
        width: 20px;
    }
</style>
@yield('links')
