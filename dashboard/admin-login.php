<?php
session_start();
// Check if the user is already logged in
if (isset($_SESSION['admin_id'])) {
  header("Location: admin-dashboard.php");
  exit();
}

include '../database.php';

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $adminPhone = $_POST["adminPhone"];
    $adminPass = $_POST["adminPass"];

    // Sanitize the inputs to prevent SQL injection
    $adminPhone = mysqli_real_escape_string($conn, $adminPhone);
    $adminPass = mysqli_real_escape_string($conn, $adminPass);



    // Query to retrieve user information from the database
    $query = "SELECT * FROM admin_data WHERE admin_phone='$adminPhone' AND admin_pass='$adminPass'";
    $result = $conn->query($query);

    // Check if a matching user is found
    // Check if a matching user is found
    if ($result->num_rows == 1) {
        // Authentication successful, store user information in session
        $_SESSION['admin_id'] = $username;
        $_SESSION['admin_name'] = $adminName;
        $_SESSION['admin_phone'] = $adminPhone;

        // Redirect to a secure page
        header('Location: admin-dashboard.php');
        exit;
    } else {
        // Authentication failed, redirect back to the login page with an error message
        header('Location: admin-login.php?error=1');
        exit;
    } 
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg" data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">


<head>

    <meta charset="utf-8">
    <title>Sign In Kolkata FF Live Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <meta content="Themesdesign" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Icons CSS -->
    

    

  <link rel="stylesheet" href="assets/css/tailwind2.css">
</head>

