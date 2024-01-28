<?php
// Retrieve parameters from the URL
$tran_id = $_GET['tran_id'] ?? '';
$phone = $_GET['phone'] ?? '';
$debit_amount = isset($_GET['debit_amount']) ? (int)$_GET['debit_amount'] : 0; // Ensure it's an integer
$status = $_GET['status'] ?? '';

// Check if status is 'approved' or 'rejected'
if ($status === 'approved' || $status === 'rejected') {
    // Include your database connection file
    include '../database.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $updateStatusQuery = $conn->prepare("UPDATE transaction_debit SET debit_status = ? WHERE trandr_id  = ?");
    $updateStatusQuery->bind_param("si", $status, $tran_id);
    $updateStatusQuery->execute();

    // Check if status is 'approved' to update wallet balance and credit
    if ($status === 'approved') {
        // Use prepared statements to prevent SQL injection
        $updateWalletQuery = $conn->prepare("UPDATE user_data SET wallet_bal = wallet_bal - ?, debit = debit + ? WHERE phone = ?");
        $updateWalletQuery->bind_param("ddi", $debit_amount, $debit_amount, $phone);
        $updateWalletQuery->execute();

        // Close the prepared statement for updating wallet balance and credit
        $updateWalletQuery->close();
    }

    // Close the prepared statement for updating transaction status and the database connection
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
