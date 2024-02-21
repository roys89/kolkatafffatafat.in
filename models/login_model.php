<?php
require_once('../database.php');

function login($phone, $loginPassword) {
    global $conn;

    $response = array('success' => false, 'message' => '');

    $stmt = $conn->prepare("SELECT user_id, full_name, hashed_password, user_status FROM user_data WHERE phone = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $stmt->bind_result($user_id, $full_name, $hashed_password, $user_status);

    if ($stmt->fetch()) {
        if (password_verify($loginPassword, $hashed_password)) {
            if ($user_status === 'active') {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['full_name'] = $full_name;
                $_SESSION['phone'] = $phone;
                $_SESSION['login_time'] = time();

                $response['success'] = true;
                $response['message'] = "Login successful. Redirecting...";
            } else {
                $response['message'] = "User account is not active.";
            }
        } else {
            $response['message'] = "Invalid password.";
        }
    } else {
        $response['message'] = "Invalid phone number.";
    }

    // Implement a delay to thwart brute-force attacks
    sleep(2);

    $stmt->close();
    $conn->close();

    // Display alerts and reload the page using JavaScript
    echo '<script>';
    echo 'alert("' . $response['message'] . '");';
    echo 'window.location.reload();';
    echo '</script>';
    
    // Exit to prevent further execution
    exit();
}
?>
