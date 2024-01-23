<?php
include 'database.php';

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $phone = $_POST["phone"];
  $loginPassword = $_POST["loginPassword"];

  // Validate user credentials against the database
  $sql = "SELECT * FROM user_data WHERE phone = '$phone'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // User found, check the password
      $row = $result->fetch_assoc();
      $hashedPassword = $row["password"];

      if (password_verify($loginPassword, $hashedPassword)) {
          // Authentication successful
          echo "Login successful!";
      } else {
          // Authentication failed
          echo "Invalid username or password.";
      }
  } else {
      // User not found
      echo "Invalid username or password.";
  }
}
// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="assets/img/favicon.png" rel="icon" />
<title>Kolkata fatafat Admin Login</title>
	<link rel="canonical" href="" />
<meta name="description" content="Login and Register Form Html Template">
<meta name="author" content="harnishdesign.net">
<!-- Web Fonts
========================= -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>
<!-- Stylesheet
========================= -->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/font-awesome/css/all.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/styles-adminlogin.css">
<!-- Colors Css -->
<link id="color-switcher" type="text/css" rel="stylesheet" href="#" />
</head>
<body>
<!-- Preloader -->
<div class="preloader preloader-dark">
  <div class="lds-ellipsis">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>
<!-- Preloader End -->
<div id="main-wrapper" class="oxyy-login-register">
  <div class="container-fluid px-0">
    <div class="row g-0 min-vh-100"> 
      <!-- Welcome Text
      ========================= -->
      <div class="col-md-4">
        <div class="hero-wrap d-flex align-items-center h-100">
          <div class="hero-mask opacity-5 bg-dark"></div>
          <div class="hero-bg hero-bg-scroll" style="background-image:url('assets/img/login-bg-6.jpg');"></div>
          <div class="hero-content mx-auto w-100 h-100">
            <div class="container d-flex flex-column h-100">
              <div class="row g-0">
                <div class="col-11 col-lg-9 mx-auto">
                  <div class="logo mt-5 mb-5"> <a class="d-flex" href="#" title="kolkatafatafat"><img src="assets/img/logo-2-light.png" alt="kolkatafatafat"></a> </div>
                </div>
              </div>
              <div class="row g-0 mt-3">
                <div class="col-11 col-lg-9 mx-auto">
                  <h1 class="text-9 text-white fw-300 mb-5"><span class="fw-500">Welcome</span>, We are glad to see you again!</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Welcome Text End --> 
      <!-- Login Form
      ========================= -->
      <div class="col-md-8 d-flex flex-column align-items-center bg-dark">
        <div class="container my-auto py-5">
          <div class="row g-0">
            <div class="col-11 col-md-8 col-lg-7 col-xl-6 mx-auto">
              <h3 class="text-white mb-4">Log In to Your Account</h3>
              <div class="d-flex">
                <button type="button" class="btn btn-primary btn-sm fw-400 rounded-3 shadow-none"><span class="me-2"><i class="fab fa-google"></i></span><span class="mx-3">Log in with Google</span></button>
                <ul class="social-icons d-inline-block social-icons-rounded">
                  <li class="social-icons-apple mb-0"><a class="bg-dark-4" href="#" data-bs-toggle="tooltip" data-bs-original-title="Sign in with apple"><i class="fab fa-apple"></i></a></li>
                </ul>
              </div>
              <div class="d-flex align-items-center my-4">
                <hr class="col-1 border-secondary">
                <span class="mx-3 text-2 text-white-50">OR</span>
                <hr class="flex-grow-1 border-secondary">
              </div>
              <form id="loginForm" class="form-dark" method="post">
                <div class="mb-3">
                  <label class="form-label text-light" for="phone">Mobile Number</label>
                  <input type="text" class="form-control" id="phone" required placeholder="Enter Your Mobile Number">
                </div>
                <div class="mb-3">
                  <label class="form-label text-light" for="loginPassword">Password</label>
                  <a class="float-end text-2" href="forgot-password.html">Forgot Password ?</a>
                  <input type="password" class="form-control" id="loginPassword" required placeholder="Enter Password">
                </div>
                <button class="btn btn-primary my-2" type="submit">Log in</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Login Form End --> 
    </div>
  </div>
</div>
<!-- Script --> 
<script src="assets/js/jquery.min.js"></script> 
<script src="assets/js/bootstrap.bundle.min.js"></script> 
<!-- Style Switcher --> 
<script src="assets/js/switcher.min.js"></script> 
<script src="assets/js/theme-adminlogin.js"></script>
</html>