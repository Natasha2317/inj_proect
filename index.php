<!--
$query = "INSERT INTO poems VALUES (NULL, 'loss','ffggggg','Потонула деревня в ухабинах') ";

    $mysqli->query($query);

    $query = $mysqli->query('SELECT * FROM poems');

    while ($row = mysqli_fetch_assoc($query)){
        echo $row['name_poem'].'<br><pre>'.$row['text_poem'].'</pre><br>'.$row['author_poem'].'<br>';
    } -->
<!doctype html>
<html leng="EN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css?<?php echo time();?>">
  	<link href="https://fonts.googleapis.com/css?family=PT+Sans|Playfair+Display+SC" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="nav-menu" role="menubar">
            <a href="index.php" aria-current="page" role="menuitem"><span class="visually-hidden">Текущий пункт:</span>Главная</a>
            <a href="category.php" role="menuitem">Категории</a>
            <a href="authors.php" role="menuitem">Авторы</a>
            <a href="registr.php" role="menuitem">Личный кабинет</a>
        </nav>
    </header>
    <main>
        <img class="my_img" src="img/подайте3.png" alt="фон">
        <style>.my_img {
            width: 100%;
            height: auto;
            }
        </style>
    <?php

    if (isset($_POST['name_poem']) && isset($_POST['text']) && isset($_POST['author'])){

        // Переменные с формы
        $name_poem = $_POST['name_poem'];
        $text = $_POST['text'];
        $author = $_POST['author'];

        // Параметры для подключения
        $mysqli = new mysqli('localhost', 'root', '', 'my_bd');

        if (mysqli_connect_error()){
            prinf("Соединение не установлено", mysqli_connect_error());
            exit();
        }
        $query = "INSERT INTO poems VALUES (NULL, '$name_poem','$author', '$text') ";
        $mysqli->query($query);

        $query = $mysqli->query('SELECT * FROM poems ');

        while ($row = mysqli_fetch_assoc($query)){
            echo $row['name_poem'].'<br><pre>'.$row['text_poem'].'</pre><br>'.$row['author_poem'].'<br>';
        }

        $mysqli->close();
    }
    ?>
    </div>
    </main>
</body>
</html>


