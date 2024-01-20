<?php
// Handle the form submission and database storage
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'];
    $bet_number = $_POST['bet_number'];

    // Extract URL parameters
    $slotId = $_POST['slot_id'];
    $baji = $_POST['baji']; 
    $gameType = $_POST['game_type']; 

    include "database.php";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO bet_table (amount, bet_number, slot_id, baji, game_type) VALUES ('$amount', '$bet_number', '$slotId', '$baji', '$gameType')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Data inserted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $sql . '<br>' . $conn->error]);
    }

    $conn->close();
}
?>
