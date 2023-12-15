<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verse Data</title>
    <link rel="stylesheet" href="styles/logStyles.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <h1>Edit Verse Data</h1>
    <div id="verseInfo"></div>

    <div id="edit-container">
        <?php
        include "dbthings.php";
        $verses = getVerses();
        //echo $verses;

        // putting each verse into fields for easy editing
        foreach ($verses as $verse) {
            echo "<form method='post' action='dbthings.php'>";
            echo "<input type='hidden' name='verseID' value='{$verse['verseID']}'>";
            echo "<input type='text' name='book' value='{$verse['book']}'>";
            echo "<input type='text' name='chapter' value='{$verse['chapter']}'>";
            echo "<input type='text' name='verseNum' value='{$verse['verseNum']}'>";
            echo "<input type='text' name='verse' value='{$verse['verse']}'>";
            echo "<input type='submit' id='btn1' name='saveChanges' value='Save Edit'>";
            echo "</form>";
        }
        ?>
    </div>
    <div id="add-container">
        <!-- Form for adding a whole new verse -->    
        <form method="post" action="dbthings.php">
            <label for="book">Book:</label>
            <input type="text" name="book" id="book">
            <label for="chapter">Chapter:</label>
            <input type="number" name="chapter" id="chapter">
            <label for="verseNum">Verse Number:</label>
            <input type="text" name="verseNum" id="verseNum">
            <label for="verse">Verse:</label>
            <input type="text" name="verse" id="verse">
            <input type="submit" id="btn2" name="addVerse" value="Add Verse">
        </form>
    </div>
</body>

</html>

<?php




?>