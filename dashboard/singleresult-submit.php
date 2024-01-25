<?php
// Include your database connection file
include '../database.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from the form
$userChoice = $_POST['baji'];
$column1 = $_POST['single_result'];
// Get other input fields as needed

// Validate and sanitize user input here (consider using prepared statements)

// Initialize a variable to check if both queries are successful
$success = true;

// Start a transaction
$conn->begin_transaction();

// Update game_table
$sqlGameTable = "UPDATE game_table
                 SET single_result = '$column1'
                 WHERE baji = '$userChoice'";

if (!$conn->query($sqlGameTable)) {
    $success = false;
}

// Update user_table
$sqlUserTable = "UPDATE user_table
                 SET wallet_bal = wallet_bal + (9 * amount)
                 WHERE user_id IN (
                     SELECT user_id
                     FROM bet_table
                     WHERE bet_number = '$column1' AND baji = '$userChoice'
                 )";

if (!$conn->query($sqlUserTable)) {
    $success = false;
}

// Commit the transaction if both queries are successful, otherwise, rollback
if ($success) {
    $conn->commit();
    echo '<script>alert("Result Added");</script>';
} else {
    $conn->rollback();
    echo "Error: " . $sqlGameTable . "<br>" . $conn->error;
    echo "Error: " . $sqlUserTable . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
