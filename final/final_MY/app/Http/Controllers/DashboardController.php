<?php

namespace App\Http\Controllers;
use App\Models\Patient;
use App\Models\Date;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $today = now()->format('Y-m-d');
        $currentDoctor = Doctor::where('user_id','=',$user->id)->first();

        if ($currentDoctor) {
            $PatientsCount = Patient::where('doctor_id', $currentDoctor->id)->count();
        // edit this to get count of patient
        $appointmentsTime = Appointment::where('doctor_id','=',$currentDoctor->id)->whereDate('appointment_date', $today)->count(); //  edit this to get the number of appointment
        $appointments = Appointment::where('doctor_id','=',$currentDoctor->id)->whereDate('appointment_date', $today)->get();
        $earliestAppointment = Appointment::where('doctor_id','=',$currentDoctor->id)->whereDate('appointment_date', $today)->orderBy('appointment_time')->first();
        $currentDateAppointments = Appointment::where('doctor_id','=',$currentDoctor->id)->whereDate('appointment_date', $today)->get();
       

            // Fetch distinct appointment times
            $appointmentTimes = Appointment::where('doctor_id','=',$currentDoctor->id)->whereDate('appointment_date', $today)->select('appointment_time')
                ->distinct()
                ->orderBy('appointment_time')
                ->get();
            }
            // Pass the data to the view
            return view('dashboard', [
                'PatientsCount' => $PatientsCount,
                'appointmentsTime' => $appointmentsTime,
                'appointments' => $appointments,
                'appointmentTimes' => $appointmentTimes, // Include appointmentTimes in the data passed to the view
                'earliestAppointment' =>$earliestAppointment,
                'currentDoctor'=> $currentDoctor
            ]);
    }
}
