<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To Do App</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{URL::asset('panel/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('panel/css/c3.css')}}">
    <link rel="stylesheet" href="{{URL::asset('panel/css/chartist.css')}}">
    <link rel="stylesheet" href="{{URL::asset('panel/css/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{URL::asset('panel/css/jquery-jvectormap-2.0.2.css')}}">
    <link rel="stylesheet" href="{{URL::asset('panel/css/jqvmap.css')}}">
    <link rel="stylesheet" href="{{URL::asset('panel/css/morris.css')}}">
    <link rel="stylesheet" href="{{URL::asset('panel/css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('panel/assets/fonts/circular-std/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    {{--    datatable--}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Sweet Alert Css -->
    <link href="{{ asset('front/css/sweetalert.css') }}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


</head>
<body>

<div style="display: flex;justify-content: center;align-items: center;margin-left: -250px">
    <!-- wrapper  -->
@yield('content')
    <!-- end wrapper  -->
</div>

<!-- jquery 3.3.1  -->
<script src="{{URL::asset('panel/js/jquery-3.3.1.min.js')}}"></script>
<!-- bootstap bundle js -->
<script src="{{URL::asset('panel/js/bootstrap.bundle.js')}}"></script>
<!-- slimscroll js -->
<script src="{{URL::asset('panel/js/jquery.slimscroll.js')}}"></script>
<!-- chart chartist js -->
<script src="{{URL::asset('panel/js/chartist.min.js')}}"></script>
<script src="{{URL::asset('panel/js/Chartistjs.js')}}"></script>
<script src="{{URL::asset('panel/js/chartist-plugin-threshold.js')}}"></script>
<!-- chart C3 js -->
<script src="{{URL::asset('panel/js/c3.min.js')}}"></script>
<script src="{{URL::asset('panel/js/d3-5.4.0.min.js')}}"></script>
<!-- chartjs js -->
<script src="{{URL::asset('panel/js/Chart.bundle.js')}}"></script>
<script src="{{URL::asset('panel/js/chartjs.js')}}"></script>
<!-- sparkline js -->
<script src="{{URL::asset('panel/js/jquery.sparkline.js')}}"></script>
<!-- dashboard finance and sales js -->
<script src="{{URL::asset('panel/js/dashboard-finance.js')}}"></script>
<script src="{{URL::asset('panel/js/dashboard-sales.js')}}"></script>
<!-- main js -->
<script src="{{URL::asset('panel/js/main-js.js')}}"></script>
<!-- gauge js -->
<script src="{{URL::asset('panel/js/gauge.min.js')}}"></script>
<!-- morris js -->
<script src="{{URL::asset('panel/js/raphael.min.js')}}"></script>
<script src="{{URL::asset('panel/js/morris.js')}}"></script>
<script src="{{URL::asset('panel/js/morrisjs.html')}}"></script>
<!-- daterangepicker js -->
<script src="{{URL::asset('panel/js/moment.min.js')}}"></script>
</body>
</html>
