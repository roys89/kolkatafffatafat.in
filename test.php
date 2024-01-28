<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Details</title>
</head>
<body>

<?php
include 'database.php'; // Include your database connection file

// Retrieve parameters from the URL
$tran_id = $_GET['tran_id'] ?? '';
$user_id = $_GET['phone'] ?? '';
$transaction_request = isset($_GET['transaction_request']) ? (int)$_GET['transaction_request'] : 0; // Ensure it's an integer
$status = $_GET['status'] ?? '';

// Check if status is 'approved'
if ($status === 'approved' && $tran_id && $user_id && $transaction_request !== null) {
    // Use prepared statements to prevent SQL injection
    $updateWalletQuery = $conn->prepare("UPDATE user_data SET wallet_bal = wallet_bal + ? WHERE user_id = ?");
    $updateWalletQuery->bind_param("di", $transaction_request, $user_id);
    $updateWalletQuery->execute();

    // Close the prepared statement
    $updateWalletQuery->close();

    // Fetch updated data from user_data table
    $userDataQuery = "SELECT * FROM user_data WHERE user_id = ?";
    $userDataStmt = $conn->prepare($userDataQuery);
    $userDataStmt->bind_param("i", $user_id);
    $userDataStmt->execute();
    $userDataResult = $userDataStmt->get_result();
    $userData = $userDataResult->fetch_assoc();

    // Close the prepared statement
    $userDataStmt->close();

    // Display the updated data
    echo '<h1>Transaction ID: ' . $tran_id . '</h1>';
    echo '<h1>User ID: ' . $user_id . '</h1>';
    echo '<h1>Transaction Request: ' . $transaction_request . '</h1>';
    echo '<h1>Status: ' . $status . '</h1>';
    echo '<h1>Updated Wallet Balance: ' . $userData['wallet_bal'] . '</h1>';
} else {
    // Invalid parameters or status, handle accordingly
    echo '<script>alert("Update failed!"); window.location.href = document.referrer;</script>';
}

// Close the database connection
$conn->close();
?>

</body>
</html>

