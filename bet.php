<?php
session_start();
// Your bet placing page content goes here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Bet</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['full_name']; ?>! Place your bet here.</h2>
    <!-- Your bet placing form and content go here -->
</body>
</html>
