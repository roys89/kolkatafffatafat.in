<?php
// Handle the form submission and database storage
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'];
    $bet_number = $_POST['bet_number'];

    // Extract URL parameters
    $slot_id = $_POST['slot_id'];
    $baji = $_POST['baji']; 
    $game_type = $_POST['game_type']; 

    include "database.php";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO bet_table (amount, bet_number) VALUES ('$amount', '$bet_number')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Data inserted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $sql . '<br>' . $conn->error]);
    }

    $conn->close();
}
?>
