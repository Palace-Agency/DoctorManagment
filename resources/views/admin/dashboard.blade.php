@section('title', 'Details')
@extends('layouts.master')
@section('road')
    <div class="col-4 col-xl-4 page-title">
        <h4 class="f-w-700">Dashboard</h4>
        <nav>
            <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dash') }}"> <i data-feather="home"> </i></a></li>
                <li class="breadcrumb-item f-w-400">Dashboard</li>
            </ol>
        </nav>
    </div>
@endsection
@section('links')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/css/multi-select-tag.css">
    <style>
        .mult-select-tag {
            width: 40% !important;
        }
    </style>
@endsection
@section('content')
    @if(Session::has('success'))
        @include('alert.success')
    @elseif(Session::has('danger'))
        @include('alert.danger')
    @endif
    <div class="container-fluid">
        <!-- Card stats -->
        <div class="row g-6 mb-6">
            <div class="col-xl-12 mb-2">
                <div class="input-group w-25 flatpicker-calender">
                    <input class="form-control" placeholder="chose date" name="date" id="range-date" type="date">
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card pb-2">
                    <div class="card-header card-no-border pb-0">
                        <div class="header-top daily-revenue-card">
                            <h5>Total Appointments </h5>
                        </div>
                    </div>
                    <div class="card-body pb-0 total-sells">
                        <div class="d-flex align-items-center gap-3">
                            <div class="flex-shrink-0"><i class="fa fa-calendar f-40 text-white"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2">
                                    <h2 class="totalapp"></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card pb-2">
                    <div class="card-header card-no-border pb-0">
                        <div class="header-top daily-revenue-card">
                            <h5>Total Doctors</h5>
                        </div>
                    </div>
                    <div class="card-body pb-0 total-sells">
                        <div class="d-flex align-items-center gap-3">
                            <div class="flex-shrink-0"><i class="fa fa-user-md f-40 text-white"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2">
                                    <h2 class="countdoc"></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card pb-2">
                    <div class="card-header card-no-border pb-0">
                        <div class="header-top daily-revenue-card">
                            <h5>Total Patients</h5>
                        </div>
                    </div>
                    <div class="card-body pb-0 total-sells">
                        <div class="d-flex align-items-center gap-3">
                            <div class="flex-shrink-0"><i class="fa fa-users f-40 text-white"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2">
                                    <h2 class="countpat"></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-sm mt-4">
            <div class="col-sm-12 col-lg-12 col-xl-12">
                <div class="card custom-card overflow-hidden">
                    <div class="card-header border-bottom-0">
                        <div>
                            <h5 class="main-content-label mb-2">Registered doctors and patients in {{ $now->year }}</h5>
                        </div>
                    </div>
                    <div class="card-body ps-0">
                        <div class>
                            <div class="container">
                                <canvas id="myLineChart" class="chart-dropshadow2 ht-250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            // Set the current date to the input field
            var today = new Date().toISOString().split('T')[0];
            $('#range-date').val(today);
            $('.dateselected').text(today)
            // Trigger the AJAX request
            fetchAppointmentsData();

            // Fetch appointments data when the date value changes
            $('#range-date').on('change', function() {
                fetchAppointmentsData();
            });

            // Function to fetch appointments data
            function fetchAppointmentsData() {
                var selectedDate = $('#range-date').val();
                $('.dateselected').text(selectedDate);
                $.ajax({
                    type: 'GET',
                    url: '{{ route('fetchTotalAppointmentByRangeDate') }}',
                    data: {
                        month: selectedDate
                    },
                    success: function(response) {
                        var selectedMonthValue = $('#range-date').val();
                        var month = new Date(selectedMonthValue).toLocaleString('default', { month: 'long' });


                        $('.totalapp').html(response[0]);
                        $('.countpat').html(response[1]);
                        $('.countdoc').html(response[2]);
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error('Error fetching appointments:', error);
                    }
                });
            }
        });

        var doctors = @json($doctorcount);
        var patients = @json($patientcount);

        const ctx = document.getElementById('myLineChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        label: 'Patients',
                        data: patients,
                        backgroundColor: "transparent",
                        borderColor: 'green',
                        pointBackgroundColor: "#ffffff",
                        pointRadius: 0,
                        borderWidth: 1,
                        tension: 0.4, // Rounded lines
                    },
                    {
                        label: 'Doctors',
                        data: doctors,
                        backgroundColor: "transparent",
                        borderColor: 'blue',
                        pointBackgroundColor: "#ffffff",
                        pointRadius: 0,
                        borderWidth: 1,
                        tension: 0.4, // Rounded lines
                    }
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                tooltips: {
                    mode: "nearest",
                    intersect: false,
                },
            }
        });


    </script>
@endsection
