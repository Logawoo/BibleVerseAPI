<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include ".gitignore/database.php";
global $db;

// Check if both apiKey and userID are set in the URL
if (isset($_GET['userID']) && isset($_GET['apiKey'])) {
    $userID = $_GET['userID'];
    $apiKey = $_GET['apiKey'];
    

    // Preparing SQL statement
    $stmt = $db->prepare("SELECT * FROM users WHERE userID = :userID AND apiKey = :apiKey");

    // Binding the parameters to statement
    $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
    $stmt->bindParam(':apiKey', $apiKey, PDO::PARAM_STR);
    

    // Executing the statement
    $stmt->execute();

    // Json based on result
    if ($stmt->rowCount() > 0) {
        $success = "Valid";
        echo json_encode($success);
    } else {
        $error = "Invalid";
        echo json_encode($error);
    }
} else {
    $message = "User ID and API Key required";
    echo json_encode($message);
}

?>



