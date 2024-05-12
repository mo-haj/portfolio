<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Models\Patient;
use App\Models\Date;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;



class JWTController extends Controller
{
    /**
     * Create a new JWTController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Remove the middleware definitions if not needed
        $this->middleware('jwt.refresh')->only('update');
        $this->middleware('jwt.auth')->only('destroy');
    }

    /**
     * Authenticate user and generate JWT token.
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return redirect()->route('error')->with('error', 'Unauthorized');
        }

        $user = Auth::user();
        
        $today = now()->format('Y-m-d');
        Session::put('jwt_token', $token);
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
                public function register(Request $request){
                   

                    $user = User::create([
                        
                        'name' => $request->name,
                        'email' => $request->email,
                        'role' => 0,
                        'password' => Hash::make($request->password),
                    ]);
                    $doctor = $user->doctor()->create([

                        
                        'name' => $request->name,
                        'email' => $request->email,
                        'number' => $request->number,
                        'spec_id' =>0,
                    ]);

                    $token = Auth::login($user);
                    Session::put('jwt_token', $token);
                   
                    return redirect()->route('dashboard')->with('success', 'Doctor updated successfully.');

                    
                }
                public function logout(Request $request)
                {
                    Auth::logout(); // Logout the user
            
                    // Invalidate the JWT token
                    try {
                        JWTAuth::parseToken()->invalidate();
                    } catch (\Exception $e) {
                        // Token invalidation failed, handle error if needed
                    }
            
                    // Clear user session
                    $request->session()->flush();
            
                    // Redirect or return response as needed
                    return redirect()->route('homebage'); // Redirect to login page
                }
    // Other methods (update, destroy) remain the same
}
