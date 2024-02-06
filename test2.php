<?php
header('Content-Type: application/json');

$serverTime = date('Y-m-d H:i:s');

echo json_encode(['serverTime' => $serverTime]);
?>
