<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krizet</title>
    <link rel="icon" href="img/favicon.png">    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main_1.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/patients.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
<!-- Preloader -->
<div class="preloader" >
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


  <div class="col-md-10 col-sm-8 middle-column" style="height:600px !important;">
  <div class="appointments-header d-flex justify-content-between align-items-center row" >
    
                <h2 class="col-3">Patients</h2>
                <form class="search-bar col-6" action="{{ route('searchPatient')}}" method="POST">
                    @csrf
                    <div class="search-boxxx">
                    <input type="text" id="searchName" name="searchName" class="form-control   search-txtxx" placeholder="Search..." >
                    <button class="btn searchbar search-btnxx" type="submit"><i class="fas fa-search"></i></button>
                     </div>
                    </form>
                <a href="{{url('/add-patients')}}" class="btn btn-primary new-appointment-btn col-2" ><i class="fa-solid fa-plus" style="margin-right: 20px;"></i>New Patients</a>
                
            </div>
   
    <div class="container" id="patientsContainer">
        <!-- Patient information -->
        @foreach($patients as $patient)
    <div class="patient">
    <img src="{{ Storage::url( $patient->Img) }}" alt="{{ $patient->name }}">
    <h6>{{ $patient->name }}</h6>
    
    <a class="btn btn-sm btn-primary" href="{{url('/profile', ['id' => $patient->id]) }}"  title="Preview" style="padding:4px 8px !important;"><i class="fas fa-eye fa-xs"></i></a>
    <a class="btn btn-sm btn-warning" href="{{ url('/edit', ['id' => $patient->id]) }}" title="Edit"><i class="fas fa-pen-to-square fa-xs"></i></a>
    <a class="btn btn-sm btn-danger" title="Delete" href="{{ route('patient.destroy', $patient->id) }}"
   onclick="event.preventDefault();
            if (confirm('Are you sure you want to delete this patient?')) {
                document.getElementById('delete-patient-{{ $patient->id }}').submit();
            }">
    <i class="fas fa-user-xmark fa-xs"></i>
</a>

<form id="delete-patient-{{ $patient->id }}" action="{{ route('patient.destroy', $patient->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

    </div>
    @endforeach
    </div>
    
    <center>
        <div class="navigation">
            <button id="prevBtn" class="btn small-btn"><i class="fa-solid fa-chevron-left"></i></button>
            <span id="pageNumber" class="page-number" style="font-size: 12px; font-weight: bold;"><strong>1</strong></span>
            <button id="nextBtn" class="btn small-btn"b><strong><i class="fa-solid fa-chevron-right"></i></strong></button>
        </div>
    </center>

</div>
    <script src="https://kit.fontawesome.com/bd4523f78c.js" crossorigin="anonymous"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="js/main_1.js"></script>
    <script src="js/patients.js"></script>

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
