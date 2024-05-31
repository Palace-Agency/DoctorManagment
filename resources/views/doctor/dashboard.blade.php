@section('title', 'Details')
@extends('layouts_user.master')
@section('links')

    <style>
        canvas{
            height: 235px !important;
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
                      <h5>Total Appointment </h5>
                    </div>
                  </div>
                  <div class="card-body pb-0 total-sells">
                    <div class="d-flex align-items-center gap-3">
                      <div class="flex-shrink-0"><i class="fa fa-calendar f-40 text-white"></i></div>
                      <div class="flex-grow-1">
                        <div class="d-flex align-items-center gap-2">
                          <h2 class="totalapp">{{$totalapp}}</h2>
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
                          <h2 class="patcount">{{$patients->count()}}</h2>
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
                      <h5>Total Paid consultations</h5>
                    </div>
                  </div>
                  <div class="card-body pb-0 total-sells">
                    <div class="d-flex align-items-center gap-3">
                      <div class="flex-shrink-0"><i class="icon-money f-40 text-white"></i></div>
                      <div class="flex-grow-1">
                        <div class="d-flex align-items-center gap-2">
                          <h2 class="text-success"><span class="paidtotal">{{Auth::user()->parametre->tarif_consult * $appointmentcount}}</span> MAD<h2>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="row row-sm mt-4">
            <div class="col-sm-5 col-lg-6 col-xl-6">
                <div class="card custom-card overflow-hidden">
                    <div class="card-header border-bottom-0">
                        <div>
                            <h3 class="main-content-label mb-2">Patients and appointments informations in {{ $now->year }} </h3>
                        </div>
                    </div>
                    <div class="card-body ps-0">
                        <div class>
                            <div class="container">
                                <canvas id="myChart"   class="chart-dropshadow2 ht-250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card custom-card overflow-hidden">
                    <div class="card-header border-bottom-0">
                        <div>
                            <h3 class="main-content-label mb-2">Expenses in {{ $now->year }} </h3>
                        </div>
                    </div>
                    <div class="card-body ps-0">
                        <div class>
                            <div class="container d-flex justify-content-center">
                                <canvas id="mySecondeChart" style="height: 235px" class="chart-dropshadow2 ht-250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-sm mt-4">
            <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="card custom-card mg-b-20">
                        <div class="card-body">
                            <div class="card-header border-bottom-0 pt-0 ps-0 pe-0 d-flex bg-white">
                                <div class="">

                                    <label class="main-content-label mb-2 fw-bold ">List of Patients who have the appointment Today "@php echo  $now->format('l j M') @endphp"
                                    </label>
                                </div>
                            </div>
                            <div class="table-responsive tasks">
                                <div style="max-height: 300px; overflow-y: auto;">
                                    <table class="table card-table table-vcenter  text-nowrap mb-0 ">
                                        <thead class="sticky-top bg-white">
                                            <th>Order by </th>
                                            <th>Type of appointment</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>time start</th>
                                            <th>Status</th>
                                        </thead>
                                        @php $i = 1; @endphp
                                        <tbody>
                                            @foreach ($appointments as $appointment)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td class="text-capitalize fw-bold">
                                                        {{$appointment->type_appointment}}
                                                    </td>
                                                    <td>{{$appointment->patient->fname}}</td>
                                                    <td>{{$appointment->patient->lname}}</td>
                                                    <td>{{ \Carbon\Carbon::parse($appointment->start_at)->format('H:i') }}</td>
                                                    <td>
                                                        <span class="@if($appointment->status == 'pending')
                                                                        badge text-bg-warning
                                                                    @elseif($appointment->status == 'inprogress')
                                                                        badge text-bg-primary badge-small
                                                                    @elseif($appointment->status == 'waiting')
                                                                        badge bg-warning
                                                                    @elseif($appointment->status == 'completed')
                                                                        badge text-bg-success
                                                                    @else
                                                                        badge text-bg-danger
                                                                    @endif
                                                                    ">
                                                            <strong class="text-light text-capitalize">{{$appointment->status}}</strong>
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
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
            // Trigger the AJAX request
            fetchAppointmentsData();

            // Fetch appointments data when the date value changes
            $('#range-date').on('change', function() {
                fetchAppointmentsData();
            });

            // Function to fetch appointments data
            function fetchAppointmentsData() {
                var total = {{ Auth::user()->parametre->tarif_consult }};
                var selectedDate = $('#range-date').val();
                $.ajax({
                    type: 'GET',
                    url: '{{ route('fetchTotalAppointmentsandpaid') }}',
                    data: {
                        month: selectedDate
                    },
                    success: function(response) {
                        var selectedMonthValue = $('#range-date').val();
                        var month = new Date(selectedMonthValue).toLocaleString('default', { month: 'long' });


                        $('.totalapp').html(response[0]);
                        $('.paidtotal').html(total * response[1]);
                        $('.patcount').html(response[2]);
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error('Error fetching appointments:', error);
                    }
                });
            }
        });

        var chartcancelled = @json($appointmentcancelled);
        var chartcompleted = @json($appointmentcompleted);

        var patient = @json($patientcount);
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        label: 'Appointments Completed',
                        data: chartcompleted,
                        backgroundColor: "transparent",
                        borderColor: 'green',
                        pointBackgroundColor: "#ffffff",
                        pointRadius: 0,
                        borderWidth: 1,
                        tension: 0.4, // Add this line for rounded lines
                    },
                    {
                        label: 'Appointments Cancelled',
                        data: chartcancelled,
                        backgroundColor: "transparent",
                        borderColor: 'red',
                        pointBackgroundColor: "#ffffff",
                        pointRadius: 0,
                        borderWidth: 1,
                        tension: 0.4, // Add this line for rounded lines
                    },
                    {
                        label: 'Patients',
                        data: patient,
                        backgroundColor: "transparent",
                        borderColor: 'blue',
                        pointBackgroundColor: "#ffffff",
                        pointRadius: 0,
                        borderWidth: 1,
                        tension: 0.4, // Add this line for rounded lines
                    }
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                tooltips: {
                    mode: "nearest",
                    intersect: false,
                }

            }
        });
         var chartpaid = @json($expensespaid);
        var chartunpaid = @json($expensesunpaid);

        // Calcul du total des dépenses payées et impayées
        var totalPaid = chartpaid.reduce((acc, val) => acc + val, 0);
        var totalUnpaid = chartunpaid.reduce((acc, val) => acc + val, 0);
        var totalExpenses = totalPaid + totalUnpaid;

        // Calcul des pourcentages
        var paidPercentage = (totalPaid / totalExpenses * 100).toFixed(2);
        var unpaidPercentage = (totalUnpaid / totalExpenses * 100).toFixed(2);

        // Données pour le graphique
        var data = [paidPercentage, unpaidPercentage];
        var labels = ['Paid Expenses', 'Unpaid Expenses'];

        // Couleurs pour le graphique
        var backgroundColors = ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'];
        var borderColors = ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'];

        // Création du graphique en anneau
        const ctx2 = document.getElementById('mySecondeChart').getContext('2d');
        const expensesDoughnutChart = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                                }
                            }
                        }
                    }
                }
            }
        );







    </script>
@endsection
