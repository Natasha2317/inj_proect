<!doctype html>
<html leng="EN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="lk.css?<?php echo time();?>">
      <link href="https://fonts.googleapis.com/css?family=PT+Sans|Playfair+Display+SC" rel="stylesheet">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.0/css/bulma.css" rel="stylesheet">
      <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
</head>
<body>
    <header>
        <nav class="nav-menu" role="menubar">
            <a href="index.php" aria-current="page" role="menuitem">Главная</a>
            <a href="category.php" role="menuitem">Категории</a>
            <a href="authors.php" role="menuitem">Авторы</a>
            <?php
                if(isset($_COOKIE['user']) == 'admin'){
                    echo '<a href="lk_admin.php" role="menuitem">Личный кабинет</a>';
                }else if(isset($_COOKIE['user'])){
                    echo'<a href="lk.php" role="menuitem">Личный кабинет</a>';
                }else{
                    echo'<a href="registr.php" role="menuitem">Личный кабинет</a>';
                }
            ?>
        </nav>
    </header>
    <main>
        <div>
        <form class="lk_menu" method="post">
            <div class="form__name_button">
                <button><a href="#" onclick="history.back();">Назад</a></button>
            </div>
            <div class="form__name_button">
                <button><a href="exit.php">Выйти</a></button>
            </div>
        </form>
        </div>
<?php
    $mysqli = new mysqli('std-mysql', 'std_946', 'cisco12345', 'std_946');

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
    if ($name_session = 'admin'){
    $query = $mysqli->query("SELECT * FROM poems JOIN author ON poems.id_author=author.id_author");
    }else{
    $query = $mysqli->query("SELECT * FROM poems JOIN author ON poems.id_author=author.id_author WHERE name_author='$name_session'");}
    if($query) // если запрос успешно выполнен
    {
        echo '<div id="delete_links">';
        while( $row=mysqli_fetch_row($query) ) // перебираем все записи и добавялем к ним "кнопку" удаления
        {
                // формируем список ссылок
                echo '<button class="button is-danger is-outlined"><a href="?p=delete&id='.$row[0].'">
                <span>Удалить</span>
                <span class="icon is-small">
                  <i class="fas fa-times"></i>
                </span></a>
              </button><span>'.$row[1].'</span><br><br>';
        }
        echo '</div>';
        mysqli_close($mysqli);
    }
    else // если запрос не может быть выполнен
    echo 'Ошибка базы данных'; // выводим сообщение об ошибке
?>
<footer></footer>
</main>
</body>
</html>