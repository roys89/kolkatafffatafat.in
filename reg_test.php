<?php
// Replace these values with your actual database credentials
$servername = "localhost";
$username = "u562619669_kolkataff";
$password = "Bishnu@2024";
$dbname = "u562619669_kolkataff_live";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST["full_name"];
    $email = $_POST["email"]; // Fixed: changed () to []
    $phone = $_POST["phone"];
    $refId = $_POST["ref_id"]; // Fixed: changed () to []
    $loginPassword = $_POST["login_password"];

    // Hash the password before storing it in the database
    $hashedPassword = password_hash($loginPassword, PASSWORD_DEFAULT);

    $insert_query = "INSERT INTO user_data (full_name, email, phone, ref_id, password) VALUES (?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_query); // Fixed: changed $db to $conn
    $insert_stmt->bind_param("sssss", $fullName, $email, $phone, $refId, $hashedPassword);

    if ($insert_stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $insert_stmt->error;
    }
}

// Close connection
$conn->close();
?>
