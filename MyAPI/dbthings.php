<?php
include (".gitignore/database.php");

// Gets all verses and returns them in an array
function getVerses()
{
    global $db;
    $sql = "SELECT * FROM verses";
    $qry = $db->query($sql);  // returns PDOstatement
    // var_dump($qry);
    $result = $qry->fetchAll();    

    //print_r($result);
    return $result;
}
//getUsers();

// Function to handle adding a new verse
function addNewVerse($book, $chapter, $verseNum, $verse) {
    global $db;
    // Preparing SQL statement
    $stmt = $db->prepare("INSERT INTO verses (book, chapter, verseNum, verse) VALUES (:book, :chapter, :verseNum, :verse)");
    // Binding the parameters to statement
    $stmt->bindParam(':book', $book);
    $stmt->bindParam(':chapter', $chapter);
    $stmt->bindParam(':verseNum', $verseNum);
    $stmt->bindParam(':verse', $verse);

    // Excecuting the statement
    $stmt->execute();
}

// Check if the verse is added
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book']) && isset($_POST['chapter']) && isset($_POST['verseNum']) && isset($_POST['verse'])) {
    addNewVerse($_POST['book'], $_POST['chapter'], $_POST['verseNum'], $_POST['verse']);
    //global $db;
    // Send back to the logged in page
    header('Location: loggedin.php'); 
    exit();
}



// Updates verse details in the verses table
function saveChanges($verseID, $book, $chapter, $verseNum, $verse)
{
    global $db;
    // Preparing SQL statement
    $sql = "UPDATE verses SET book = :book, chapter = :chapter, verseNum = :verseNum, verse = :verse WHERE verseID = :verseID";
    $stmt = $db->prepare($sql);
    // Binding the parameters to statement
    $stmt->bindParam(':book', $book);
    $stmt->bindParam(':chapter', $chapter);
    $stmt->bindParam(':verseNum', $verseNum);
    $stmt->bindParam(':verse', $verse);
    $stmt->bindParam(':verseID', $verseID, PDO::PARAM_INT);
    // Excecuting the statement
    $stmt->execute();
}

// Check if a verse is being updated with a post
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['saveChanges'])) {
    // take the input
    $verseID = $_POST['verseID'];
    $book = $_POST['book'];
    $chapter = $_POST['chapter'];
    $verseNum = $_POST['verseNum'];
    $verse = $_POST['verse'];

    // Saving changes to the verse
    saveChanges($verseID, $book, $chapter, $verseNum, $verse);

    // Back to the logged in page
    header('Location: loggedin.php');
    exit();
}

?>