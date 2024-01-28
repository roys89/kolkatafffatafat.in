<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Details</title>
</head>
<body>

<?php

// Retrieve parameters from the URL
$tran_id = $_GET['tran_id'] ?? '';
$user_id = $_GET['user_id'] ?? '';
$transaction_request = isset($_GET['transaction_request']) ? (int)$_GET['transaction_request'] : 0; // Ensure it's an integer
$status = $_GET['status'] ?? '';
?>

<h1>Transaction ID: <?php echo $tran_id; ?></h1>

<h1>User ID: <?php echo $user_id; ?></h1>

<h1>Transaction Request: <?php echo $transaction_request; ?></h1>

<h1>Status: <?php echo $status; ?></h1>

</body>
</html>
