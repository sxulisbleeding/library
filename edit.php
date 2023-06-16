<!DOCTYPE html>
<html>
<head>
<title>Книги</title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="log.css">
</head>
<body>
    <div class="container">
    <?php 
    include "db.php"; 
if (isset($_POST["id"])) {
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $year = $_POST['year'];
    $author = $_POST['author'];

    $stmt = $db->prepare("UPDATE a SET name = :name, year = :year, author = :author WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':year', $year, PDO::PARAM_INT);
    $stmt->bindParam(':author', $author);
    $stmt->execute();

    $stmt = $db->prepare("SELECT id, name, year, author FROM a WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $name = $result["name"];
        $year = $result["year"];
        $author = $result["author"];
        $id = $result["id"];

        echo "<form method='POST' action='show.php'>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo "<p>Название: <input type='text' name='name' value='$name'></p>";
        echo "<p>Год: <input type='number' name='year' value='$year'></p>";
        echo "<p>Автор: <input type='text' name='author' value='$author'></p>";
        echo "<button class='save-button'>Сохранить изменения</button>";
        echo "</form>";
        echo "<br>";
        echo "<a href='delete.php?id={$id}'>Удалить запись</a>";
    } else {
        echo "<h3>Запись не найдена</h3>";
    }
} elseif (isset($_GET["id"])) {
    
    $db = new PDO('pgsql:host=localhost; port=5432; dbname=negr', 'postgres', 'aslal');

    $stmt = $db->prepare("SELECT id, name, year, author FROM a WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $name = $result["name"];
        $year = $result["year"];
        $author = $result["author"];
        $id = $result["id"];

        echo "<form method='POST' action='update.php'>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo "<p>Название: <input type='text' class='name' name='name' value='$name'></p>";
        echo "<p>Год: <input type='number' class='year' name='year' value='$year'></p>";
        echo "<p>Автор: <input type='text' class='author' name='author' value='$author'></p>";
        echo "<button class='save-button'>Сохранить изменения</button>";
        echo "</form>";
        echo "<br>";
        echo "<a href='delete.php?id={$id}'>Удалить запись</a>";
    } else {
        echo "<h3>Запись не найдена</h3>";
    }
} else {
    echo "<h3>Не указан идентификатор записи</h3>";
}
?>
</div>
</body>
</html>