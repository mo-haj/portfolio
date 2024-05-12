<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.png">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main_1.css">
    <title>Krizet</title>
</head>
<body >

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

    <div class="wrapper">
        <div class="logo">
            <img src="img/test-login.png" style="width: auto;" alt="">
        </div>
        <div class="text-center mt-4 name">
            Krizet
        </div>
        <form class="p-3 mt-3"  id="loginForm" action="{{ route('login') }}" method="POST">
        @csrf
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="email" name="email" id="userName" placeholder="example@example.com" required>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password" required>
            </div>
            <button class="btn mt-3" onclick="submitLoginForm()">Login</button>
        </form>
        <div id="warningMessage" style="display: none;"></div>
        <div class="text-center fs-6">
            <a href="#">Forget password?</a> or <a href="{{ url('/singup')}}">Sign up</a>
        </div>
    </div>

     <!--page refresh style-->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="js/jquery.min.js"></script>
        <script src="js/main.js"></script> 
        <script>
    function submitLoginForm() {
        document.getElementById('loginForm').submit();
    }
</script>
<script>
    
</script>




</body>
</html>