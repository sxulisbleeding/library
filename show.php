<!DOCTYPE html>
<html>
<head>
<title>Книги</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="log.css" />
</head>
<body>
    <div class="container">
<?php 
include "db.php"; 
session_start();

if (isset($_POST["name"]) && $_POST["name"] != "" && isset($_POST["year"]) && $_POST["year"] != "" && isset($_POST["author"]) && $_POST["author"] != "") {
    
    $name = $_POST['name'];
    $year = $_POST['year'];
    $author = $_POST['author'];

    $db->beginTransaction();
    $stmt = $db->prepare("INSERT INTO a (id, name, year, author) VALUES (DEFAULT, :name, :year, :author)");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':author', $author);
    $stmt->execute();
    $db->commit();
    
    header('Location: show.php');
    exit();
}

$db = new PDO('pgsql:host=localhost; port=5432; dbname=negr', 'postgres', 'aslal');
$stmt = $db->prepare("SELECT id, name, year, author FROM a");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    echo "<h3>Все книги:</h3>";
    echo "<table>";
    echo "<tr><th>Название</th><th>Год</th><th>Автор</th></tr>";
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['year']}</td>";
        echo "<td>{$row['author']}</td>";
        echo "<td><a href='edit.php?id={$row['id']}'>Редактировать</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<h3>Нет добавленных записей</h3>";
    echo "<br>";
    echo "<p class='perexod'><a href='library.php'>Добавить книгу</a></p>";
}
?>
</div>
</body>
</html>