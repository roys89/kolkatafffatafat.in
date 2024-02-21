<?php

require_once '../database.php';
require_once '../controllers/login_controller.php';

$loginController = new LoginController($db);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    $result = $loginController->loginUser($phone, $password);

    echo $result;
}

?>
