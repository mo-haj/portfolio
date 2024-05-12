<?php

// AppointmentController.php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

use Illuminate\Pagination\LengthAwarePaginator;

class AppointmentsController extends Controller
{
    public function index(int $month)
    {
        $user = Auth::user();
        $currentDoctor = Doctor::where('user_id','=',$user->id)->first();
        $currentMonth = $month;
        if ($currentDoctor) {
            $currentYear = Carbon::now()->year;

            $searchQuery = session('searchQuery');

        // Query appointments based on the current month and search query
        $appointments = Appointment::where('doctor_id', '=', $currentDoctor->id)
            ->whereMonth('appointment_date', $month)
            ->when($searchQuery, function ($query, $searchQuery) {
                return $query->where('patient_name', 'like', '%' . $searchQuery . '%');
            })
            ->paginate(5);
            session(['searchQuery' => null]);
                 return view('calendar', [
              
                'appointments' => $appointments,
                'currentDoctor'=> $currentDoctor,
                'currentMonth' => $currentMonth,
           ]);
        //return view('calendar', compact('appointments'));
        }
        
      
        
    }
    public function storePage()
    {
        $user = Auth::user();
        $currentDoctor = Doctor::where('user_id','=',$user->id)->first();
        if ($currentDoctor) {
            $patients = Patient::where('doctor_id','=',$currentDoctor->id)->get();
            }
            return view('appointment', [
              
                'patients' => $patients,
                'currentDoctor'=> $currentDoctor
           ]);
    }
    public function sort_app()
    {
       
    }
   
        public function destroy(Appointment $appointment)
{
    
    $user = Auth::user();
    $appointment->delete();
        $currentDoctor = Doctor::where('user_id','=',$user->id)->first();

        if ($currentDoctor) {
        $appointments = Appointment::where('doctor_id','=',$currentDoctor->id)->paginate(5);
        return redirect()->route('calendar', ['month' => date('n')])->with('success', 'Patient created successfully.');
    }
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $currentDoctor = Doctor::where('user_id','=',$user->id)->first();
        if($currentDoctor){
            list($patientId, $patientName) = explode('|', $request->input('patient_id'));

        $appointment = Appointment::create([

            'doctor_id'=>  $currentDoctor->id, 
            'patient_id'=> $patientId,
            'patient_name'=> $patientName,
            'appointment_date'=> $request->appointment_date,
            'appointment_time'=> $request->appointment_time,
            'Note'=> $request ->Note,
            
        ]);
    }
    return redirect()->route('calendar', ['month' => date('n')])->with('success', 'Patient created successfully.');

    }
    public function search(Request $request)
{
    // Store the search query in session data
    session(['searchQuery' => $request->input('searchName')]);

    // Redirect back to the calendar page with the current month
    return redirect()->route('calendar', ['month' => $request->month]);
}
    

    
    public function update(Request $request)
    {

        // Get the appointment ID from the request (assuming it's passed as a hidden field)
        $appointmentId = $request->input_id;

        // Find the appointment by ID
        $appointment = Appointment::where('id','=',$appointmentId)->first();

        if ($appointment) {
            // Update appointment data  
            $appointment->appointment_date = $request->input_date;
            $appointment->appointment_time = $request->input_time;
            $appointment->Note = $request->Note;
            // Save the updated appointment
            $appointment->save();

            return redirect()->route('calendar', ['month' => date('n')])->with('success', 'Patient created successfully.');
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'not Found',
            ], 404);
        }
    }
    public function calendar_pages()
    {
        $user = Auth::user();
        $currentDoctor = Doctor::where('user_id','=',$user->id)->first();

        if ($currentDoctor) {
        $appointments = Appointment::where('doctor_id','=',$currentDoctor->id)->paginate(6); // Number of items per page
        }
        return view('calendar', compact('appointments'));
    }
  
}


