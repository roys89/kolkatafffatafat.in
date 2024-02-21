<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('login_model.php'); // Include the model for database operations

    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS);
    $loginPassword = filter_var($_POST['loginPassword'], FILTER_SANITIZE_SPECIAL_CHARS);

    // Call the login function from the model
    $loginResult = login($phone, $login_password);

    if ($loginResult['success']) {
        header("Location: user-profile.php");
        exit();
    } else {
        echo $loginResult['message'];
    }
}
?>
