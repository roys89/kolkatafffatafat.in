<?php
// Start or resume the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['phone'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Replace these values with your actual database credentials
include 'database.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user information from the session
$user_id = $_SESSION['user_id'];
$phone = $_SESSION['phone'];

// Get form data (example: add_amount)
$add_amount = $_POST['add_amount'] ?? '';
$selection1 = $_POST['selection1'] ?? '';

// Validate the form data (you might want to add more validation here)
if (!is_numeric($add_amount) || $add_amount < 500) {
    echo "Invalid add_amount value";
    exit();
}

// Check if wallet_bal is sufficient
$userDataQuery = $conn->prepare("SELECT wallet_bal FROM user_data WHERE phone = ?");
$userDataQuery->bind_param("i", $phone);
$userDataQuery->execute();
$userDataQuery->bind_result($wallet_bal);

if ($userDataQuery->fetch()) {
    if ($wallet_bal < $add_amount) {
        echo "Insufficient wallet balance";
        exit();
    }
} else {
    echo "User data not found";
    exit();
}

$userDataQuery->close();


// Get the current date
$currentDate = date('Y-m-d');

// Check total debit amount for the day
$totalDebitQuery = $conn->prepare("SELECT SUM(debit_amount) FROM transaction_debit WHERE phone = ? AND dr_timestamp = ?");
$totalDebitQuery->bind_param("ss", $phone, $currentDate);
$totalDebitQuery->execute();
$totalDebitQuery->bind_result($totalDebit);

if ($totalDebitQuery->fetch()) {
    // Set a maximum debit amount per day (e.g., 10000)
    $maxDebitPerDay = 10000;

    if (($totalDebit + $add_amount) > $maxDebitPerDay) {
        echo "Daily debit limit exceeded";
        exit();
    }
} else {
    echo "Failed to check daily debit limit";
    exit();
}

$totalDebitQuery->close();


// Generate a random credit_unicode value (you might want to customize this)
$credit_unicode = bin2hex(random_bytes(16));

// Insert the new transaction into the transaction_table
$insertTransactionQuery = $conn->prepare("INSERT INTO transaction_debit (user_id, phone, debit_amount, debit_status, debit_unicode, type) VALUES (?, ?, ?, 'pending', ?, ?)");
$insertTransactionQuery->bind_param("ssdss", $user_id, $phone, $add_amount, $credit_unicode, $selection1);
$insertTransactionQuery->execute();

// Check if the transaction was inserted successfully
if ($insertTransactionQuery->affected_rows > 0) {
    // Subtract add_amount from wallet_bal in user_data table
    $updateUserDataQuery = $conn->prepare("UPDATE user_data SET wallet_bal = wallet_bal - ? WHERE user_id = ?");
    $updateUserDataQuery->bind_param("di", $add_amount, $user_id);
    $updateUserDataQuery->execute();

    if ($updateUserDataQuery->affected_rows > 0) {
        // Close the prepared statement
        $updateUserDataQuery->close();

        // Close the prepared statement and the database connection
        $insertTransactionQuery->close();
        $conn->close();

        // Redirect to a success page or perform other actions
        echo '<script>alert("Transaction request submitted successfully!"); window.location.href = document.referrer;</script>';
        exit();
    } else {
        echo "Failed to update wallet balance";
    }
} else {
    echo "Failed to insert transaction";
}

// Close the prepared statement and the database connection
$insertTransactionQuery->close();
$conn->close();
?>
