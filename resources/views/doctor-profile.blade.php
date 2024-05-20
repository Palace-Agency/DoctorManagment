@extends('layouts.bodyVisiteur')
@section('content')

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                                        <img src="{{ asset('images/doctor/' . $doctor->image) }}" style="width: 104px" alt="user image"
                                            class="d-block h-auto ms-0 ms-sm-4 mt-2  rounded  user-profile-img">
                                    </div>
                                    <div class="flex-grow-1 mt-3 mt-sm-5">
                                        <div
                                            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                            <div class="user-profile-info">
                                                <h4>{{ $doctor->fname . ' ' . $doctor->lname }}</h4>
                                                <ul
                                                    class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                                    <li class="list-inline-item"><i class="ti ti-map-pin"></i> {{ $doctor->city->nom_city }}
                                                        City</li>
                                                    <li class="list-inline-item"><i class="ti ti-calendar"></i> Joined
                                                        {{ $doctor->created_at->format('D M Y') }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <button class="btn btn-success float-end" id="test" type="button" data-bs-toggle="modal" @if(Auth::check())  data-bs-target=".makeAppontment" @endif>Make appointments</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-3">
                                <h3 class="m-3">About</h3>
                                <div><i class="fa fa-user"></i> <span class="fw-bold">Full Name :
                                    </span>{{ $doctor->fname . ' ' . $doctor->lname }}</div>
                                <div><i class="fa fa-flag"></i><span class="fw-bold"> City : </span>{{ $doctor->city->nom_city }}</div>
                                <div><i class="fa fa-check"></i><span class="fw-bold"> Code Postal : </span>{{ $doctor->zip_code }}</div>
                                <div><i class="fa fa-map-marker"></i><span class="fw-bold"> Adresse : </span>{{ $doctor->address }}</div>

                                <h3 class="m-3">Contact</h3>
                                <div><i class="fa fa-phone"></i><span class="fw-bold"> Phone : </span>{{ $doctor->phone_number }}</div>
                                <div><i class="fa fa-envelope"></i><span class="fw-bold"> Email : </span>{{ $doctor->email }}</div>
                            </div>
                            <div class="col-md-7 m-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="m-3">Specialities</h3>
                                        @foreach ($specialities as $speciality)
                                            <div class="badge text-bg-primary">{{$speciality->name_sp}}</div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="m-3">Language spoken</h3>
                                        @foreach ($selectedlanguages as $lang)
                                            <div class="badge text-bg-success">{{$lang}}</div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        @if($parametre->bio)
                                            <h3 class="m-3">Bio</h3>
                                            <div>{{$parametre->bio}}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if($parametre->experience)
                                            <h3 class="m-3">Experience</h3>
                                            <div>{{$parametre->experience}}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="modal fade makeAppontment" id="event_entry_modal" tabindex="-1" role="dialog"
                                    aria-labelledby="myExtraLargeModal" aria-hidden="true" id="myModal">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myExtraLargeModal">Make an appointment online</h4>
                                                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form  class="formappointmentpatient">
                                                @csrf
                                                <div class="modal-body dark-modal">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    Type of consultation
                                                                </div>
                                                                <div class="col-md-6 mt-2">
                                                                    <input type="radio" checked name="type_consult" value="personnel"
                                                                        id="personnel">
                                                                    <label for="personnel">face-to-face</label>
                                                                </div>
                                                                <div class="col-md-6 mt-2">
                                                                    <input type="radio" name="type_consult" value="remote" id="remote">
                                                                    <label for="remote">teleconsultation</label>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-6">
                                                                <div class="col-md-12">
                                                                    Controle
                                                                </div>
                                                                <div class="col-md-6 mt-2">
                                                                    <input type="radio" checked name="controle" value="1"
                                                                        id="y">
                                                                    <label for="y">Yes</label>
                                                                </div>
                                                                <div class="col-md-6 mt-2">
                                                                    <input type="radio" name="controle" value="0" id="n">
                                                                    <label for="n">NO</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="mb-3 mb-0  w-100">
                                                                        <div class="mb-3 mb-0 animated-modal-md-mb w-100">
                                                                            <label class="me-3">Reason for the consultation</label>
                                                                            <select class="form-select w-75" id="exit"
                                                                                name="reason_consult">
                                                                                @foreach ($specialities as $item)
                                                                                    <optgroup label="{{ $item->name_sp }}"></optgroup>

                                                                                    @foreach ($motifs as $motif)
                                                                                        @if ($motif->speciality_id == $item->id)
                                                                                            <option value="{{ $motif->id }}">
                                                                                                {{ $motif->nom_motif }}</option>
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            @php
                                                                $now = Carbon\Carbon::now();

                                                                $currentMonth = $now->month;
                                                                $currentYear = $now->year;
                                                                $daysInMonth = Carbon\Carbon::createFromDate(
                                                                    $currentYear,
                                                                    $currentMonth,
                                                                )->daysInMonth;
                                                            @endphp
                                                            <div class="owl-carousel owl-theme" id="owl-carousel-13">
                                                                @for($month = $currentMonth ; $month <= $currentMonth +1;$month ++)
                                                                    @for($day = $currentMonth == $month ? $now->day : 1 ; $day < $daysInMonth ; $day++)
                                                                        @php
                                                                            $currentDate = Carbon\Carbon::createFromDate(
                                                                                $currentYear,
                                                                                $currentMonth,
                                                                                $day,
                                                                            );
                                                                            $fullDayName = $currentDate->format('l');
                                                                        @endphp
                                                                        <div class="item">
                                                                            <div class="d-flex justify-content-center bg-primary p-3 rounded-pill">
                                                                                <input type="hidden" class="get-day" name="" value="{{ $day }}">
                                                                                <input type="hidden" class="get-month" name="" value="{{ $month }}">

                                                                                {{ Carbon\Carbon::createFromDate($currentYear, $month, $day)->format('D. d/m') }}
                                                                            </div>
                                                                            <div class="vertical-scroll scroll-demo scroll-b-none mt-5">
                                                                                <div class="list-group">
                                                                                    @php $flag = 0 ; @endphp
                                                                                    @foreach ($workhours as $work)
                                                                                        @php $flag == 1 ? '' : $period = [] @endphp
                                                                                        @if (strtolower($fullDayName) === $work->day_of_week)
                                                                                            @php
                                                                                                $startTime = Carbon\Carbon::parse( $work->start_time) ?? null;
                                                                                                $endTime = Carbon\Carbon::parse( $work->end_time) ?? null;
                                                                                                if ($startTime && $endTime) {
                                                                                                    $periodStart = $startTime->copy();
                                                                                                    while ( $periodStart->lessThanOrEqualTo($endTime)) {
                                                                                                        $period[] = $periodStart->copy();
                                                                                                        $periodStart->addMinutes(
                                                                                                            $difftime->duree_appointments
                                                                                                        );
                                                                                                    }

                                                                                                    if ($currentDate->isToday()) {
                                                                                                        // echo 'hello';
                                                                                                        $isNot = true;
                                                                                                        foreach ( $period as $key => $datetime ) {
                                                                                                            if ( $datetime->greaterThan( $now)) {
                                                                                                                $period = array_slice( $period, $key ); // Discard past time slots
                                                                                                                $isNot = false;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                        if ($isNot) { $period = []; }
                                                                                                    }
                                                                                                }
                                                                                                $flag = 1;
                                                                                                $checkday = $work->day_off === 'disable';
                                                                                            @endphp
                                                                                        @endif
                                                                                    @endforeach
                                                                                    @php
                                                                                        $date = Carbon\Carbon::createFromFormat('Y-m-d',$currentYear .'-'.$month .'-'.$day,);
                                                                                        foreach ($holidays as $holiday) {
                                                                                            $holidayStartDate = Carbon\Carbon::parse($holiday->date_start)->format('Y-m-d');
                                                                                            $holidayEndDate = Carbon\Carbon::parse($holiday->date_end)->addDays(1)->format('Y-m-d');
                                                                                            if ($holidayEndDate === $holidayStartDate && $date->format('Y-m-d') ===  $holidayStartDate ) {
                                                                                                foreach ($period as $key => $datetime) {
                                                                                                    if ($datetime->between($holiday->time_start,$holiday->time_end )
                                                                                                    ) {
                                                                                                        unset($period[$key]);
                                                                                                    }
                                                                                                }
                                                                                            } elseif ( $date->between( $holidayStartDate, $holidayEndDate )) {
                                                                                                if ($date->format('Y-m-d') ===$holidayStartDate) {
                                                                                                    $newPeriod = [];
                                                                                                    $startTime = Carbon\Carbon::parse($holiday->time_start);
                                                                                                    foreach ( $period as $datetime ) {
                                                                                                        if ( $datetime->lessThan( $startTime )) {
                                                                                                            $newPeriod[] = $datetime->copy();
                                                                                                        } else {
                                                                                                            break; // Stop adding time slots once we reach the holiday start time
                                                                                                        }
                                                                                                    }
                                                                                                    $period = $newPeriod;
                                                                                                } elseif ( $date->format('Y-m-d') ===  $holidayEndDate ) {
                                                                                                    $newPeriod = [];
                                                                                                    $endTime = end($period);
                                                                                                    $holidayEndTime = Carbon\Carbon::parse( $holiday->time_end );
                                                                                                    foreach ( $period as $datetime ) {
                                                                                                        if ( $datetime->greaterThanOrEqualTo( $holidayEndTime) ) {
                                                                                                            $newPeriod[] = $datetime->copy();
                                                                                                        }
                                                                                                    }
                                                                                                    $period = $newPeriod;
                                                                                                } else {
                                                                                                    $period = [];
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                        foreach ( $appointments as $appointment ) {
                                                                                            $date_appointment = Carbon\Carbon::parse(
                                                                                                $appointment->appontment_date
                                                                                            )->format('Y-m-d');
                                                                                            $start_at = Carbon\Carbon::parse( $appointment->start_at );
                                                                                            if ( $date->format('Y-m-d') === $date_appointment ) {
                                                                                                foreach ( $period as $key => $datetime ) {
                                                                                                    if ( $datetime->eq($start_at) ) {
                                                                                                        // Remove the time slot from $period
                                                                                                        unset($period[$key]);
                                                                                                        // Exit the loop for this appointment
                                                                                                        break;
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    @endphp


                                                                                    @if ($checkday ?? false)
                                                                                        @foreach ($period as $datetime)
                                                                                            <a class="list-group-item list-group-item-action time-link list-hover-primary"
                                                                                                href="javascript:void(0)"
                                                                                                data-time="{{ $datetime->format('G:i') }}">{{ $datetime->format('G:i') }}</a>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endfor
                                                                @endfor
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="form-label">Medical information<span
                                                                        class="txt-danger">*</span></label>
                                                                <textarea class="form-control @error('medical_information') is-invalid @enderror" value="{{ old('medical_information') }}"
                                                                    name="medical_information" id="" rows="3"></textarea>
                                                                @error('medical_information')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" id="sent" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection



@section('script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#test').on('click',function(){
            var isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
            if(!isAuthenticated){
                swal("Error!", "Client is not authenticated. Please login.", "error");
                // $("#event_entry_modal").modal("hide");
            }


        });
        $(document).on('click', '.time-link', function() {
                // Remove 'clicked' class from all time-link elements
                $('.time-link').removeClass('clicked');
                // Add 'clicked' class to the clicked element
                $(this).addClass('clicked');
            });

        $('#sent').on('click', function(e) {

            // console.log(isAuthenticated);
            var idpatient = {{ Auth::id()}} ;
            var idDoctor = {{ $doctor->id }};
            var type= $('input[name="type_consult"]:checked').val();
            var controle= $('input[name="controle"]:checked').val();
            var reason= $('select[name="reason_consult"] option:selected').val();
            var medical_information= $('textarea[name="medical_information"]').val();
            var year= {{ $currentYear }};
            var month= $('.time-link.clicked').closest('.item').find('.get-month').val();
            var time= $('.time-link.clicked').data('time');
            var day=  $('.time-link.clicked').closest('.item').find('.get-day').val();




            $.ajax({
                method: "POST",
                url: "{{ route('client.appointment', ':id') }}".replace(':id', idpatient),
                // url: "/patient/make-appointment/"+idpatient,
                data: {
                    idDoctor,
                    type,
                    controle,
                    reason,
                    medical_information,
                    year,
                    month,
                    time,
                    day,
                    _token :'{{csrf_token()}}'
                },
                success: function(response) {
                    if (response.hasOwnProperty('danger')) {
                        let errorMessages = "";
                        if (response.danger.day) {
                            errorMessages += response.danger.day.join(", ") + "\n";
                        }
                        if (response.danger.medical_information) {
                            errorMessages += response.danger.medical_information.join(", ") + "\n";
                        }
                        swal("Error!", errorMessages.trim(), "error");
                    } else if (response.hasOwnProperty('success')) {
                        swal("Success!", JSON.stringify(response.success), "success");
                    } else {
                        swal("Error!", "An unexpected error occurred.", "error");
                    }
                }
            });
        });
    });
</script>


@endsection
