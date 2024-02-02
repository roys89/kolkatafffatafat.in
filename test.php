<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Time Display</title>
    <script src="script.js" defer></script>
</head>
<body>
    <h1>Server Time:</h1>
    <p id="server-time"></p>


    <script>document.addEventListener('DOMContentLoaded', function() {
    // Fetch server time from a server-side script (e.g., PHP)
    fetch('test2.php')
        .then(response => response.json())
        .then(data => {
            // Update the HTML element with the server time
            document.getElementById('server-time').textContent = data.serverTime;
        })
        .catch(error => {
            console.error('Error fetching server time:', error);
        });
});
</script>
</body>
</html>