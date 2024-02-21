<?php
include 'database.php';
session_start(); // Add this line to start the session

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generate a random user_id with 8 characters
    $user_id = bin2hex(random_bytes(8)); // 4 bytes = 8 characters

    // Assuming that the $_POST variables are set

    // Sanitize full name
    $fullName = filter_var($_POST["full_name"], FILTER_SANITIZE_SPECIAL_CHARS);

    // Sanitize email
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    // Validate and sanitize phone (remove non-numeric characters)
    $phone = filter_var($_POST["phone"], FILTER_SANITIZE_NUMBER_INT);
    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        echo '<script>alert("Invalid phone number format!");</script>';
        exit();
    }

    // Sanitize login password and confirm password (assuming they are both strings)
    $loginPassword = filter_var($_POST["login_password"], FILTER_SANITIZE_SPECIAL_CHARS);
    $confirmPassword = filter_var($_POST["c_password"], FILTER_SANITIZE_SPECIAL_CHARS);

    // You may also want to trim the sanitized values to remove leading and trailing spaces
    $fullName = trim($fullName);
    $email = trim($email);
    $phone = trim($phone);
    $loginPassword = trim($loginPassword);
    $confirmPassword = trim($confirmPassword);

    $user_status = 'active';

    if ($loginPassword !== $confirmPassword) {
        echo '<script>alert("Passwords do not match!");</script>';
        exit();
    }

    $hashedPassword = password_hash($loginPassword, PASSWORD_DEFAULT);

    $check_query = "SELECT user_id FROM user_data WHERE phone = ?";
    $check_stmt = $conn->prepare($check_query);

    if ($check_stmt) {
        $check_stmt->bind_param("s", $phone);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            echo '<script>alert("Mobile number or email is already in use!");</script>';
        } else {
            $insert_query = "INSERT INTO user_data (user_id, full_name, email, phone, hashed_password, password, user_status) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_query);

            if ($insert_stmt) {
                $insert_stmt->bind_param("sssssss", $user_id, $fullName, $email, $phone, $hashedPassword, $loginPassword, $user_status);

                if ($insert_stmt->execute()) {
                    $_SESSION['user_id'] = $user_id;
                    echo '<script>alert("Registration successful!");</script>';
                } else {
                    echo "Error during registration: " . $insert_stmt->error;
                }

                $insert_stmt->close();
            } else {
                echo "Error preparing registration statement: " . $conn->error;
            }
        }

        $check_stmt->close();
    } else {
        echo "Error preparing check statement: " . $conn->error;
    }

}

$conn->close();
?>





