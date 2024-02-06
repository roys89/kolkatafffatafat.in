<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Server Time Display</title>
</head>
<body>

<div id="serverTime"></div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  // Make an AJAX request to the PHP script
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      // Parse the JSON response
      var response = JSON.parse(xhr.responseText);
      
      // Display the server time
      document.getElementById("serverTime").innerText = "Server Time: " + response.serverTime;
    }
  };
  xhr.open("GET", "test2.php", true);
  xhr.send();
});
</script>

</body>
</html>
