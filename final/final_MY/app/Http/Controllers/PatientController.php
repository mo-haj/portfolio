<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Doctor;


class PatientController extends Controller
{
    public function index()
    {
    //     $user = Auth::user();
    //     $currentDoctor = Doctor::where('user_id','=',$user->id)->first();

    //     if ($currentDoctor) {
    //     $patients = Patient::where('doctor_id','=',$currentDoctor->id)->get();
    //     }
    //     return view('patients', [
          
    //         'patients' => $patients,
    //         'currentDoctor'=> $currentDoctor
    //    ]);

    $user = Auth::user();
    $currentDoctor = Doctor::where('user_id','=',$user->id)->first();

    if ($currentDoctor) {

        $searchQuery = session('searchQuery');

    // Query appointments based on the current month and search query
  
        $patients = Patient::where('doctor_id', '=', $currentDoctor->id)
        ->when($searchQuery, function ($query, $searchQuery) {
            return $query->where('name', 'like', '%' . $searchQuery . '%');
        })->get();
        session(['searchQuery' => null]);

             return view('patients', [
          
            'patients' => $patients,
            'currentDoctor'=> $currentDoctor

       ]);
    //return view('calendar', compact('appointments'));
    
    }
    }

    public function search(Request $request)
    {
        session(['searchQuery' => $request->input('searchName')]);

    // Redirect back to the calendar page with the current month
    return redirect()->route('patients');
    }
    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $currentDoctor = Doctor::where('user_id','=',$user->id)->first();

        $image = $request->file('img');
        

        if($image){
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->store('public/images') ;
            }
            else
            {
                $imagePath = 'public/images/doctor.jpg' ;
            }
    
        if($currentDoctor){
        $patient = Patient::create([

            'doctor_id'=>  $currentDoctor->id,          
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'disc' => $request->disc,
            'Img'=> $imagePath
        ]);
    }
        return redirect()->route('patients')->with('success', 'Patient created successfully.');
    }


    public function show_new_patient()
    {
         $user = Auth::user();
        $currentDoctor = Doctor::where('user_id','=',$user->id)->first();
        return view('new-patients', compact('currentDoctor'));
    }
    public function show(Patient $patient)
    {
         $user = Auth::user();
        $currentDoctor = Doctor::where('user_id','=',$user->id)->first();
        return view('edit', compact('patient'),['currentDoctor'=> $currentDoctor]);
    }
    public function showprofile(Patient $patient)
    {
        $user = Auth::user();
        $currentDoctor = Doctor::where('user_id','=',$user->id)->first();
        return view('profile-patients', [
          
            'patient' => $patient,
            'currentDoctor'=> $currentDoctor
       ]);
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }
    public function update(Request $request)
    {

        
        $patientId = $request->id;
        $patient = patient::where('id','=',$patientId)->first();

        $image = $request->file('img');
        if($image){
        $imageName = $image->getClientOriginalName();
        $imagePath = $image->store('public/images') ;
        }
        else
        {
            $imagePath = $patient->Img ;
        }

        if ($patient) {
            $patient->name = $request->name;
            $patient->email = $request->email;
            $patient->number = $request->number;
            $patient->disc = $request->disc;
            $patient->Img = $imagePath;
            $patient->save();

            return redirect()->route('patients')->with('success', 'Patient created successfully.');
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'not Found',
            ], 404);
        }
    }
   

    public function destroy(patient $patient)
    {
             $patient->delete();
             return redirect()->route('patients')->with('success', 'Patient created successfully.');

        }
}
