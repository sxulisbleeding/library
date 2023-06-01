<?php
session_start();

if (isset($_GET['id'])) {
    $db = new PDO('pgsql:host=localhost; port=5432; dbname=negr', 'postgres', 'aslal');
    $stmt = $db->prepare("DELETE FROM a WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();

    header('Location: show.php');
    exit();
}

?>