@section('title', 'Details')
@extends('layouts.master')
@section('road')
    <div class="col-4 col-xl-4 page-title">
        <h4 class="f-w-700">Dashboard</h4>
        <nav>
            <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
                <li class="breadcrumb-item"><a href="{{route('admin.dash')}}"> <i data-feather="home"> </i></a></li>
                <li class="breadcrumb-item f-w-400">Dashboard</li>
            </ol>
        </nav>
    </div>
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
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card pb-2">
                  <div class="card-header card-no-border pb-0">
                    <div class="header-top daily-revenue-card">
                      <h5>Paid expenses in </h5>
                    </div>
                  </div>
                  <div class="card-body pb-0 total-sells">
                    <div class="d-flex align-items-center gap-3">
                      <div class="flex-shrink-0"><i class="icon-money f-40 text-white"></i></div>
                      <div class="flex-grow-1">
                        <div class="d-flex align-items-center gap-2">
                          <h2 class="text-success"> MAD<h2>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card pb-2">
                  <div class="card-header card-no-border pb-0">
                    <div class="header-top daily-revenue-card">
                      <h5>Total appointment in </h5>
                    </div>
                  </div>
                  <div class="card-body pb-0 total-sells">
                    <div class="d-flex align-items-center gap-3">
                      <div class="flex-shrink-0"><i class="fa fa-calendar f-40 text-white"></i></div>
                      <div class="flex-grow-1">
                        <div class="d-flex align-items-center gap-2">
                          <h2></h2>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card pb-2">
                  <div class="card-header card-no-border pb-0">
                    <div class="header-top daily-revenue-card">
                      <h5>Employees</h5>
                    </div>
                  </div>
                  <div class="card-body pb-0 total-sells">
                    <div class="d-flex align-items-center gap-3">
                     <div class="flex-shrink-0"><i class="fa fa-user-md f-40 text-white"></i></div>
                      <div class="flex-grow-1">
                        <div class="d-flex align-items-center gap-2">
                          <h2></h2>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card pb-2">
                  <div class="card-header card-no-border pb-0">
                    <div class="header-top daily-revenue-card">
                      <h5>Patients</h5>
                    </div>
                  </div>
                  <div class="card-body pb-0 total-sells">
                    <div class="d-flex align-items-center gap-3">
                      <div class="flex-shrink-0"><i class="fa fa-users f-40 text-white"></i></div>
                      <div class="flex-grow-1">
                        <div class="d-flex align-items-center gap-2">
                          <h2></h2>
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
                            <h2 class="main-content-label mb-2">Expenses for </h2>
                            {{-- <span class="d-block tx-12 mb-0 text-muted">Expes</span> --}}
                        </div>
                    </div>
                    <div class="card-body ps-0">
                        <div class>
                            <div class="container">
                                <canvas id="myChart" class="chart-dropshadow2 ht-250"></canvas>
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

                                    <label class="main-content-label mb-2 fw-bold ">List of Patients who have the appointment Today
                                    </label>
                                </div>
                            </div>
                            <div class="table-responsive tasks">
                                <div style="max-height: 300px; overflow-y: auto;">
                                    <table class="table card-table table-vcenter  text-nowrap mb-0 ">
                                        <thead class="sticky-top bg-white">
                                            <th>Order by </th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>time start</th>
                                            <th>Status</th>
                                        </thead>
                                        @php $i = 1; @endphp
                                        {{-- <tbody>
                                            @foreach ($appointments as $appointment)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$appointment->patient->fname}}</td>
                                                    <td>{{$appointment->patient->lname}}</td>
                                                    <td>{{ \Carbon\Carbon::parse($appointment->start_at)->format('H:i') }}</td>

                                                    <td><span class="@if($appointment->status == 'pending')
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
                                                            <strong class="text-light text-capitalize">{{$appointment->status}}</strong></span></td>
                                                    <td>
                                                </tr>
                                            @endforeach
                                        </tbody> --}}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('myChart').getContext('2d');
            var expensesChart = new Chart(ctx, {
                type: 'doughnut', // Doughnut chart
                data: {
                    labels: ['Paid Expenses', 'Unpaid Expenses'],
                    datasets: [{
                        label: 'Expenses',
                        data: [{{ $expensespaid }}, {{ $expensesunpaid }}],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',  // Color for paid expenses
                            'rgba(239, 9, 9, 0.2)'   // Color for unpaid expenses
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(239, 9, 9, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Allows resizing of the chart
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += new Intl.NumberFormat('en-US', {
                                            style: 'currency',
                                            currency: 'MAD' // Using Moroccan Dirham
                                        }).format(context.parsed);
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection --}}
