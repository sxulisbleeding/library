<?php 
include "db.php"; 
session_start();

if (isset($_GET['id'])) {
    
    $stmt = $db->prepare("DELETE FROM a WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();

    header('Location: show.php');
    exit();
}

?>