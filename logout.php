<?php

require_once 'controllers/login_controller.php';

$loginController = new LoginController($db);
$loginController->logoutUser();

?>
