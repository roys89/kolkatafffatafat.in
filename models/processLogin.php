<?php

require_once 'database.php';
require_once 'LoginController.php';

$loginController = new LoginController($conn);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    $result = $loginController->loginUser($phone, $password);

    if ($result === "Login successful.") {
        // Redirect to user-profile.php on successful login
        header("Location: ../user-profile.php");
        exit();
    } else {
        echo $result; // Send other responses (e.g., error messages) to the client
    }
}

?>
