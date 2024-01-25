
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

// Validate and sanitize user input here

// Build the SQL query
$sql = "UPDATE game_table
        SET patti_result = '$column1'
        WHERE baji = '$userChoice'";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Result Added");</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?> 