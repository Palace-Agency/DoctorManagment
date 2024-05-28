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
                            List of appointments with doctors
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar" style="min-height: 400px">
                            <table class="display" id="basic-1" >
                                <thead>
                                    <tr>
                                        <th><span>type</span></th>
                                        <th><span>Doctor's first name</span></th>
                                        <th><span>Doctor's last name</span></th>
                                        <th><span>reason of consultation</span></th>
                                        <th><span>date of appointment</span></th>
                                        <th><span>hour</span></th>
                                        <th><span>Status</span></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $appointment)

                                        <tr>
                                            <td class="d-flex justify-content-center">
                                                @if($appointment->type_appointment == 'personnel')
                                                    <i class="icofont icofont-bed f-18"></i>
                                                @else
                                                    <i class="icon-video-camera f-18"></i>
                                                @endif
                                            </td>
                                            <td> {{$appointment->doctor->fname}} </td>
                                            <td> {{$appointment->doctor->lname}} </td>
                                            <td>{{$appointment->motif->nom_motif}}</td>
                                            <td>{{$appointment->appontment_date}}</td>
                                            <td>{{$appointment->start_at}}</td>
                                            <td><span class="{{$appointment->status == "pending" ? 'badge text-bg-warning' :
                                                        ($appointment->status == "inprogress" ? 'badge text-bg-primary badge-small' :
                                                        ($appointment->status == "cancelled" ? 'badge text-bg-danger badge-small' :
                                                        ($appointment->status == "completed" ? 'badge text-bg-success badge-small' : 'badge bg-warning')))}}"><strong class="text-light text-capitalize">{{$appointment->status}}</strong></span></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn border-0 text-black" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more text-black"></i></button>
                                                    <ul class="dropdown-menu dropdown-block">
                                                        <li> <a class="dropdown-item fw-bold text-dark" type="button" data-bs-toggle="modal" onclick="setDoctorId('{{ $appointment->doctor->id }}')"  data-bs-target="#exampleModalLong">view informations</a></li>
                                                        @if(!in_array($appointment->status, ['cancelled', 'completed']))
                                                            <form id="" method="POST" action="{{route('client.cancelle',$appointment->id)}}">
                                                                @csrf
                                                                <input type="hidden" class="status" name="status" value="cancelled">
                                                                <button class="dropdown-item text-danger fw-bold" type="submit">Cancelle Appointment</button>
                                                            </form>
                                                        @endif
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
                    <div class="col-md-12"><h4 style="color: #222f5b">Infromation Doctor</h4></div>
                    <div class="col-md-6"> <span class="text-mute">First Name</span>  </div>
                    <div class="col-md-6"> <span class="text-mute fname"></span>  </div>
                    <div class="col-md-6"> <span class="text-mute">Last Name</span>  </div>
                    <div class="col-md-6"> <span class="text-mute lname"></span>  </div>
                    <div class="col-md-6"> <span class="text-mute">Gender</span>  </div>
                    <div class="col-md-6"> <span class="text-mute gender"></span>  </div>
                    <div class="col-md-6"> <span class="text-mute">city</span></div>
                    <div class="col-md-6"> <span class="text-mute city"></span>  </div>
                    <div class="col-md-6"> <span class="text-mute">Email</span></div>
                    <div class="col-md-6"> <span class="text-mute email"></span>  </div>
                    <div class="col-md-6"> <span class="text-mute">Phone number</span></div>
                    <div class="col-md-6"> <span class="text-mute phone"></span>  </div>
                </div>

            </div>
            <div class="modal-footer border-0">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script>
        function setDoctorId(idDoctor){
            $.ajax({
                method: "Get", // Use POST method
                url: "{{ route('client.get-doctor', '') }}" + "/" + idDoctor,
                data: [],
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // console.log(response);
                    infoModal(response);
                }
            });
        }

        function infoModal(response) {

            $('.fname').text(': '+response[0].fname);
            $('.lname').text(': '+response[0].lname);
            $('.gender').text(': '+response[0].gender);
            $('.city').text(': '+response[0].city.nom_city);
            $('.email').text(': '+response[0].email);
            $('.phone').text(': '+response[0].phone_number);

        }
    </script>

@endsection
