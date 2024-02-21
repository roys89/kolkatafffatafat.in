<?php

session_start();

class LoginController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function loginUser($phone, $password)
    {
        // Validate input
        if (empty($phone) || empty($password)) {
            return "Please fill in all fields.";
        }

        // Check if the user exists in the database
        $stmt = $this->conn->prepare("SELECT * FROM user_data WHERE phone = ?");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (!$user || !password_verify($password, $user['hashed_password'])) {
            return "Invalid phone number or password.";
        }

        // Check for duplicate logins
        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $user['id']) {
            return "User already logged in.";
        }

        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['phone'] = $user['phone'];
        $_SESSION['full_name'] = $user['full_name']; // Assuming you have a 'full_name' field in your user_data table

        return "Login successful.";
    }

    public function logoutUser()
    {
        // Destroy the session
        session_unset();
        session_destroy();
        header("Location: ../login.php"); // Redirect to the login page
    }
}

?>