<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Betipstar - Prediction Tips and Tipster HTML Template</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- fontawesome icon  -->
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <!-- flaticon css  -->
    <link rel="stylesheet" href="assets/fonts/flaticon.css">
    <!-- animate.css -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <!-- stylesheet -->
    <link rel="stylesheet" href="assets/css/style1.css">
    <!-- responsive -->
    <link rel="stylesheet" href="assets/css/responsive.css">
  </head>
  <body data-spy="scroll" data-target="#navbar" data-offset="0">

    <!-- preloader begin -->
    <div class="preloader">
        <img src="assets/img/preloader.gif" alt="">
    </div>
    <!-- preloader end -->

     <!-- header begin -->
     <div class="header">
        <div class="header-top">
          <div class="container">
            <div class="row justify-content-between">
              <div class="col-xl-5 col-lg-5 col-md-7">
                <div class="support-info">
                  <ul>
                    <li>
                      <span class="icon">
                        <i class="far fa-envelope"></i>
                      </span>
                      <span class="text">
                        
                      </span>
                    </li>
                    <li>
                      <span class="icon">
                        <i class="fas fa-phone"></i>
                      </span>
                      <span class="text">
                       
                      </span>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-xl-2 col-lg-2 d-xl-block d-lg-block d-none">
                <div class="logo">
                    <a href='index.php'>
                        <img src="assets/img/logo1.png" alt="">
                    </a>
                </div>
              </div>
              <div class="col-xl-5 col-lg-5 col-md-5">
                <div class="date">
                  <ul>
                    <li>
                      <span class="icon">
                        <i class="fas fa-calendar-alt"></i>
                      </span>
                      <span class="text">
                        <span id="date"></span>
                        <span id="month"></span>
                        <span id="year"></span>
                      </span>
                    </li>
                    <li>
                      <span class="icon">
                        <i class="fas fa-clock"></i>
                      </span>
                      <span class="text">
                        <span id="hours"></span>:<span id="minutes"></span>:<span id="seconds"></span>
                      </span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="header-bottom">
          <div class="container">
            <div class="row d-xl-none d-lg-none d-flex">
              <div class="col-8">
                <a class='mobile-logo' href='index.php'>
                  <img src="assets/img/logo.png" alt="">
                  Kolkata Fatafat
                </a>
              </div>
              <div class="col-4 d-flex align-items-center justify-content-end">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="bars" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-bars fa-w-14 fa-fw fa-2x"><path fill="currentColor" d="M442 114H6a6 6 0 0 1-6-6V84a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6zm0 160H6a6 6 0 0 1-6-6v-24a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6zm0 160H6a6 6 0 0 1-6-6v-24a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6z" class=""></path></svg>
                </button>
              </div>
            </div>
              <div class="row justify-content-center">
                  <div class="col-xl-12 col-lg-12">
                      <div class="mainmenu">
                      <nav class="navbar navbar-expand-lg">
                              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <div class="scalaction">
                                  <div class="row">
                                    <div class="col-xl-5 col-lg-5">
                                      <ul class="navbar-nav">
                                        <li class="nav-item active">
                                          <a class='nav-link' href='index.php'>Home </a>
                                        </li>
                                        <li class="nav-item">
                                          <a class='nav-link' href='https://kolkatafatafat.help/'>Result</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class='nav-link' href='login.php'>LogIn</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class='nav-link' href='registration.php'>Sign Up</a>
                                        </li>
                                      </ul>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 d-xl-block d-lg-block d-none">
                                      <div class="space"></div>
                                    </div>
                                    <div class="col-xl-5 col-lg-5">
                                      <ul class="navbar-nav">
                                        <li class="nav-item">
                                          <a class='nav-link' href='user-profile.php'>Profile</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class='nav-link' href='user-bet.php'>My Bid
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </nav>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
      <!-- header end -->

    <!-- breadcrumb begin -->
    <div class="breadcrumb-betipsta">
        <img class="shape" src="assets/img/statics/statics-bg-2.png" alt="">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7">
                    <div class="part-text">
                        <h2 class="title">Registration</h2>
                        <ul>
                            <li>
                                <a href='index.php'>Home</a>
                            </li>
                            <li>
                                Registration
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="part-img">
                        <img src="#" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- register begin -->
    <div class="register">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-9">
                  <div class="section-title">
                    <h4 class="sub-title">
                        Signup To Enter
                    </h4>
                    <h2>Create your free account</h2>
                    <p>Win your fortune with Kolkata Fatafat</p>
                  </div>
                </div>
              </div>
            <div class="reg-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <h4 class="sub-title">Personal Information</h4>
                            <input type="text" name="full_name" id="full_name" placeholder="Full Name*" require>
                            <input type="email" name="email" id="email" placeholder="Email*">
                            <input type="number" name="phone" id="phone" placeholder="Phone No:*" require>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 additional-info">
                            <h4 class="sub-title">Additional Information</h4>
                            <!-- <input type="text" name="ref_id" id="ref_id" placeholder="Your Referral ID If Any"> -->
                            <input type="password" name="login_password" id="login_password" placeholder="Password*" require>
                            <input type="password" name="c_password" id="c_password" placeholder="Confirm Password*" require>
                        </div>
                    </div>
                    <p>Already have an account ? <a href="login.php">Login</a></p>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="exampleRadios" id="exampleRadios5" value="option2" required>
                                <label class="form-check-label" for="exampleRadios5">
                                    I agree to the terms &amp; conditions.
                                </label>
                                <p>(*) We will never share your personal information with third parties.</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <button class="def-btn btn-form" type="submit">Secure Sign Up <i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- register end -->

    <!-- footer begin -->
    <div class="footer">
        <a class='site-logo' href='index.php'>
          <img src="assets/img/logo.png" alt="">
        </a>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-4 col-lg-5 col-md-10">
                    <div class="about-widget">
                        <a class='site-title' href='index.php'>
                            The Kolkata Fatafat Live
                        </a>
                        <p>Text</p>
                       
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4">
                    <div class="useful-links">
                        <h3>Useful links</h3>
                        <ul>
                            <li>
                              <a href='https://kolkatafatafat.help/index.php/kolkataff_old_results/'>Kolkata FF Old Results</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4">
                    <div class="useful-links">
                        <h3>Connect Us</h3>
                        <ul>
                            <li>
                              <a href='https://kolkatafatafat.help/index.php/term-condition/'>Terms & Conditions
                              </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4">
                    <div class="useful-links">
                        <h3>probable Tips</h3>
                        <ul>
                            <li>
                              <a href='https://kolkatafatafat.help/index.php/kolkataff_tips/'>Kolkata FF Tips</a>
                            </li>
                            <li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="payment-method">
                                <h6 class="payment-method-title">
                                    Payment methods are We accept 
                                </h6>
                                <div class="all-method">
                                    <div class="single-method">
                                        <img src="assets/img/brand-1.png" alt="">
                                    </div>
                                    <div class="single-method">
                                        <img src="assets/img/brand-2.png" alt="">
                                    </div>
                                    <div class="single-method">
                                        <img src="assets/img/brand-3.png" alt="">
                                    </div>
                                    <div class="single-method">
                                        <img src="assets/img/brand-4.png" alt="">
                                    </div>
                                    <div class="single-method">
                                        <img src="assets/img/brand-5.png" alt="">
                                    </div>
                                    
                                    <div class="single-method">
                                        <img src="assets/img/brand-5.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <!-- footer end -->

    <!-- copyright footer begin -->
    <div class="copyright-footer">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-5 col-md-6 col-lg-6 d-lg-flex d-lg-flex d-block align-items-center">
                <p class="copyright-text">
                    <a href="#">Betipstar</a> © 2020. Privacy & Policy
                </p>
            </div>
            <div class="text-right col-md-6 col-xl-4 col-lg-6 d-xl-flex d-lg-flex d-block align-items-center">
                <p class="copyright-text">
                    Powerd By <a href="https://themeforest.net/user/autworks/portfolio">Autworks ( Envato Author )</a>
                </p>
            </div>
        </div>
    </div>
    </div>
    <!-- copyright footer end -->

    <!-- jquery -->
    <script src="assets/js/jquery.js"></script>
    <!-- propper js -->
    <script src="assets/js/popper.min.js"></script>
    <!-- bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- owl carousel -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- clock js -->
    <script src="assets/js/clock.min.js"></script>
    <!-- main -->
    <script src="assets/js/main.js"></script>
    </body>

<!-- Mirrored from betipster.netlify.app/live/registration by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Jan 2024 16:58:23 GMT -->
</html>