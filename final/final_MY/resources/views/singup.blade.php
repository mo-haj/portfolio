<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.png">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/main_1.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
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

    <div class="wrapper">
        <div class="logo">
            <img src="img/test-login.png" style="width: auto;" alt="">
        </div>
        <div class="text-center mt-4 name">
            Krizet
        </div>
         <form class="p-3 mt-3" action="{{ route('register') }}" method="POST">
            @csrf
           
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="text" name="name" id="name" title="FullName" placeholder="Full Name">
            </div>
            
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="tel" name="number" id="number" title="Phone" placeholder="Syrian Phone Number">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="email" name="email" id="email" title="Email" placeholder="Email">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="password" title="Password"  placeholder="Password">
            </div>
          
            <button type="submit" class="btn mt-3">Signup</button>
        </form>

        <div class="text-center fs-6">
            <a href="#">Forget password?</a> or <a href="{{url('/')}}">Login</a>
        </div>
    </div>
    <!--page refresh style-->
    <script src="js/jquery.min.js"></script>
        <script src="js/main.js"></script> 
        <script src="js/registor.js"></script>
        <script src="js/phone-10.js"></script>

        <script>
         
        </script>
</body>
</html>