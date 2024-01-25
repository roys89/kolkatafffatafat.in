<?php
// Connect to the database (assuming your connection logic is in a separate file)
include '../database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the selected user_id and status from the form
    $phone = $_POST['phone'];
    $status = $_POST['status'];

    // Validate and sanitize the inputs if needed

    // Update user status in the user_data table
    $updateQuery = "UPDATE user_data SET user_status = ? WHERE phone = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ss", $status, $phone);
    
    if ($stmt->execute()) {
        echo '<script>alert("Registration successful!");</script>';
        header("Location: dashboard/forms-basic.php");
    } else {
        echo "Error updating user status: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
