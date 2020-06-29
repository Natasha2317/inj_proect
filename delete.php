<!doctype html>
<html leng="EN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="lk.css?<?php echo time();?>">
  	<link href="https://fonts.googleapis.com/css?family=PT+Sans|Playfair+Display+SC" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="nav-menu" role="menubar">
            <a href="index.php" aria-current="page" role="menuitem">Главная</a>
            <a href="category.php" role="menuitem">Категории</a>
            <a href="authors.php" role="menuitem">Авторы</a>
            <a href="registr.php" role="menuitem"><span class="visually-hidden">Текущий пункт:</span>Мой кабинет</a>
        </nav>
    </header>
    <main>
        <div>
        <form class="lk_menu" method="post">
            <div class="form__name_button">
                <button><a href="lk.php">Назад</a></button>
            </div>
            <div class="form__name_button">
                <button><a href="exit.php">Выйти</a></button>
            </div>
        </form>
        </div>
<?php
    $mysqli = new mysqli('localhost', 'root', '', 'my_bd');

    if (mysqli_connect_error()){
        prinf("Соединение не установлено", mysqli_connect_error());
        exit();
    }
    $name_session = $_COOKIE['user'];
    // если были переданы данные для удаления записи в таблице
    if( isset($_GET['id']))
    {
        $get_id = $_GET['id'];
        // формируем и выполняем SQL-запрос на удаление записи с указанным id
        $query = $mysqli->query("DELETE FROM poems_category WHERE id_poem='$get_id'");
        $query = $mysqli->query("DELETE FROM poems WHERE id_poem='$get_id'");
    }

    // формируем и выполняем запрос для получения требуемых полей всех записей таблицы
    $query = $mysqli->query("SELECT * FROM poems JOIN author ON poems.id_author=author.id_author WHERE name_author='$name_session'");
    if($query) // если запрос успешно выполнен
    {
        echo '<div id="delete_links">';
        while( $row=mysqli_fetch_row($query) ) // перебираем все записи и добавялем к ним "кнопку" удаления
        {
                // формируем список ссылок
                echo '<button><a class="delete_button" href="?p=delete&id='.$row[0].'">Удалить</a></button>'.$row[1].'<br>';
        }
        echo '</div>';
        mysqli_close($mysqli);
    }
    else // если запрос не может быть выполнен
    echo 'Ошибка базы данных'; // выводим сообщение об ошибке
?>

</main>
</body>
</html>