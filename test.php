<?php
// Generate a random user_id with 15 characters (alphanumeric)
$user_id = bin2hex(random_bytes(8)); // 8 bytes = 16 characters


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random User ID</title>
</head>
<body>

    <h1>Your Random User ID:</h1>
    <p><?php echo $user_id; ?></p>

</body>
</html>
