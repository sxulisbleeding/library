<!DOCTYPE html>
<html>
<head>
<title>Библиотека</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="log.css" />
</head>
<body>
    <div class="container">
<?php
if (isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["year"]) && isset($_POST["author"])) {
    $db = new PDO('pgsql:host=localhost; port=5432; dbname=negr', 'postgres', 'aslal');

    $stmt = $db->prepare("UPDATE a SET name = :name, year = :year, author = :author WHERE id = :id");
    $stmt->bindParam(':id', $_POST['id']);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':year', $_POST['year']);
    $stmt->bindParam(':author', $_POST['author']);
    $stmt->execute();

    header('Location: show.php');
    exit();
    
} 
    
?>
 <a href="show.php">Вернуться в каталог</a>
 </div>
</body>
</html>