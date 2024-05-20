<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .logo{
                position: relative;
            bottom: 51px;
            left: 45%;
        }
        .table-responsive{
            margin-top: 20px;
        }

        .name{
            margin-top: 20px;
            border-bottom: 1px dashed #2F9BA7;
        }
        .center{
            text-align : center;
            margin: 0;
            color: #222F5B;
        }
         /* Center tables for demo */
        table {
            margin: 0 auto;
        }

        /* Default Table Style */
        table {
            color: #333;
            background: white;
            border: 1px solid grey;
            font-size: 12pt;
            border-collapse: collapse;
        }
        table thead th,
        table tfoot th {
            color: #777;
            background: rgba(0,0,0,.1);
        }
        table caption {
            padding:.5em;
            font-size: 25px;
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
        }
        table th,
        table td {
            padding: .5em;
            border: 1px solid lightgrey;
        }
        .card-footer{
             position:absolute;
            bottom:0px;
            right:25%;
            left:50%;
            margin-left:-150px;

        }
    </style>
</head>

<div class="row row-sm">
    <div class="col-lg-12 col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <span class="m-0">Dr. {{$doctor->fname .' '. $doctor->lname}}</span><br>
                @php
                    $parametres = App\Models\Parametre::where('doctor_id', $doctor->id)->first();
                    $serializedSpecialities = $parametres->speciality_id;
                    $selectedSpecialities = unserialize($serializedSpecialities);
                    $specialities = App\Models\Speciality::whereIn('id', $selectedSpecialities)->get();
                    $j = 1; // Start counting from 1
                    $sp = ""; // Initialize an empty string
                    foreach ($specialities as $speciality) {
                        $sp .= $speciality->name_sp;
                        if ($specialities->count() > $j) { // Check if not the last item
                            $sp .= ', '; // Add comma and space if not the last item
                        }
                        $j++;
                    }
                @endphp
                <span class="breadcrumb-item m-0">{{ $sp }}</span><br>
                    {{-- <div class="btn btn-primary">HHH</div> --}}
                    @php $imagePath = public_path('/images/head/'.$doctor->parametre->entete) @endphp
                    <img src="{{$imagePath}}" width="15%" class="logo" alt="test">
                <div class="name">
                    <h2 class="center">Ordonnace</h2>
                </div>
                @if($ordonnance->type_ordonnance === 'pharmacy')
                    <div class="table-responsive mg-t-40">
                        <table class="table table-bordered">
                            <caption class="text-center ">Table of Medicament for Patient {{$patient->fname.' '.$patient->lname}}
                            </caption>
                            <thead>
                                <tr>
                                    <th>Medicament</th>
                                    <th>Treatment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pharmacy_med as $phmed)
                                    <tr>
                                        <td>{{$phmed->medicament}}</td>
                                        <td>{{$phmed->treatment}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <fieldset style="margin-top: 20px">
                    <legend>Remarque</legend>

                        {{$ordonnance->remarque}}
                </fieldset>
                </div>
            </div>
            <div class="card-footer">
                <div>
                    {{$doctor->address.', '.$doctor->city->nom_city.' '.$doctor->zip_code}}<br>
                    {{$doctor->phone_number.'-'.$doctor->email}}
                </div>
            </div>
        </div>
    </div>
</div>
<br>
</body>

</html>
