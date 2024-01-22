<?php
session_start();

// Check if user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    die("User not authenticated");
}

// Retrieve user_id from session
$user_id = $_SESSION['user_id'];

// Connect to your database
include 'database.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to calculate the sum of bet values for a user and update amount column
$query = "UPDATE user_data
            SET amount = amount - bet
            WHERE user_id = '$user_id'";

$result = $conn->query($query);

if ($result) {
    // Query to fetch the updated amount
    $fetchQuery = "SELECT amount FROM user_data WHERE user_id = '$user_id'";
    $fetchResult = $conn->query($fetchQuery);

    if ($fetchResult) {
        $amount = $fetchResult->fetch_assoc()['amount'];
        $response = array('status' => 'success', 'amount' => $amount);
    } else {
        $response = array('status' => 'error', 'message' => 'Error fetching amount: ' . $conn->error);
    }
} else {
    $response = array('status' => 'error', 'message' => 'Error updating amount: ' . $conn->error);
}

// Close the database connection
$conn->close();

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
