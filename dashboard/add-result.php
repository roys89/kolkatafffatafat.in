<?php
// Include your database connection file
include '../database.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function sumOfDigits($number) {
    // Convert the number to a string to iterate through each digit
    $numberAsString = (string)$number;

    // Initialize a variable to store the sum
    $sum = 0;

    // Iterate through each digit and add it to the sum
    for ($i = 0; $i < strlen($numberAsString); $i++) {
        $sum += (int)$numberAsString[$i];
    }

    // Get the last digit of the sum
    $lastDigit = $sum % 10;

    return $lastDigit;
}
// Get user input from the form
$userChoice = $_POST['baji'];
$column1 = $_POST['single_result'];
$column2 = sumOfDigits($column1);
// Get other input fields as needed

// Validate and sanitize user input here (consider using prepared statements)

// Initialize a variable to check if both queries are successful
$success = true;

// Start a transaction
$conn->begin_transaction();

// Update game_table
$sqlGameTable = "UPDATE game_table
                 SET patti_result = '$column1',
                 single_result = '$column2' 
                 WHERE baji = '$userChoice'";

if (!$conn->query($sqlGameTable)) {
    $success = false;
}

// Update user_table
$sqlUserTable = "UPDATE user_data
                 SET wallet_bal = wallet_bal + (9 * (
                     SELECT SUM(amount) AND result_status = 'Win'
                     FROM bet_table
                     WHERE bet_number = '$column1' AND baji = '$userChoice'
                 ))
                 WHERE user_id IN (
                     SELECT user_id
                     FROM bet_table
                     WHERE bet_number = '$column1' AND baji = '$userChoice'
                 )";

$sqlUserTable2 = "UPDATE user_data
                SET wallet_bal = wallet_bal + (10 * (
                    SELECT SUM(amount) AND result_status = 'Win'
                    FROM bet_table
                    WHERE bet_number = '$column2' AND baji = '$userChoice'
                ))
                WHERE user_id IN (
                    SELECT user_id
                    FROM bet_table
                    WHERE bet_number = '$column2' AND baji = '$userChoice'
                )";


if (!$conn->query($sqlUserTable)) {
    $success = false;
}
if (!$conn->query($sqlUserTable2)) {
    $success = false;
}


// Commit the transaction if both queries are successful, otherwise, rollback
if ($success) {
    $conn->commit();
    echo '<script>alert("Update Successful!"); window.location.href = document.referrer;</script>';
} else {
    $conn->rollback();
    echo "Error: " . $sqlGameTable . "<br>" . $conn->error;
    echo "Error: " . $sqlUserTable . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
