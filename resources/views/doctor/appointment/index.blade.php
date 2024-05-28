@section('title', 'Appointment')
@extends('layouts_user.master')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                @if (Session::has('success'))
                    @include('alert.success')
                @elseif(Session::has('danger'))
                    @include('alert.danger')
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>
                            List of appointment
                            <a href="{{ route('appointment.historique') }}" class="btn btn-primary float-end">Historique</a>

                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar" style="min-height: 400px">
                            <table class="display" id="basic-1" >
                                <thead>
                                    <tr>
                                        <th><span>type</span></th>
                                        <th><span>first Name</span></th>
                                        <th><span>last name</span></th>
                                        <th><span>Age</span></th>
                                        <th><span>reason of consultation</span></th>
                                        <th><span>date of appointment</span></th>
                                        <th><span>hour</span></th>
                                        <th><span>Status</span></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $appointment)
                                        @php
                                            $birthDate = Carbon\Carbon::parse($appointment->patient->date_naissance);
                                            $currentDate = Carbon\Carbon::now();
                                            $age = $currentDate->diffInYears($birthDate);
                                        @endphp
                                        <tr>
                                            <td class="d-flex justify-content-center">
                                                @if($appointment->type_appointment == 'personnel')
                                                    <i class="icofont icofont-bed f-18"></i>
                                                @else
                                                    <i class="icon-video-camera f-18"></i>
                                                @endif
                                            </td>
                                            <td> {{$appointment->patient->fname}} </td>
                                            <td> {{$appointment->patient->lname}} </td>
                                            <td> {{$age}} years old</td>
                                            <td>{{$appointment->motif->nom_motif}}</td>
                                            <td>{{$appointment->appontment_date}}</td>
                                            <td>{{$appointment->start_at}}</td>
                                            <td><span class="{{$appointment->status == "pending" ? 'badge text-bg-warning' :
                                                        ($appointment->status == "inprogress" ? 'badge text-bg-primary badge-small' : 'badge bg-warning')}}"><strong class="text-light text-capitalize">{{$appointment->status}}</strong></span></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn border-0 text-black" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more text-black"></i></button>
                                                    <ul class="dropdown-menu dropdown-block">
                                                        <li> <a class="dropdown-item" type="button" data-bs-toggle="modal" onclick="setAppointmentId('{{ $appointment->id }}')"  data-bs-target="#exampleModalLong">view information</a></li>
                                                    <li><a class="dropdown-item" type="button" data-bs-toggle="modal" onclick="setAppointmentId('{{ $appointment->id }}')" data-bs-target="#modifyAppointment">Modify Appointment</a></li>
                                                    @role('doctor')
                                                        <li><a class="dropdown-item" href="{{route('mypatient.details',$appointment->patient_id)}}">Detail of patient</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('appointment.destroy', $appointment->id) }}"onclick="confirm(event)">Delete</a>
                                                    @endrole
                                                    </li>
                                                    </ul>
                                                </div>
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
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Appointment</h4>
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row p-2">
                    <div class="col-md-12"><h4 style="color: #222f5b">Infromation patient</h4></div>
                    <div class="col-md-6"> <span class="text-mute">First Name</span>  </div>
                    <div class="col-md-6"> <span class="text-mute fname"></span>  </div>
                    <div class="col-md-6"> <span class="text-mute">Last Name</span>  </div>
                    <div class="col-md-6"> <span class="text-mute lname"></span>  </div>
                    <div class="col-md-6"> <span class="text-mute">Gender</span>  </div>
                    <div class="col-md-6"> <span class="text-mute gender"></span>  </div>
                    <div class="col-md-6"> <span class="text-mute">date of birth</span></div>
                    <div class="col-md-6"> <span class="text-mute date"></span>  </div>
                    <div class="col-md-6"> <span class="text-mute">city</span></div>
                    <div class="col-md-6"> <span class="text-mute city"></span>  </div>
                    <div class="col-md-6"> <span class="text-mute">Email</span></div>
                    <div class="col-md-6"> <span class="text-mute email"></span>  </div>
                    <div class="col-md-6"> <span class="text-mute">Phone number</span></div>
                    <div class="col-md-6"> <span class="text-mute phone"></span>  </div>
                </div>
                <hr>
                <div class="row p-2">
                    <div class="col-md-12"><h4 style="color: #222f5b">Infromation about appointment</h4></div>
                    <div class="col-md-6"> <span class="text-mute">Type of consultation</span>  </div>
                    <div class="col-md-6"> <span class="text-mute type_appointment"></span>  </div>
                    <div class="col-md-6"> <span class="text-mute">Controle</span>  </div>
                    <div class="col-md-6"> <span class="text-mute controle"></span>  </div>
                    <div class="col-md-6"> <span class="text-mute">Reason of appointment</span>  </div>
                    <div class="col-md-6"> <span class="text-mute reason"></span>  </div>
                    <div class="col-md-6"> <span class="text-mute">date of appointment</span></div>
                    <div class="col-md-6"> <span class="text-mute appontment_date"></span>  </div>
                    <div class="col-md-6"> <span class="text-mute">hours of appointment</span></div>
                    <div class="col-md-6"> <span class="text-mute start_at"></span>  </div>
                </div>
                <hr>
                <div class="row p-2">
                    <div class="col-md-12"><h4 style="color: #222f5b">Medical information</h4></div>
                    <div class="col-md-6"> <span class="text-mute medical_information"></span>  </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modifyAppointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Modify Appointment</h4>
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('appointment.update')}}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_appointment" id="id_appointment" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3 mb-0  w-100">
                                <div class="mb-3 mb-0 animated-modal-md-mb w-100">
                                    <label class="me-3">Reason for the consultation</label>
                                    <select class="form-select w-75" id="resons" name="reason_consult">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><h4 style="color: #222f5b">Type of consultation</h4></div>
                        <div class="col-md-6">
                            <input type="radio" name="type" value="personnel"  id="personnel">
                            <label for="personnel">face-to-face</label>
                        </div>
                        <div class="col-md-6">
                            <input type="radio" name="type"  id="remote" value="remote">
                            <label for="remote">teleconsultation</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><h4 style="color: #222f5b">Controle</h4></div>
                        <div class="col-md-6 mt-2">
                            <input type="radio" name="controle"  value="1" id="y">
                            <label for="y">Yes</label>
                        </div>
                        <div class="col-md-6 mt-2">
                            <input type="radio" name="controle" value="0" id="n">
                            <label for="n">NO</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><h4 style="color: #222f5b">Medical information</h4>
                            <label class="form-label">Medical information<span class="txt-danger">*</span></label>
                            <textarea class="form-control" id="informations" name="informations" id="" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><h4 style="color: #222f5b">Status</h4></div>
                        <select name="status" class="form-control" id="status_get">

                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-secondary" type="submit" data-bs-dismiss="modal">Edit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Include jQuery from a CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function setAppointmentId(appointmentId) {
            // console.log(appointmentId);
            $.ajax({
                method: "Get", // Use POST method
                url: "{{ route('appointment.modify', '') }}" + "/" + appointmentId,
                data: [],
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    populateModal(response);
                }
            });
        }
        function populateModal(response) {
            $('#id_appointment').val(response[0].id);

            $('.fname').text(': '+response[3].fname);
            $('.lname').text(': '+response[3].lname);
            $('.gender').text(': '+response[3].gender);
            $('.city').text(': '+response[3].city.nom_city);
            $('.date').text(': '+response[3].date_naissance);
            $('.email').text(': '+response[3].email);
            $('.phone').text(': '+response[3].phone_number);

            $('.type_appointment').text(': '+response[0].type_appointment);
            if(response[0].controle == 1){
                $('.controle').text(': Yes');

            }else{
                $('.controle').text(': No');
            }
            $('.appontment_date').text(': '+response[0].appontment_date);
            $('.start_at').text(': '+response[0].start_at);
            $('.reason').text(': '+response[0].motif.nom_motif);
            $('.medical_information').text(response[0].medical_information);
            if(response[0].controle == 1){
                $('#y').prop('checked', true);
            }else if (response[0].controle == 0){
                $('#n').prop('checked', true);
            }

            if(response[0].type_appointment == 'personnel'){
                $('#personnel').prop('checked', true);
            }else if(response[0].type_appointment == 'remote'){
                $('#remote').prop('checked', true);
            }

            $('#informations').val(response[0].medical_information).text(response[0].medical_information);

            if(response[0].status == 'pending'){
                $('#pending').prop('checked', true);
            }else if(response[0].status == 'inprogress'){
                $('#inprogress').prop('checked', true);
            }
            else if(response[0].status == 'waiting'){
                $('#waiting').prop('checked', true);
            }
            else if(response[0].status == 'completed'){
                $('#completed').prop('checked', true);
            }
            else if(response[0].status == 'cancelled'){
                $('#cancelled').prop('checked', true);
            }
            let status_html = "";
            $('#status_get').empty();
            var status = ["pending", "inprogress", "waiting", "completed", "cancelled"];

            for (var i = 0; i < status.length; i++) {
                if(response[0].status == 'completed' || response[0].status == 'cancelled'){
                    status_html += '<option>the status can\'t change</option>';
                    break;
                }else if(response[0].status == 'inprogress'){
                    if (status[i] === 'inprogress') {
                        status_html += '<option selected value="inprogress">inprogress</option>';
                    } else if(status[i] === 'pending'){
                        continue;
                    }else{
                        status_html += '<option value="' + status[i] + '">' + status[i] + '</option>';

                    }
                }else if(response[0].status == 'waiting'){
                    if (status[i] === 'waiting') {
                        status_html += '<option selected value="' + status[i] + '">' + status[i] + '</option>';
                    } else if(status[i] === 'pending' || status[i] === 'inprogress'){
                        continue;
                    }else{
                        status_html += '<option value="' + status[i] + '">' + status[i] + '</option>';

                    }
                }
                else if (status[i] === response[0].status) {
                    status_html += '<option selected value="' + response[0].status + '">' + response[0].status + '</option>';
                } else {
                    status_html += '<option value="' + status[i] + '">' + status[i] + '</option>';
                }
            }

            $('#status_get').append(status_html); // changed from append(html) to append(status_html)


            let html = "";
            $('#resons').empty();
            let spec = null;// Clear previous content before populating again
            for (let i = 0; i < response[1].length; i++) {
                 // Clear html variable at the beginning of each iteration
                html += '<optgroup label="' + response[1][i].name_sp + '"></optgroup>';
                for (let j = 0; j < response[2].length; j++) {
                    if ( response[2][j].speciality_id == response[1][i].id) {
                        if (response[0].motif_id == response[2][j].id) {
                            html += '<option selected value="'+response[2][j].id+'">' + response[2][j].nom_motif + '</option>';
                        } else {
                            html += '<option value="'+response[2][j].id+'">' + response[2][j].nom_motif + '</option>';
                        }
                        // Exit the inner loop once the condition is met
                    }
                }
            }
            $('#resons').append(html); // Append the html content after each iteration


        }

    </script>
@endsection

