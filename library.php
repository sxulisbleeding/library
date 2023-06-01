<!DOCTYPE html>
<html>
<head>
<title>Библиотека</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="log.css" />
</head>
<body>
    <div class="container">
        <h3>Введите данные</h3>
        <form method="POST" action="show.php">
            <p>Название: <input type="text" class="name" name="name" /></p>
            <p>Год: <input type="number" class="year" name="year" /></p>
            <p>Автор: <input type="text" class="author" name="author" /></p>
            <button class="save-button" type="submit">Отправить</button>
        </form>
    </div>
</body>
</html>