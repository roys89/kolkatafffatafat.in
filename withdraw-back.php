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

// Validate the form data (you might want to add more validation here)
if (!is_numeric($add_amount) || $add_amount <= 0) {
    echo "Invalid add_amount value";
    exit();
}

// Generate a random credit_unicode value (you might want to customize this)
$credit_unicode = bin2hex(random_bytes(16));

// Insert the new transaction into the transaction_table
$insertTransactionQuery = $conn->prepare("INSERT INTO transaction_debit (user_id, phone, debit_amount, debit_status, debit_unicode) VALUES (?, ?, ?, 'pending', ?)");
$insertTransactionQuery->bind_param("isds", $user_id, $phone, $add_amount, $credit_unicode);
$insertTransactionQuery->execute();

// Close the prepared statement and the database connection
$insertTransactionQuery->close();
$conn->close();

// Redirect to a success page or perform other actions
echo '<script>alert("Transaction request submitted successfully!"); window.location.href = "success.php";</script>';
exit();
?>
