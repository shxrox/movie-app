<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="contact_us.css">
    <title>Contact Us</title>
</head>
<body>
<?php include('header.php')  ?>

    <h1>Contact Us</h1>

    <?php
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection
        $servername = "localhost";
        $username = "root"; 
        $password = ""; 
        $dbname = "dbmovies"; 

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind parameters
        $stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        // Set parameters and execute
        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];

        // Execute the statement
        $stmt->execute();

        // Close statement and connection
        $stmt->close();
        $conn->close();

        // Add JavaScript code to show the alert message after form submission
        echo "<script type='text/javascript'>
                alert('Thank you for your feedback!');
              </script>";
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" cols="50" required></textarea><br>
        <input type="submit" value="Submit">
    </form>

<?php include('footer.php')  ?>

</body>
</html>
