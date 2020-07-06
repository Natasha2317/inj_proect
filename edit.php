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
            <a href="registr.php" role="menuitem">Личный кабинет</a>
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
            if( isset($_POST['button']) && $_POST['button']== 'Изменить запись'){

            $name_p = $_POST['name_poem'];
            $text_p = $_POST['text_poem'];
            $get_id = $_GET['id'];

            $query = $mysqli->query("UPDATE poems SET name_poem='$name_p', text_poem='$text_p' WHERE id_poem='$get_id'");
            }

        $currentROW=array(); // информации о текущей записи пока нет
        // если id текущей записи передано
        if( isset($_GET['id']) ) // (переход по ссылке или отправка формы)
        {
            $get_id = $_GET['id'];
            if ($name_session === 'admin'){
                $query = $mysqli->query("SELECT * FROM poems JOIN author ON poems.id_author=author.id_author WHERE id_poem='$get_id'");
                $currentROW=mysqli_fetch_row($query);
            }else{
            // выполняем поиск записи по ее id
            $query = $mysqli->query("SELECT * FROM poems JOIN author ON poems.id_author=author.id_author WHERE id_poem='$get_id' and name_author='$name_session'");
            $currentROW=mysqli_fetch_row($query); }// информация сохраняется
            }
        if( !$currentROW ) // если информации о текущей записи нет или она некорректна
        {
            if ($name_session === 'admin'){
                $query = $mysqli->query("SELECT * FROM poems JOIN author ON poems.id_author=author.id_author");
                $currentROW=mysqli_fetch_row($query);
            }
            else{
            // берем первую запись из таблицы и делаем ее текущей
            $query = $mysqli->query("SELECT * FROM poems JOIN author ON poems.id_author=author.id_author and name_author='$name_session'");
            $currentROW=mysqli_fetch_row($query);}
        }
        // формируем и выполняем запрос для получения требуемых полей всех записей таблицы
        $query = $mysqli->query("SELECT * FROM poems JOIN author ON poems.id_author=author.id_author");
        if($query) // если запрос успешно выполнен
        {
            while( $row=mysqli_fetch_row($query) ) // перебираем все записи выборки
            {
                // если текущая запись пока не найдена и её id не передан
                // или передан и совпадает с проверяемой записью
            if($currentROW[0]==$row[0])
                // значит в цикле сейчас текущая запись
                echo '<div class="header_poem">'.$row[0].' | '.$row[1].'</div>'; // и выводим её в списке
            else // если проверяемая в цикле запись не текущая
                // формируем ссылку на неё
                echo '<div class="header_poem"><a href="?p=edit&id='.$row[0].'">'.$row[0].'</a> | '.$row[1].'</div><br>';
        }
        // вспомогательные для выбора пола переменные

        if( $currentROW ) // если есть текущая запись, т.е. если в таблице есть записи
        {
            // формируем HTML-код формы
            echo '<div class="form">
            <fieldset>
            <form name="form_edit" method="post" action="?p=edit&id='.$currentROW[0].'">
            <div class="form__name">
                <label for="name_poem">Название</label>
                <input type="text" name="name_poem" id="name_poem" value="'.
                $currentROW[1].'" required autofocus></div>
            <div class="form__name">
                <div></div>
                <textarea name="text_poem" id="text_poem" placeholder="Стихотворения">'.
                $currentROW[3].'</textarea><br>
            <div class="form__name_button">
                <button type="submit" name="button" value="Изменить запись">Изменить запись</button>
            </form></fieldset></div></div>';
        }
        else echo 'Записей пока нет';
        mysqli_close($mysqli);
    }
    else // если запрос не может быть выполнен
        echo 'Ошибка базы данных';
         // выводим сообщение об ошибке
?>
<footer></footer>
</main>
</body>
</html>