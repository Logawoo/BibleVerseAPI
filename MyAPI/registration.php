<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <title>Document</title>
</head>
<body>
    <h1>Registration</h1>

    <!-- Registration form -->
    <div id="form-container">
        <form method="post"action="registration.php">
        <label for="id">Email:</label>
        <input type="text" name="email" id="emailfield" value="">
        <input id="button" type="submit" value="Register">
        </form>
    </div>


</body>
</html>

<?php

include '.gitignore/database.php';

// Function for making API keys
function makeApiKey() {
    $apiKey = bin2hex(random_bytes(16)); // Generates a 32-character hex string
    //echo "API Key: " . $apiKey;
    return $apiKey;
}

// Function to see if user is in table
function validateUser($email, $apiKey) {
    global $db;
    // Preparing SQL statement
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email AND apiKey = :apiKey");
    // Binding the parameters to the statement
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':apiKey', $apiKey);

    // Executing the statemtn
    $stmt->execute();
    // Return true if exists...
    return $stmt->rowCount() > 0;
}

// Checking if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $apiKey = makeApiKey();

    // Prepareing SQL statement
    $stmt = $db->prepare("INSERT INTO users (email, apiKey) VALUES (:email, :apiKey)");
    // Binding the parameters to statement
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':apiKey', $apiKey);

    // Trying to execute the statement
    try {
        $stmt->execute();

        // If user was
        if (validateUser($email, $apiKey)) {
            global $db;
            // Send back to logged in page
            header('Location: loggedin.php');
            exit;
            //echo "API Key: " . $apiKey;
            //$success = "Valid Registration";
            //echo json_encode($success);
        } else {
            // Error message
            echo "<p style='color:red'>Error adding user.</p>";
        }
        
    } catch (PDOException $e) {
        //echo "Error: ".$e->getMessage();
        echo "You did something wrong";
    }
}


?>
