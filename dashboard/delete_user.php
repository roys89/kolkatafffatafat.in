<?php
include '../database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    // Perform the deletion
    $delete_query = "DELETE FROM user_data WHERE user_id = ?";
    $delete_stmt = $conn->prepare($delete_query);

    if ($delete_stmt) {
        $delete_stmt->bind_param("s", $userId);

        if ($delete_stmt->execute()) {
            echo 'User deleted successfully.';
        } else {
            echo 'Error deleting user: ' . $delete_stmt->error;
        }

        $delete_stmt->close();
    } else {
        echo 'Error preparing delete statement: ' . $conn->error;
    }

    $conn->close();
}
?>
