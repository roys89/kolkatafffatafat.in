<?php
session_start();
include "database.php";

// Retrieve data from URL parameters
$slotId = isset($_GET['slot_id']) ? urldecode($_GET['slot_id']) : 'Default Value';
$baji = isset($_GET['baji']) ? urldecode($_GET['baji']) : 'Default Value';

// Save parameters in session
$_SESSION['slot_id'] = $slotId;
$_SESSION['baji'] = $baji;

// Check if status is not equal to 1
$stmt = $conn->prepare("SELECT baji_status FROM game_table WHERE baji = ?");
$stmt->bind_param("s", $baji);
$stmt->execute();
$stmt->bind_result($baji_status); // Replace with actual column names

// Check if there is a row with baji_status = $baji
if ($stmt->fetch()) {
    // Check if baji_status is 0
    if ($baji_status === 'close') {
        // Redirect to index.php
        header("Location: index.php");
        exit(); // Stop further execution
    } else {
        $_SESSION['baji_status'] = $baji_status;
    }
}

$stmt->close();
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
    <title> Kolkata Fatafat Live Place Bet</title>
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
  <?php
    // Create a URL with parameters to pass to the next page
    $url1 = "place_bet.php?game_type=" . urlencode('single');
    $url2 = "place_bet.php?game_type=" . urlencode('patti');
    ?>
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
    
    

    <!-- add tips begin -->
    <div class="add-tips">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-9 col-md-10">
                  <div class="section-title">
                    <h4 class="sub-title">
                     Create Bet
                    </h4>
                    <h2>Share your probable thinking</h2>
                    <!-- <p>Get probable winning tips from professional betting tipsters across  all sports<br/>
                      and offers from leading bookmakers! See how it works!</p> -->
                  </div>
                </div>
              </div>
            <div class="prediction-select-step">
                <div class="single-game first-element">
                    <div class="row justify-content-between">
                        <div class="col-xl-1 col-lg-1 col-md-2">
                            <div class="part-icon">
                                <img src="assets\img\dice.png" alt="">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4">
                            <div class="team">
                                <span class="single-team">Single</span>
                                <span class="single-team">Play Now</span>
                            </div>
                        </div>
                        <!-- <div class="col-xl-3 col-lg-3 col-md-4">
                            <div class="time">
                                <div>
                                    <span class="clock">10:30 am
                                        <span class="live-badge">LIVE</span></span>
                                    <span class="date">10/20/2024</span>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-xl-5 col-lg-5 col-md-12">
                            <div class="prediction-sheet">
                                <ul>
                                    <li>
                                        <a href="<?php echo $url1; ?>">
                                            <!-- <span class="prediction-amount">
                                               100-960
                                            </span> -->
                                            <span class="match-odds">Place Bet</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-game">
                    <div class="row justify-content-between">
                        <div class="col-xl-1 col-lg-1 col-md-2">
                            <div class="part-icon">
                            <img src="assets\img\card-game.png" alt="">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4">
                            <div class="team">
                                <span class="single-team">Patti</span>
                                <span class="single-team">Play Now</span>
                            </div>
                        </div>
                        <!-- <div class="col-xl-3 col-lg-3 col-md-4">
                            <div class="time">
                                <div>
                                    <span class="clock">10:30 am
                                        <span class="live-badge">LIVE</span></span>
                                    <span class="date">10/20/2024</span>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-xl-5 col-lg-5 col-md-12">
                            <div class="prediction-sheet">
                                <ul>
                                    <li>
                                        <a href="<?php echo $url2; ?>">
                                            <!-- <span class="prediction-amount">
                                                100-1200
                                            </span> -->
                                            <span class="match-odds">Place Bet</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- add tips end -->

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
                              <a href='www.kolkatafatafat.help/index.php/kolkataff_old_results/'>Kolkata FF Old Results</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4">
                    <div class="useful-links">
                        <h3>Connect Us</h3>
                        <ul>
                            <li>
                              <a href='www.kolkatafatafat.help/index.php/term-condition/'>Terms & Conditions
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
                              <a href='www.kolkatafatafat.help/index.php/kolkataff_tips/'>Kolkata FF Tips</a>
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
                        <a href="#">kolkatafatafat</a> © 2024. Privacy & Policy
                    </p>
                </div>
                <div class="text-right col-md-6 col-xl-4 col-lg-6 d-xl-flex d-lg-flex d-block align-items-center">
                    <p class="copyright-text">
                        Powerd By <a href="www.kolkatafatafat.help">kolkatafatafat.help</a>
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

</html>