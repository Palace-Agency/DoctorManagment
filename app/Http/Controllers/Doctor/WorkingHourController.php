<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Models\Parametre;
use App\Models\Vacation;
use App\Models\WorkingHour;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class WorkingHourController extends Controller
{
    public function index()
    {

        $workingdays=[];
        $days =["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"];
        foreach ($days as  $value) {
            $workingdays[$value] = WorkingHour::where('doctor_id', Auth::user()->id)
                                ->where('day_of_week', $value)->get()->toArray();;
        }
        $holidays = Vacation::where('doctor_id',Auth::user()->id)->get();
        // dd($workingdays);
        return view('doctor.calendar.workinghoures', compact('workingdays','holidays'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $errors = [];

        foreach ($request->start_time as $key => $startTime) {
            $endTime = $request->end_time[$key];
            $start2Time = $request->start_time2[$key] ?? null; // Retrieve start_time2 if set
            $end2Time = $request->end_time2[$key] ?? null; // Retrieve end_time2 if set
            $day = $request->nameday[$key];

            // Check if the start time is greater than or equal to the end time
            if (Carbon::parse($startTime)->greaterThanOrEqualTo(Carbon::parse($endTime))) {
                $errors[] = [
                    'day' => $day,
                    'message' => 'The start time is greater than or equal to the end time.'
                ];
            }

            if ($start2Time !== null && $end2Time !== null) {
                if (Carbon::parse($start2Time)->lessThanOrEqualTo(Carbon::parse($endTime))) {
                    $errors[] = [
                        'day' => $day,
                        'message' => 'shift 2 : The start time is greater than or equal to the end time.'
                    ];
                }
                if (Carbon::parse($start2Time)->greaterThanOrEqualTo(Carbon::parse($end2Time))) {
                    $errors[] = [
                        'day' => $day,
                        'message' => 'shift 2 : The start time2 is greater than or equal to the end time2.'
                    ];
                }
            }
        }

        // Handle errors as needed

        if (empty($errors)) {
            // dd($request);
            if(WorkingHour::where('doctor_id',Auth::user()->id)->exists()){
                $duree = $request->duree;
                foreach ($request->start_time as $key => $startTime) {
                    $endTime = $request->end_time[$key];
                    $start2Time = $request->start_time2[$key];
                    $end2Time = $request->end_time2[$key];
                    $day = $request->nameday[$key];
                    $type_consult = $request->type_consult[$key];
                    $type_consult2 = $request->type_consult2[$key];
                    if($request->offDays != null){
                        $day_off = in_array($key, $request->offDays) ?  'active' : "disable";
                    }else{
                        $day_off = 'disable';
                    }
                    WorkingHour::where([
                        'doctor_id' => Auth::user()->id,
                        'day_of_week' => $day,
                        'shift' => '1'
                    ])->update([
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                        'day_off' => $day_off,
                        'type_consultation' => $type_consult
                    ]);
                    if ($start2Time !== null && $end2Time !== null) {
                        WorkingHour::updateOrInsert(
                            [
                                'doctor_id' => Auth::user()->id,
                                'day_of_week' => $day,
                                'shift' => '2'
                            ],
                            [
                                'start_time' => $start2Time,
                                'end_time' => $end2Time,
                                'day_off' => $day_off,
                                'type_consultation' => $type_consult2
                            ]
                        );

                    } else {
                        // If start_time and end_time are both null, delete the record
                        WorkingHour::where([
                            'doctor_id' => Auth::user()->id,
                            'day_of_week' => $day,
                            'shift' => '2'
                        ])->delete();
                    }


                }
                $doctor = Parametre::where('doctor_id', Auth::user()->id)->first();
                if ($doctor) {
                    $doctor->duree_appointments = $duree;
                    // dd($duree);
                    $doctor->save();
                }

                return response()->json(["success" => "the work hours saved"]);

            }else{
                $duree = $request->duree;
                foreach ($request->start_time as $key => $startTime) {
                    $endTime = $request->end_time[$key];
                    $start2Time = $request->start_time2[$key];
                    $end2Time = $request->end_time2[$key];
                    $day = $request->nameday[$key];
                    $type_consult = $request->type_consult[$key];
                    $type_consult2 = $request->type_consult2[$key];
                    $day_off = in_array($key, $request->offDays) ?  'active' : "disable";

                    WorkingHour::create([
                        'doctor_id' => Auth::user()->id,
                        'day_of_week' => $day,
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                        'day_off' => $day_off,
                        'type_consultation' => $type_consult,
                        'shift' => '1'
                    ]);

                    if ($start2Time !== null && $end2Time !== null) {
                        WorkingHour::insert([
                            'doctor_id' => Auth::user()->id,
                            'day_of_week' => $day,
                            'start_time' => $start2Time,
                            'end_time' => $end2Time,
                            'day_off' => $day_off,
                            'type_consultation' => $type_consult2,
                            'shift' => '2'
                        ]);
                    }
                }
                $doctor = Parametre::where('doctor_id', Auth::user()->id)->first();
                $doctor->duree_appointments = $duree;
                $doctor->save();
                return response()->json(["success" => "the work hours saved"]);
            }
        } else {

            return response()->json(["danger" => $errors]);
        }
    }

    public function vacance(Request $request){
        //if the request is empty
        if ($request->input() === null || empty($request->input())) {
            // dd($request);
            $holiday = Vacation::where('doctor_id',Auth::user()->id)->get();
            $holiday->each->delete();
            return response()->json(["success" => "all the holidays and vacation are deleted successfully"]);
        }
        $validator = Validator::make($request->all(), [
            'label.*' => 'required',
            'date_start_h.*' => 'required|date',
            'date_end_h.*' => 'required|date',
            'start_time_h.*' => 'required',
            'end_time_h.*' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['danger' => "All the inputs are requered or the label are same"]);
        }
        //condition about the date and the time
        foreach($request->label as $key => $value) {
            $label = $value;
            $time_end_h = $request->end_time_h[$key];
            $time_start_h = $request->start_time_h[$key];
            $date_start_h = $request->date_start_h[$key];
            $date_end_h = $request->date_end_h[$key];

            // Check if the start time is greater than or equal to the end time
            if (Carbon::parse($date_start_h)->greaterThan(Carbon::parse($date_end_h))) {
                return response()->json(['danger' => "the date start is greather than the end date"]);
            }
        }
        // create the vacation or holiday doesn't exist
        // foreach($request->label as $key=>$value){
        //     // Check if the label already exists for the current user
        //     $existingVacation = Vacation::where('doctor_id', Auth::user()->id)
        //                                 ->where('label', $value)
        //                                 ->first();
        //     if($existingVacation){
        //         $label = $value;
        //         $time_end_h = $request->end_time_h[$key];
        //         $time_start_h = $request->start_time_h[$key];
        //         $date_start_h = $request->date_start_h[$key];
        //         $date_end_h = $request->date_end_h[$key];
        //         $existingVacation->label = $label;
        //         $existingVacation->date_start = $date_start_h;
        //         $existingVacation->date_end = $date_end_h;
        //         $existingVacation->time_end = $time_end_h;
        //         $existingVacation->time_start = $time_start_h;
        //         $existingVacation->save();

        //     }else{
        //         $label = $value;
        //         $time_end_h = $request->end_time_h[$key];
        //         $time_start_h = $request->start_time_h[$key];
        //         $date_start_h = $request->date_start_h[$key];
        //         $date_end_h = $request->date_end_h[$key];

        //         Vacation::create([
        //             "doctor_id" => Auth::user()->id,
        //             "label" => $label,
        //             "date_start" => $date_start_h,
        //             "date_end" => $date_end_h,
        //             "time_start" => $time_start_h,
        //             "time_end" => $time_end_h,
        //         ]);

        //         return response()->json(["success" => "the holidays saved successfully"]);
        //     }
        // }

        foreach ($request->label as $key => $value) {
            $flag = 0;
            $label = $value;
            $time_end_h = $request->end_time_h[$key];
            $time_start_h = $request->start_time_h[$key];
            $date_start_h = $request->date_start_h[$key];
            $date_end_h = $request->date_end_h[$key];
            $id_vac = $request->vac_id[$key] ?? null;
             // Check if the label already exists for the current user
            if($id_vac!=null){
                $existingVacation = Vacation::where('doctor_id', Auth::user()->id)
                                            ->where('id', $id_vac)
                                            ->first();
            }else{
                $existingVacation = false;
            }
            if($existingVacation){
                $label = $value;
                $time_end_h = $request->end_time_h[$key];
                $time_start_h = $request->start_time_h[$key];
                $date_start_h = $request->date_start_h[$key];
                $date_end_h = $request->date_end_h[$key];
                $existingVacation->label = $label;
                $existingVacation->date_start = $date_start_h;
                $existingVacation->date_end = $date_end_h;
                $existingVacation->time_end = $time_end_h;
                $existingVacation->time_start = $time_start_h;
                $existingVacation->save();
                // return response()->json(["success" => "the holidays saved 1 successfully"]);

            }else{
                $label = $value;
                $existingLabel = Vacation::where('doctor_id', Auth::user()->id)
                    ->where('label', $label)
                    ->first();
                if($existingLabel){
                    $flag = 1;
                    // $errors = "the " . $label . " already exist";
                }else{
                    $time_end_h = $request->end_time_h[$key];
                    $time_start_h = $request->start_time_h[$key];
                    $date_start_h = $request->date_start_h[$key];
                    $date_end_h = $request->date_end_h[$key];

                    Vacation::create([
                        "doctor_id" => Auth::user()->id,
                        "label" => $label,
                        "date_start" => $date_start_h,
                        "date_end" => $date_end_h,
                        "time_start" => $time_start_h,
                        "time_end" => $time_end_h,
                    ]);

                }
            }
        }

        if($flag == 1){
            return response()->json(["danger" => "the ".$label." already exist"]);
        }else{
            return response()->json(["success" => "the holidays saved successfully"]);
        }
    }
}
