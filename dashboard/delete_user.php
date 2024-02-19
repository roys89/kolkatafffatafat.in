<?php
include '../database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Assuming you pass the user_id as a query parameter
    $userId = $_GET["user_id"];

    // Prepare and execute the SQL query to delete the user
    $delete_query = "DELETE FROM user_data WHERE user_id = ?";
    $delete_stmt = $conn->prepare($delete_query);

    if ($delete_stmt) {
        $delete_stmt->bind_param("s", $userId);

        if ($delete_stmt->execute()) {
            // Return a success message or any relevant response
            echo "User deleted successfully.";
        } else {
            // Return an error message
            echo "Error deleting user: " . $delete_stmt->error;
        }

        $delete_stmt->close();
    } else {
        // Return an error message
        echo "Error preparing delete statement: " . $conn->error;
    }
}

$conn->close();
?>
