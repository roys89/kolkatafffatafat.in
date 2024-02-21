<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Include FontAwesome script if not already included -->
    <!-- <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script> -->
</head>
<body>

    <form id="loginForm" action="models/processLogin.php" method="post">
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <button class="def-btn btn-form" type="submit">Login<i class="fas fa-arrow-right"></i></button>
        <p id="error-message"></p>
    </form>

    <script>
        function login() {
            var phone = document.getElementById('phone').value;
            var password = document.getElementById('password').value;

            // Basic client-side validation
            if (phone === "" || password === "") {
                document.getElementById('error-message').innerHTML = "Please fill in all fields.";
                return;
            }

            // Clear previous error messages
            document.getElementById('error-message').innerHTML = "";

            // Send login data to the server asynchronously
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'models/processLogin.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = xhr.responseText;
                    document.getElementById('error-message').innerHTML = response;
                    if (response === "Login successful.") {
                        // Redirect to user-profile.php on successful login
                        window.location.href = "user-profile.php";
                    } else {
                        // Optionally, you can stay on the login page on login failure
                        // window.location.href = "login.php";
                    }
                }
            };
            xhr.send("phone=" + phone + "&password=" + password);
        }
    </script>

</body>
</html>
