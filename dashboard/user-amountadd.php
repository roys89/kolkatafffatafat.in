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
$sqlUpdateUser = "UPDATE user_data SET wallet_bal = wallet_bal + ? WHERE phone = ?";
$sqlInsertTransaction = "INSERT INTO transaction_table (user_id, transaction_amount, phone, transaction_status, credit_unicode) VALUES ((SELECT user_id FROM user_data WHERE phone = ?), ?, ?, 'success', ?)";

$stmtUpdateUser = $conn->prepare($sqlUpdateUser);
$stmtInsertTransaction = $conn->prepare($sqlInsertTransaction);

if ($stmtUpdateUser && $stmtInsertTransaction) {
    // Bind parameters for update user_data
    $stmtUpdateUser->bind_param("is", $amount, $phone);

    // Bind parameters for insert into transaction_table
    $stmtInsertTransaction->bind_param("siss", $phone, $amount, $phone, generateRandomString(10));

    // Execute the statements
    $updateUserResult = $stmtUpdateUser->execute();
    $insertTransactionResult = $stmtInsertTransaction->execute();

    // Check if both statements were successful
    if ($updateUserResult && $insertTransactionResult) {
        echo '<script>alert("Update Successful!"); window.location.href = document.referrer;</script>';
    } else {
        echo "Error updating amount or inserting transaction: " . $conn->error;
    }

    // Close the statements
    $stmtUpdateUser->close();
    $stmtInsertTransaction->close();
} else {
    echo "Error preparing statements: " . $conn->error;
}

// Close the database connection
$conn->close();

// Function to generate a random alphanumeric string
function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
?>