<body class="flex items-center justify-center min-h-screen px-4 py-16 bg-cover bg-auth-pattern dark:bg-auth-pattern-dark dark:text-zink-100 font-public">

    <div class="mb-0 border-none shadow-none xl:w-2/3 card bg-white/70 dark:bg-zink-500/70">
        <div class="grid grid-cols-1 gap-0 lg:grid-cols-12">
            <div class="lg:col-span-5">
                <div class="!px-12 !py-12 card-body">
                    
                    <div class="text-center">
                        <h4 class="mb-2 text-purple-500 dark:text-purple-500">Welcome Back !</h4>
                        <p class="text-slate-500 dark:text-zink-200">Sign in to continue to KOlkata FF Live.</p>
                    </div>
            
                    <form action="#!" class="mt-10"  method="POST">
                        <div class="hidden px-4 py-3 mb-3 text-sm text-green-500 border border-green-200 rounded-md bg-green-50 dark:bg-green-400/20 dark:border-green-500/50" id="successAlert">
                            You have <b>successfully</b> signed in.
                        </div>
                        <div class="mb-3">
                            <label for="username" class="inline-block mb-2 text-base font-medium">Phone Number.</label>
                            <input type="text" id="adminPhone" name="adminPhone" class="form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Enter username or email">
                            <div id="username-error" class="hidden mt-1 text-sm text-red-500">Please enter a valid Phone Number.</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="inline-block mb-2 text-base font-medium">Password</label>
                            <input type="password" id="admin_pass" name="admin_pass" class="form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Enter password">
                            <div id="password-error" class="hidden mt-1 text-sm text-red-500">Password must be at least 8 characters long and contain both letters and numbers.</div>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <input id="checkboxDefault1" class="w-4 h-4 border rounded-sm appearance-none bg-slate-100 border-slate-200 dark:bg-zink-600/50 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500 checked:disabled:bg-custom-400 checked:disabled:border-custom-400" type="checkbox" value="">
                                <label for="checkboxDefault1" class="inline-block text-base font-medium align-middle cursor-pointer">Remember me</label>
                            </div>
                            <div id="remember-error" class="hidden mt-1 text-sm text-red-500">Please check the "Remember me" before submitting the form.</div>
                        </div>
                        <div class="mt-10">
                            <button type="submit" class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Sign In</button>
                        </div>
            

                    </form>
                </div>
            </div>
            <div class="mx-2 mt-2 mb-2 border-none shadow-none lg:col-span-7 card bg-white/60 dark:bg-zink-500/60">
                <div class="!px-10 !pt-10 h-full !pb-0 card-body flex flex-col">
                    <div class="flex items-center justify-between gap-3">
                        <div class="grow">
                            <a href="index-2.html">
                                <img src="assets/images/logo-light.png" alt="" class="hidden h-6 dark:block">
                                <img src="assets/images/logo-dark.png" alt="" class="block h-6 dark:hidden">
                            </a>
                        </div>
                        <div class="shrink-0">
                            <div class="relative dropdown text-end">
                                <button type="button" class="inline-flex items-center gap-3 transition-all duration-200 ease-linear dropdown-toggle btn border-slate-200 dark:border-zink-400/60 group/items focus:border-custom-500 dark:focus:border-custom-500" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                    <img src="assets/images/us2.svg" alt="" class="object-cover h-5 rounded-full">
                                    <h6 class="text-base font-medium transition-all duration-200 ease-linear text-slate-600 group-hover/items:text-custom-500 dark:text-zink-200 dark:group-hover/items:text-custom-500">English</h6>
                                </button>
            
                                <div class="absolute z-50 hidden p-3 mt-1 text-left list-none bg-white rounded-md shadow-md dropdown-menu min-w-[9rem] flex flex-col gap-3 dark:bg-zink-600" aria-labelledby="dropdownMenuButton">
                                    <a href="#!" class="flex items-center gap-3 group/items">
                                        <img src="assets/images/us2.svg" alt="" class="object-cover h-4 rounded-full">
                                        <h6 class="text-sm font-medium transition-all duration-200 ease-linear text-slate-600 group-hover/items:text-custom-500 dark:text-zink-200 dark:group-hover/items:text-custom-500">English</h6>
                                    </a>
                                    <a href="#!" class="flex items-center gap-3 group/items">
                                        <img src="assets/images/es2.svg" alt="" class="object-cover h-4 rounded-full">
                                        <h6 class="text-sm font-medium transition-all duration-200 ease-linear text-slate-600 group-hover/items:text-custom-500 dark:text-zink-200 dark:group-hover/items:text-custom-500">Spanish</h6>
                                    </a>
                                    <a href="#!" class="flex items-center gap-3 group/items">
                                        <img src="assets/images/de2.svg" alt="" class="object-cover h-4 rounded-full">
                                        <h6 class="text-sm font-medium transition-all duration-200 ease-linear text-slate-600 group-hover/items:text-custom-500 dark:text-zink-200 dark:group-hover/items:text-custom-500">German</h6>
                                    </a>
                                    <a href="#!" class="flex items-center gap-3 group/items">
                                        <img src="assets/images/fr2.svg" alt="" class="object-cover h-4 rounded-full">
                                        <h6 class="text-sm font-medium transition-all duration-200 ease-linear text-slate-600 group-hover/items:text-custom-500 dark:text-zink-200 dark:group-hover/items:text-custom-500">French</h6>
                                    </a>
                                    <a href="#!" class="flex items-center gap-3 group/items">
                                        <img src="assets/images/jp2.svg" alt="" class="object-cover h-4 rounded-full">
                                        <h6 class="text-sm font-medium transition-all duration-200 ease-linear text-slate-600 group-hover/items:text-custom-500 dark:text-zink-200 dark:group-hover/items:text-custom-500">Japanese</h6>
                                    </a>
                                    <a href="#!" class="flex items-center gap-3 group/items">
                                        <img src="assets/images/it2.svg" alt="" class="object-cover h-4 rounded-full">
                                        <h6 class="text-sm font-medium transition-all duration-200 ease-linear text-slate-600 group-hover/items:text-custom-500 dark:text-zink-200 dark:group-hover/items:text-custom-500">Italian</h6>
                                    </a>
                                    <a href="#!" class="flex items-center gap-3 group/items">
                                        <img src="assets/images/ru2.svg" alt="" class="object-cover h-4 rounded-full">
                                        <h6 class="text-sm font-medium transition-all duration-200 ease-linear text-slate-600 group-hover/items:text-custom-500 dark:text-zink-200 dark:group-hover/items:text-custom-500">Russian</h6>
                                    </a>
                                    <a href="#!" class="flex items-center gap-3 group/items">
                                        <img src="assets/images/ae2.svg" alt="" class="object-cover h-4 rounded-full">
                                        <h6 class="text-sm font-medium transition-all duration-200 ease-linear text-slate-600 group-hover/items:text-custom-500 dark:text-zink-200 dark:group-hover/items:text-custom-500">Arabic</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-auto">
                        <img src="assets/images/img-01.png" alt="" class="md:max-w-[32rem] mx-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src='assets/libs/choices.js/public/assets/scripts/choices.min.js'></script>
    <script src="assets/libs/%40popperjs/core/umd/popper.min.js"></script>
    <script src="assets/libs/tippy.js/tippy-bundle.umd.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/prismjs/prism.js"></script>
    <script src="assets/libs/lucide/umd/lucide.js"></script>
    <script src="assets/js/tailwick.bundle.js"></script>
    <script src="assets/js/pages/auth-login.init.js"></script>

</body>

</html>