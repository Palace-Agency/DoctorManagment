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

            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card pb-2">
                  <div class="card-header card-no-border pb-0">
                    <div class="header-top daily-revenue-card">
                      <h5>Total appointments in {{$now->format('Y')}}</h5>
                    </div>
                  </div>
                  <div class="card-body pb-0 total-sells">
                    <div class="d-flex align-items-center gap-3">
                      <div class="flex-shrink-0"><i class="fa fa-calendar f-40 text-white"></i></div>
                      <div class="flex-grow-1">
                        <div class="d-flex align-items-center gap-2">
                          <h2>{{$appointmentsInYear->count()}}</h2>
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
                      <h5>Doctors</h5>
                    </div>
                  </div>
                  <div class="card-body pb-0 total-sells">
                    <div class="d-flex align-items-center gap-3">
                     <div class="flex-shrink-0"><i class="fa fa-user-md f-40 text-white"></i></div>
                      <div class="flex-grow-1">
                        <div class="d-flex align-items-center gap-2">
                          <h2>{{$doctors->count()}}</h2>
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
                      <h5>Patients</h5>
                    </div>
                  </div>
                  <div class="card-body pb-0 total-sells">
                    <div class="d-flex align-items-center gap-3">
                      <div class="flex-shrink-0"><i class="fa fa-users f-40 text-white"></i></div>
                      <div class="flex-grow-1">
                        <div class="d-flex align-items-center gap-2">
                          <h2>{{$patient->count()}}</h2>
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
                            <h5 class="main-content-label mb-2">Registred doctors and patients in {{$now->year}}</h5>
                            {{-- <span class="d-block tx-12 mb-0 text-muted">Expes</span> --}}
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

        var doctors = @json($doctorcount);
        var patients = @json($patientcount)
        // console.log(chartcompleted);
        // console.log(chartcancelled);
        const ctx = document.getElementById('myLineChart');
        // console.log(refsale);
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
                        tension: 0.4, // Add this line for rounded lines
                    },

                    {
                        label: 'Doctors',
                        data: doctors,
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
                },
            }
        });

    </script>
@endsection
