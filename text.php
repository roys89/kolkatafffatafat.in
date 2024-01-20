<?php
// Replace these with your actual database connection details
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "your_dbname";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch games from the database
$sql = "SELECT game_id, season, teams, baji, status, slot_id FROM games";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<table id="game_table">
    <tr>
        <th>Game</th>
        <th>Teams</th>
        <th>Action</th>
    </tr>
    <?php while ($game = $result->fetch_assoc()): ?>
        <tr data-game-id="<?= $game['game_id'] ?>" data-season="<?= $game['season'] ?>" data-baji="<?= $game['baji'] ?>" data-status="<?= $game['status'] ?>" data-slot-id="<?= $game['slot_id'] ?>">
            <td><?= $game['game_id'] ?></td>
            <td><?= $game['teams'] ?></td>
            <td><button class="place-bet-btn">Place Bet</button></td>
        </tr>
    <?php endwhile; ?>
</table>

