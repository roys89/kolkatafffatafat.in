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

// Update the user's amount in the database, replace 'amount_column' with the actual column name in your user table
$sql = "UPDATE user_data SET amount = amount + $amount WHERE phone = $phone";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Update Successful!"); window.location.href = document.referrer;</script>';
} else {
    echo "Error updating amount: " . $conn->error;
}

// Close the database connection
$conn->close();
?>