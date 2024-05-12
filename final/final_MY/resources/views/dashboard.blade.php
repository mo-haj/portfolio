<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krizet</title>
    <link rel="icon" href="img/favicon.png">
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main_1.css">
</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <div class="loader">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>

        <div class="indicator"> 
            <svg width="16px" height="12px">
                <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
            </svg>
        </div>
    </div>
</div>
    <!-- Header Section -->
    <header class="header">
        
            <div class="row align-items-center" style="margin-right: 0px !important;">
                <!-- Logo on the left -->
                <center>
                <div class="col-2 logo">
                    <a href="{{url('/dashboard')}}"><img src="img/test-login.png" alt="Clinic Logo"></a>
                </div>
                </center>
                <!-- User clock on the mid -->
               
                <!-- User dropdown on the right -->
                <div class="col-10 user-dropdown">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="userDropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- Add profile picture here -->
                            <img src="{{ Storage::url( $currentDoctor->Img) }}" alt="Profile Picture" class="avatar">
                            Dr.{{ $currentDoctor->name }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userDropdownMenuButton">
                           <li><a class="dropdown-item" href="{{url('/doctor_profile')}}">Profile</a></li>
                             <li><a class="dropdown-item" href="#">Settings</a></li>
                              <li><hr class="dropdown-divider"></li>
                              <li><a class="dropdown-item" href="{{ route('logout')}}">Logout</a></li>
        </ul>


                    </div>
                </div>
                
            </div>

            

    </header>
    <!-- End Header Section -->
    <div class="modal fade" id="settingsModal" tabindex="-1" aria-labelledby="settingsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="settingsModalLabel">Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="btn-group d-grid">
                    <button type="button" class="btn btn-gray">gray</button>
                    <button type="button" class="btn btn-lightblue">Light Blue</button>
                    <button type="button" class="btn btn-white">White</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveSettingsBtn">Save</button>
            </div>
        </div>
    </div>
</div>
    <!-- Content Section -->
    <div class="container-fluid">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-2 col-sm-4 left-column">
                <!-- Dashboard -->
                <a href="{{ url('/dashboard')}}" class="menu-link"><i class="fa-solid fa-table" style="margin-right: 10px;"></i>Dashboard</a>
                <div class="line"></div>
                <!-- Calendar -->
                <a href="{{ route('calendar', ['month' => date('n')]) }}" class="menu-link"><i class="fa-solid fa-calendar-days" style="margin-right: 10px;"></i>Calendar</a>
                <div class="line"></div>
                <!-- Patients -->
                <a href="{{ url('/patient')}}" class="menu-link"><i class="fa-solid fa-user-group" style="margin-right: 10px;"></i>Patients</a>
                <div class="line"></div>
                <!-- Logout -->
                <a href="{{ route('logout')}}" class="logout-link mt-auto"><i class="fa-solid fa-right-to-bracket" style="margin-right: 10px;"></i>Logout</a>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <!-- Middle Column -->
            <div class="col-md-7 col-sm-4 middle-column">
                <!-- Daily Overview -->
               <h2>Daily Overview</h2>
               <div id="MyClockDisplay" class="clock" onload="showTime()" ></div>
                <div class="overview row">
                    <div class="overview-box col-lg-3">
                        <div class="box">
                        <h6><i class="fa-regular fa-circle-user" style="margin-right: 10px;color: rg(62,43,92);"></i>Patients</h6>
                        <p><strong>{{ $PatientsCount }}</strong></p>
                    </div>
                    </div>
                    <div class="col-6">
                    <div class="box" style="margin-top: 5px;font-size:20px;">
                        <h6><i class="fa-regular fa-comments" style="margin-right: 10px;"></i>The earliest date name/time</h6>
                     @if($earliestAppointment)
                     <pre>
    <strong>{{ $earliestAppointment->patient_name }}          {{ $earliestAppointment->appointment_time }}</strong>
</pre>
                    @else
                        <p>No appointments found.</p>
                    @endif
                    </div>
                </div>
                    <div class="overview-box col-lg-3">
                        <div class="box">
                        <h6><i class="fa-regular fa-comments" style="margin-right: 10px;"></i>Appointments</h6>
                        <p><strong>{{ $appointmentsTime }}</strong></p>
                    </div>
                    </div>
                    
                    
                </div>
    
    <!-- Schedule -->
    <h2>Schedule</h2>
    <div class="schedule col-lg-12">
        
    <table>
    <thead>
    @foreach ($appointmentTimes as $time)
        <th>{{ \Carbon\Carbon::parse($time->appointment_time)->format('H:i') }}</th>
    @endforeach
</thead>
<tbody> 
    @foreach ($appointments as $appointment)
        <tr>
            @foreach ($appointmentTimes as $time)
                <td>
                    @if (\Carbon\Carbon::parse($appointment->appointment_time)->format('H') == \Carbon\Carbon::parse($time->appointment_time)->format('H'))
                    <strong>{{ $appointment->patient_name }}</strong>
                    @endif
                </td>
            @endforeach
        </tr>
    @endforeach
</tbody>

</table>

    </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-3  col-sm-4 right-column">
                <div id='calendar'></div>

                
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://kit.fontawesome.com/bd4523f78c.js" crossorigin="anonymous"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="js/main_1.js"></script>


    <!--page refresh style-->
    <script src="js/jquery.min.js"></script>
        <script src="js/main.js"></script> 
        <script src="js/clock.js"></script>

        <script>
            
    document.querySelectorAll('.btn-gray').forEach(btn => {
        btn.addEventListener('click', function() {
            document.body.style.backgroundColor = 'gray';
        });
    });
    document.querySelectorAll('.btn-lightblue').forEach(btn => {
        btn.addEventListener('click', function() {
            document.body.style.backgroundColor = '#add8e6';
        });
    });
    document.querySelectorAll('.btn-white').forEach(btn => {
        btn.addEventListener('click', function() {
            document.body.style.backgroundColor = 'white';
        });
    });
    const settingsModal = new bootstrap.Modal(document.getElementById('settingsModal'));

    document.querySelector('.dropdown-item[href="#"]').addEventListener('click', function() {
        settingsModal.show();
    });
</script>

</body>
</html>
