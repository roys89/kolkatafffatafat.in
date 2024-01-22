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

// Query to calculate the sum of bet values for a user and update wallet_bal column
$query = "UPDATE user_data
          SET wallet_bal = wallet_bal - bet
          WHERE user_id = '$user_id'";

$result = $conn->query($query);

if ($result) {
    echo "wallet_bal updated successfully.\n";

    // Query to fetch the updated wallet_bal
    $fetchQuery = "SELECT wallet_bal FROM user_data WHERE user_id = '$user_id'";
    $fetchResult = $conn->query($fetchQuery);

    if ($fetchResult) {
        $wallet_bal = $fetchResult->fetch_assoc()['wallet_bal'];
        $response = array('status' => 'success', 'wallet_bal' => $wallet_bal);
        echo "Updated wallet_bal: $wallet_bal\n";
    } else {
        $response = array('status' => 'error', 'message' => 'Error fetching wallet_bal: ' . $conn->error);
        echo "Error fetching wallet_bal: " . $conn->error . "\n";
    }
} else {
    $response = array('status' => 'error', 'message' => 'Error updating wallet_bal: ' . $conn->error);
    echo "Error updating wallet_bal: " . $conn->error . "\n";
}

// Close the database connection
$conn->close();

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
