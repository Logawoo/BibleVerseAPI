<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include ".gitignore/database.php";
global $db;

$sql = "SELECT * FROM verses";

if (isset($_GET['random']) && $_GET['random'] == 'true') {

    $sql = "SELECT * FROM verses ORDER BY RAND() LIMIT 1";

   
}else {
    // Query to select a random verse
    $sql = "SELECT * FROM verses";
    $qry = $db->query($sql)->fetchAll();
}
$stmt = $db->prepare($sql);
$stmt->execute();
$qry = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($qry);
?>