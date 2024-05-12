<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krizet</title>

    <link rel="icon" href="img/favicon.png">
		
    <!-- Google Fonts -->
    

    <!--Bootstrap CSS-->
    
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Nice Select CSS -->
   
    <link rel="stylesheet" href="css/main_1.css">
    

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


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
<!-- End Preloader -->

    <!-- Header Section -->
    <header class="header">
        
            <div class="row align-items-center" style="margin-right: 0px !important;">
                <!-- Logo on the left -->
                <center>
                <div class="col-2 logo">
                    <a href="{{url('/dashboard')}}"><img src="img/test-login.png" alt="Clinic Logo"></a>
                </div>
                </center>
                <!-- User dropdown on the right -->
                <div class="col-10 user-dropdown">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="userDropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- Add profile picture here -->
                            <img src="{{ Storage::url( $currentDoctor->Img) }}" alt="Profile Picture" class="avatar">
                            Dr.{{$currentDoctor->name}}
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

        <div class="col-md-10 col-sm-8 middle-column " style="height:600px;">
<form class="appointment-form " action="{{ route('addappointment')}}" method="POST">
@csrf
    <h2>Appointment :</h2>
    
    <div class="col-12">
    <div class="form-group ">
        <label for="Patient">Select Patient:</label>
        <select id="patient_id" name="patient_id" style="width:auto!important;text-align:right;">
        @foreach($patients as $patient)
        <option value="{{ $patient->id }}|{{ $patient->name }}" >{{ $patient->name }}</option>
            @endforeach
            
        </select>
    </div>
    </div>
    <div class="col-12">
    <div class="form-group">
        <label for="date">Select Date:</label>
        <input type="text" id="appointment_date" name="appointment_date" placeholder="Click Date" required style="width: 50%;">
        <input type="time" id="appointment_time" name="appointment_time" placeholder="time" required style="height:45px;border-radius:10%;border:1px ;">
    </div>
    </div>
    <div class="col-12">
    <div class="form-group">
        <label for="Note">ADD Note:</label>
    <textarea id="Note" name="Note" rows="5" cols="100"></textarea>
    </div>
    </div>

    
    <div class="sub-appointment">
        <button type="submit" class="col-md-3 col-sm-6 new-appointment-btn">Schedule Appointment</button>
    </div>
</form>
</div>


<script src="js/jquery.min.js"></script>
        <script src="js/main.js"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $("#appointment_date").datepicker({
        dateFormat: "yy-mm-dd",
        onSelect: function(dateText, inst) {
            // Handle date selection here if needed
        }
    });

    // Show the calendar when the input field is clicked
    $("#appointment_date").on("click", function() {
        $("#calendar-container").toggle();
    });
});

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