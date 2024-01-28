<?php

// Retrieve parameters from the URL
$tran_id = $_GET['tran_id'] ?? null;
$user_id = $_GET['user_id'] ?? null;
$transaction_request = $_GET['transaction_request'] ?? null;
$status = $_GET['status'] ?? null;
?>

<h1><?php echo $tran_id; ?></h1>

<h1><?php echo $user_id; ?></h1>

<h1><?php echo $transaction_request; ?></h1>

<h1><?php echo $status; ?></h1>