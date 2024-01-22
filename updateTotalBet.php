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

// Query to calculate the sum of bet values for a user and update total_bet column
$query = "UPDATE user_data
          SET total_bet = (
              SELECT SUM(amount) 
              FROM bet_table 
              WHERE user_id = '$user_id'
          )
          WHERE user_id = '$user_id'";

$result = $conn->query($query);

if ($result) {
    // Query to fetch the updated total bet
    $fetchQuery = "SELECT total_bet FROM user_data WHERE user_id = '$user_id'";
    $fetchResult = $conn->query($fetchQuery);

    if ($fetchResult) {
        $totalBet = $fetchResult->fetch_assoc()['total_bet'];
        $response = array('status' => 'success', 'totalBet' => $totalBet);
    } else {
        $response = array('status' => 'error', 'message' => 'Error fetching total bet: ' . $conn->error);
    }
} else {
    $response = array('status' => 'error', 'message' => 'Error updating total bet: ' . $conn->error);
}

// Close the database connection
$conn->close();

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
