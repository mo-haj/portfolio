<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('doctors.create');
    }

    public function store(Request $request)
    {
        Doctor::create($request->all());
        return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
    }

    public function show( )
    {
        $user = Auth::user();

        $doctor = Doctor::where('user_id','=',$user->id)->first();
       
        return view('profile', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        $user = Auth::user();

        $doctor = Doctor::where('user_id','=',$user->id)->first();
       
        return view('edit_doctor', compact('doctor'));
    }

    public function update(Request $request)
    {
        $DoctorID = $request->id;
        $Doctor = Doctor::where('id','=',$DoctorID)->first();

        $image = $request->file('img');
        if($image){
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->store('public/images') ;
            }
            else
            {
                $imagePath = $Doctor->Img ;
            }
        

        if ($Doctor) {
            $Doctor->name = $request->name;
            $Doctor->email = $request->email;
            $Doctor->disc = $request->disc;
            $Doctor->Img = $imagePath;
            $Doctor->save();

            return redirect()->route('Doctors.show')->with('success', 'Patient created successfully.');
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'not Found',
            ], 404);
        }
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}
