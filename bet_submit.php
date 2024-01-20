<?php
// Handle the form submission and database storage
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'];
    $email = $_POST['bet_number'];

    // Extract URL parameters
    $slot_id = $_POST['slot_id']; // replace 'url_param1' with the actual parameter name
    $baji = $_POST['baji']; // replace 'url_param2' with the actual parameter name
    $game_type = $_POST['game_type']; // replace 'url_param1' with the actual parameter name


    include "database.php";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO bet_table (amount, bet_number, slot_id, baji, game_type) VALUES ('$amount', '$email', '$slot_id', '$baji', $game_type')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Data inserted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $sql . '<br>' . $conn->error]);
    }

    $conn->close();
}
?>
