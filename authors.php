<!doctype html>
<html leng="EN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css?<?php echo time();?>">
  	<link href="https://fonts.googleapis.com/css?family=PT+Sans|Playfair+Display+SC" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="nav-menu" role="menubar">
            <a href="index.php" aria-current="page" role="menuitem">Главная</a>
            <a href="category.php" role="menuitem">Категории</a>
            <a href="authors.php" role="menuitem">Авторы</a>
            <a href="registr.php" role="menuitem"><span class="visually-hidden">Текущий пункт:</span>Личный кабинет</a>
        </nav>
    </header>
    <?php
            $mysqli = new mysqli('localhost', 'root', '', 'my_bd');

            if (mysqli_connect_error()){
                prinf("Соединение не установлено", mysqli_connect_error());
                exit();
            }
                $query = $mysqli->query("SELECT * FROM author");
                echo '<h2>Наши авторы</h2>';

                while ($row = mysqli_fetch_assoc($query)){
                    echo'
                    <ul><li>'.$row['name_author'].'</li>
                    </ul>';}

         // выводим сообщение об ошибке
?>
    </main>
</body>
</html>