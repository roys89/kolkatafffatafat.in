<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">
  
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kolkata Fatafat Live - Place Bet</title>
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
    <link rel="stylesheet" href="assets/css/style.css">
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
                <a class='mobile-logo' href='https://kolkatafatafat.help/'>
                  <img src="assets/img/logo.png" alt="">
                  Kolkata Fatafat
                </a>
              </div>
              <div class="col-4 d-flex align-items-center justify-content-end">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="bars" role="img" xmlns="http://https://w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-bars fa-w-14 fa-fw fa-2x"><path fill="currentColor" d="M442 114H6a6 6 0 0 1-6-6V84a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6zm0 160H6a6 6 0 0 1-6-6v-24a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6zm0 160H6a6 6 0 0 1-6-6v-24a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6z" class=""></path></svg>
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
                                          <a class='nav-link' href='https://kolkatafatafat.help/index.php/ff_lucky_number/'>FF Lucky Number</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class='nav-link' href='https://kolkatafatafat.help/index.php/kolkataff_tips/'>Kolkata FF Tips</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class='nav-link' href='https://kolkatafatafat.help/index.php/kolkataff_old_results/'>Kolkata FF Old Results</a>
                                        </li>
                                      </ul>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 d-xl-block d-lg-block d-none">
                                      <div class="space"></div>
                                    </div>
                                    <div class="col-xl-5 col-lg-5">
                                      <ul class="navbar-nav">
                                        <li class="nav-item">
                                          <a class='nav-link' href='https://kolkatafatafat.help/index.php/kolkataff_patti-list/'>Kolkata FF Patti List</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class='nav-link' href='https://kolkatafatafat.help/index.php/term-condition/'>Terms & Conditions
                                          </a>
                                        </li>
                                        <li class="nav-item dropdown">
                                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          User
                                          </a>
                                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class='dropdown-item' href='login.php'>Login</a>
                                            <a class='dropdown-item' href='registration.php'>Sign up</a>
                                          </div>
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
      <h1>Received Data:</h1>
    <p>Parameter 1: <?php echo $slot_id; ?></p>
    <p>Parameter 2: <?php echo $baji; ?></p>
    <p>Parameter 3: <?php echo $game_type; ?></p>
    <!-- breadcrumb begin -->
    <div class="breadcrumb-betipsta">
        <img class="shape" src="assets/img/statics/statics-bg.png" alt="">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7">
                    <div class="part-text">
                        <h2 class="title">Contact us</h2>
                        <ul>
                            <li>
                                <a href='index.html'>Home</a>
                            </li>
                            <li>
                                Contact us
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

    <!-- contact begin -->
    <div class="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-10">
                  <div class="section-title">
                    <h4 class="sub-title">
                      Contact With Us
                    </h4>
                    <h2>Get in touch with Authority</h2>
                    <p>Get probable winning tips from professional betting tipsters across  all sports<br/>
                      and offers from leading bookmakers! See how it works!</p>
                  </div>
                </div>
              </div>
            <div class="row no-gutters">
                <div class="col-xl-12 col-lg-12 col-md-12">
                <button class="add-btn" onclick="addForm()">Add More</button>
                    <div class="contact-form" id="formContainer">
                        <form class="dynamic-form" onsubmit="submitForm(event)">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <label for="fullName">Amount</label>
                                    <input type="number" id="amount" name="amount" placeholder="Enter the bet amount">
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <label for="phoneNo">Number</label>
                                    <input type="number" id="bet_number" name="bet_number" placeholder="Enter the number you want to bet on">
                                </div>
                            </div>
                            <button class="submit-btn" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact end -->

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
                        <a href="#">kolkatafatafat</a> © 2024. Privacy & Policy
                    </p>
                </div>
                <div class="text-right col-md-6 col-xl-4 col-lg-6 d-xl-flex d-lg-flex d-block align-items-center">
                    <p class="copyright-text">
                        Powerd By <a href="https://kolkatafatafat.help">kolkatafatafat.help</a>
                    </p>
                </div>
            </div>
        </div>
      </div>
      <!-- copyright footer end -->
    <script>
      function addForm() {
        // Clone the template form
        var templateForm = document.querySelector('.dynamic-form');
        var newForm = templateForm.cloneNode(true);

        // Clear the input values in the cloned form
        newForm.reset();

        // Append the cloned form to the container
        document.getElementById('formContainer').appendChild(newForm);
      }

      function submitForm(event) {
        event.preventDefault();

        // Get the form data
        var formData = new FormData(event.target);

        // Get three PHP variables from the page
        var slot_id = '<?php echo $slot_id; ?>'; // Replace with your actual PHP variable
        var baji = '<?php echo $baji; ?>'; // Replace with your actual PHP variable
        var game_type = '<?php echo $game_type; ?>'; // Replace with your actual PHP variable

        // Append PHP variables to the form data
        formData.append('slot_id', slot_id);
        formData.append('baji', baji);
        formData.append('game_type', game_type);

        // Perform an asynchronous request to your PHP script (replace 'your_script.php' with the actual script)
        fetch('bet_submit.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // assuming the PHP script returns JSON
        .then(data => console.log(data))
        .catch(error => console.error('Error:', error));
      }
    </script>

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