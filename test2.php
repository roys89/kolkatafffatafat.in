<?php
header('Content-Type: application/json');

// Get server time
$serverTime = date('Y-m-d H:i:s');

// Return server time as JSON
echo json_encode(['serverTime' => $serverTime]);
?>
