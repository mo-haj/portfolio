<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main_1.css">
    <link rel="stylesheet" href="css/profile.css">
    <title>Krizet</title>
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
                        <img src="{{ Storage::url( $doctor->Img) }}" alt="Profile Picture" class="avatar">
                        Dr.{{$doctor->name}}
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

        <div class="col-md-10 col-sm-8 middle-column">
            
            <!-- Profile Section --> 
            <div class="profile-section row">
                <h2 class="profile-heading col-3">Doctor Profile</h2>
            <div class="col-8">
                <a href="{{url('/edit_doctor')}}" class="btn btn-primary new-appointment-btn " style="float: right;" ><i class="fa-solid fa-plus" style="margin-right: 20px;"></i>Edit Doctor Profile</a>
            </div>
                <div class="profile-details">
                    <!-- Profile Picture and Name (Centered) -->
                   
                    <div class="profile-info text-center">
                        <!-- Profile Picture -->
                        <div class="profile-picture">
                            <img src="{{ Storage::url( $doctor->Img) }}" alt="Doctor Profile Picture">
                        </div>
                        <!-- Doctor Name -->
                        <h1 class="doctor-name">{{$doctor->name}}</h1>
                    </div>
                    
                    <!-- Doctor Information (Left and Right Aligned) -->
                    <div class="doctor-info">
                        <p><strong>Email:</strong> {{$doctor->email}}</p>
                        <textarea rows="8" cols="150" disabled>{{$doctor->disc}}</textarea>
                        <!-- Add more profile information as needed -->
                    </div>
                </div>
            </div>
            <!-- Rest of the content goes here -->
        </div>
        
        
        
        
        

        
             <script src="https://kit.fontawesome.com/bd4523f78c.js" crossorigin="anonymous"></script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="js/main_1.js"></script>
        
        <!--page refresh style-->
     <script src="js/jquery.min.js"></script>
        <script src="js/main.js"></script> 

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