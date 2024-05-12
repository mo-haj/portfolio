<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main_1.css">
    <link rel="stylesheet" href="css/patients.css">
    <title>Krizet</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

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
       

        <div class="col-md-10 col-sm-8 middle-column" style="height:600px !important;">
            <div class="appointments-header d-flex justify-content-between align-items-center" >
                <h2>Appointments</h2>
                <a href="{{url('/appointments')}}" class="btn btn-primary new-appointment-btn" ><i class="fa-solid fa-plus" style="margin-right: 20px;"></i>New Appointment</a>
            </div>
            <!-- month slider-->
            <div class="row">
            <div class="slider-container col-3">
    <div class="slider">
        @for ($i = $currentMonth; $i <= 12; $i++)
            <div class="slide {{ $i == $currentMonth ? 'active' : '' }}" data-month="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</div>
        @endfor
    </div>
    <button class="prev-btn">&lt;</button>
    <button class="next-btn">&gt;</button>
</div>
              
                <div class="input-group col-9 ">
                   
                    <form class="search-bar" action="{{ route('searchAppointment', ['month' => $currentMonth] )}}" method="POST">
                    @csrf
                    <!-- <input type="text" id="searchName" name="searchName" class="form-control" placeholder="Search..." style="width:100%;">
                    <button class="btn searchbar new-appointment-btn" type="submit">Search</button>  -->
                    <div class="search-boxxx">
                    <input type="text" id="searchName" name="searchName" class="form-control search-txtxx" placeholder="Search..." >
                    <button class="btn searchbar search-btnxx" type="submit"><i class="fas fa-search"></i></button>
                     </div>

                    </form>
                    
                </div>
                </div>
                
<!-- Schedule -->
<div class="schedule col-lg-12 Calendar-Table appointment-row">
    
    <table>
        <thead>
            <tr>
                <th></th>
               
                <th>Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Notes</th>
                <th>Actions</th>
                
            </tr>
            
        </thead>
        <tbody id="appointmentsBody"> 
        @foreach ($appointments as $appointment)
        <tr>
<td></td>

<td>{{ $appointment->patient_name }}</td>
<td>{{ $appointment->appointment_date}}</td>
<td>{{ $appointment-> appointment_time }}</td>
<td>{{ $appointment-> Note }}</td>
<td>
    
    <a class="btn btn-sm btn-warning edit-appointment" title="Edit" data-appointment-id="{{ $appointment }}"><i class="fas fa-pen-to-square fa-xs "></i></a>
    <a class="btn btn-sm btn-danger" title="Delete" href="{{ route('appointments.destroy', $appointment->id) }}"
   onclick="event.preventDefault();
            if (confirm('Are you sure you want to delete this appointment?')) {
                document.getElementById('delete-appointment-{{ $appointment->id }}').submit();
            }">
    <i class="fas fa-user-xmark fa-xs"></i>
</a>

<form id="delete-appointment-{{ $appointment->id }}" action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
</td>
</tr>
@endforeach
  
    </tbody>
        
    </table>
    </div>
    <center>
        <div class="navigation">
            <button id="prevBtn" class="btn small-btn" ><i class="fa-solid fa-chevron-left"></i></button>
            <span id="pageNumber" class="page-number" style="font-size: 12px; font-weight: bold;">1</span>
            <button id="nextBtn" class="btn small-btn"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
    </center>

        </div>
        <div class="modal fade" id="Edit-appointment" tabindex="-1" aria-labelledby="Edit-AppointmentLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="Edit-AppointmentLabel">Settings</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal-body">
        <form id="edit-appointment-form" action="{{ route('appointmentsUpdate')}}" method="POST">
        @csrf
            <div class="btn-group d-grid">
            <div class="form-group">
                
            <label for="patients">Select patients Name</label>
            <input type="text" id="input_id" name="input_id"  style="width:50px;text-align:center;margin-right:10px;" readonly>
             <input type="text" id="patients" name="patients" style="width: 150px;margin-right:20px;" readonly>
            <!-- Add more patients here -->
        </select> </div>
                    <div class="form-group">
                    <label for="patients">Select Date:</label>
                    <div class="calendar-container" style="margin-top: 10px;">
                    <div class="calendar">
                        <input type="date" id="input_date" name="input_date">
                        <label for="input_time" style="margin-top: 10px;">Enter Time:</label>
                        <input type="time" id="input_time" name="input_time">
                        </div>
                    </div>
                   
                    </div>
                   
            </div>
            <br>
                    <!-- Text Area -->
                    <textarea id="Note" name="Note" rows="6" cols="40"></textarea>
                    <br><br>
                    
                    <button class="btn button  new-appointment-btn" type="submit" >Submit</button>
                    </form>
        </div>
        
    </div>
</div>
</div>  </div>
</div>

        <script src="https://kit.fontawesome.com/bd4523f78c.js" crossorigin="anonymous"></script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="js/main_1"></script>
        <script src="js/calendar.js"></script>

        <!--page refresh style-->
        <script src="js/jquery.min.js"></script>
        <script src="js/main.js"></script>

      
    <script>
        
//              btn next and prev as calendar pages //
// Get the previous and next button elements
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

// Add click event listener to the previous button
prevBtn.addEventListener('click', function() {
    // Check if there is a previous page available
    if ({{ $appointments->currentPage() }} > 1) {
        // Redirect to the previous page
        window.location.href = '{{ $appointments->previousPageUrl() }}';
    } else {
        // Handle case when there is no previous page available (optional)
    }
});

// Add click event listener to the next button
nextBtn.addEventListener('click', function() {
    // Check if there is a next page available
    if ({{ $appointments->hasMorePages() ? 'true' : 'false' }}) {
        // Redirect to the next page
        window.location.href = '{{ $appointments->nextPageUrl() }}';
    } else {
        // Handle case when there is no next page available (optional)
        
    }
});
// Get the current page number from the URL
const urlParams = new URLSearchParams(window.location.search);
const currentPageNumber = parseInt(urlParams.get('page')) || 1; // Default to page 1 if no page parameter is found

// Set the current page number in the pageNumber span
const pageNumberSpan = document.getElementById('pageNumber');
pageNumberSpan.textContent = currentPageNumber;

 
</script>
<script>

            //slider month //
    document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.slide');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');

    slides.forEach(slide => {
        slide.addEventListener('click', function () {
            const month = this.getAttribute('data-month');
            window.location.href = `/calendar/${month}`;
        });
    });

    prevBtn.addEventListener('click', function () {
        const currentMonth = document.querySelector('.slide.active').getAttribute('data-month');
        const prevMonth = currentMonth === '1' ? '12' : (parseInt(currentMonth) - 1).toString();
        window.location.href = `/calendar/${prevMonth}`;
    });

    nextBtn.addEventListener('click', function () {
        const currentMonth = document.querySelector('.slide.active').getAttribute('data-month');
        const nextMonth = currentMonth === '12' ? '1' : (parseInt(currentMonth) + 1).toString();
        window.location.href = `/calendar/${nextMonth}`;
    });
});

</script>


</body>
</html>