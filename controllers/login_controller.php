<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../models/login_model.php'); // Include the model for database operations

    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS);
    $loginPassword = filter_var($_POST['loginPassword'], FILTER_SANITIZE_SPECIAL_CHARS);

    // Call the login function from the model
    $loginResult = login($phone, $loginPassword);

    if ($loginResult['success']) {
        // Redirect with a success message
        $_SESSION['alert'] = array('type' => 'success', 'message' => 'Login successful.');
        header("Location: ../user-profile.php");
        exit();
    } else {
        // Redirect with an error message
        $_SESSION['alert'] = array('type' => 'error', 'message' => $loginResult['message']);
        header("Location: ../login.php");
        exit();
    }
}
?>
