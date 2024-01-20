<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Form Repeat</title>
</head>
<body>

<div id="formContainer">
    <!-- Initial form -->
    <form class="dynamic-form" onsubmit="submitForm(event)">
        <!-- Your form fields go here -->
        <label for="name">Amount:</label>
        <input type="text" name="amount" required>
        <br>
        <label for="email">Number:</label>
        <input type="text" name="bet_number" required>
        <br>
        <button type="submit">Submit</button>
    </form>
</div>

<button onclick="addForm()">Add Form</button>

<script>
    function addForm() {
        // Clone the template form
        var templateForm = document.querySelector('.dynamic-form');
        var newForm = templateForm.cloneNode(true);

        // Clear the input values in the cloned form
        newForm.reset();

        // Append the cloned form to the container
        document.getElementById('formContainer').appendChild(newForm);
    }

    function submitForm(event) {
        event.preventDefault();

        // Get the form data
        var formData = new FormData(event.target);

        // Perform an asynchronous request to your PHP script (replace 'your_script.php' with the actual script)
        fetch('bet_submit.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // assuming the PHP script returns JSON
        .then(data => console.log(data))
        .catch(error => console.error('Error:', error));
    }
</script>

</body>
</html>
