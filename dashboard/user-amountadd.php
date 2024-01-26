<?php
// Include your database connection file
include '../database.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user_id and amount from the form submission
$phone = $_POST['phone'];
$amount = $_POST['amount'];

// Use prepared statements to prevent SQL injection
$sql = "UPDATE user_data SET wallet_bal = amount + ? WHERE phone = ?";

$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind parameters
    $stmt->bind_param("is", $amount, $phone);

    // Execute the statement
    if ($stmt->execute()) {
        echo '<script>alert("Update Successful!"); window.location.href = document.referrer;</script>';
    } else {
        echo "Error updating amount: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
