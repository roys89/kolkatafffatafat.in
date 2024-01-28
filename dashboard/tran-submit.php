<?php
// Retrieve parameters from the URL
$tran_id = $_GET['tran_id'] ?? '';
$user_id = $_GET['user_id'] ?? '';
$transaction_request = isset($_GET['transaction_request']) ? (int)$_GET['transaction_request'] : 0; // Ensure it's an integer
$status = $_GET['status'] ?? '';

// Check if status is 'approved'
if ($status === 'approved') {
    // Include your database connection file
    include '../database.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $updateWalletQuery = $conn->prepare("UPDATE user_data SET wallet_bal = wallet_bal + ? WHERE user_id = ?");
    $updateWalletQuery->bind_param("di", $transaction_request, $user_id);
    $updateWalletQuery->execute();

    $updateStatusQuery = $conn->prepare("UPDATE transaction_table SET transaction_status = 'approved' WHERE tran_id = ?");
    $updateStatusQuery->bind_param("i", $tran_id);
    $updateStatusQuery->execute();

    // Close the prepared statements and the database connection
    $updateWalletQuery->close();
    $updateStatusQuery->close();
    $conn->close();

    // Redirect to a success page or perform other actions
    echo '<script>alert("Update Successful!"); window.location.href = document.referrer;</script>';
    exit();
} else {
    // Invalid parameters or status, handle accordingly
    echo '<script>alert("Update failed!"); window.location.href = document.referrer;</script>';
    exit();
}
?>
