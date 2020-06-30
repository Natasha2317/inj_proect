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
            <input type="submit" value="Добавить новый стих" name ="add_poem" class="form__button">
            <input type="submit" value="Посмотреть мои стихи" name ="my_poem" class="form__button">
            <div class="form__name_button">
                <button><a href="exit.php">Выйти</a></button>
            </div>
        </form>
        </div>
        <?php
            if(isset($_POST['add_poem'])):
        ?>
        <div class="add">
        <h2>Добавление своего стихотворения</h2>
        <div class="form-poem">
        <form action="" method="post">
            <div class="form__name">
                <label for="name">Название</label>
                <input type="text" name="name_poem" id="name" placeholder="введите название"><br>
            </div>
            <div class="form__name">
                <label for="name">Текст</label>
                <textarea name="text_poem" id="text" placeholder="введите текст стихотворения"></textarea><br>
            </div>
            <div class="form__name">
                <label for="category">Категория</label>
                <select name="category" id="category">
                    <option value="1" name="category">Любовь</option>
                    <option value="2" name="category">Женщина</option>
                    <option value="3" name="category">Природа</option>
                    <option value="4" name="category">Жизнь</option>
                    <option value="5" name="category">Война</option>
                    <option value="6" name="category">Дружба</option>
                    <option value="7" name="category">Семья</option>
                    <option value="8" name="category">Мама</option>
                    <option value="9" name="category">Общество</option>
                    <option value="10" name="category">Без категории</option>
                </select>
            </div>
            <div class="form__name">
                <div></div>
                <input type="submit" value="отправить" name="add_poem" class="form__button">
            </div>
        </form>
        </div>
    </div>
    <?php
        if (isset($_POST['name_poem']) && isset($_POST['text_poem'])){

        // Переменные с формы
        $name_poem = $_POST['name_poem'];
        $text_poem = $_POST['text_poem'];
        $category = $_POST['category'];
        $name_user = $_COOKIE['user'];

        // Параметры для подключения
        $mysqli = new mysqli('localhost', 'root', '', 'my_bd');

        if (mysqli_connect_error()){
            prinf("Соединение не установлено", mysqli_connect_error());
            exit();
        }
        $query = $mysqli->query("SELECT * FROM author WHERE name_author='$name_user'") ;
        $id_author = '';
                while ($row = mysqli_fetch_assoc($query)){
                    $id_author = $row['id_author'];
                }
        $query = "INSERT INTO poems VALUES (NULL, '$name_poem', '$id_author', '$text_poem')";
        $mysqli->query($query);
        $query = $mysqli->query("SELECT * FROM poems WHERE id_author='$id_author'") ;
        $id_poem = '';
                while ($row = mysqli_fetch_assoc($query)){
                $id_poem = $row['id_poem'];
                }
        if ($category == 1){
                $query = "INSERT INTO poems_category VALUES (NULL, '$id_poem', 1) ";
                $mysqli->query($query);
        }else
        if ($category == 2){
            $query = "INSERT INTO poems_category VALUES (NULL, '$id_poem', 2) ";
            $mysqli->query($query);
        }else
        if ($category == 3){
            $query = "INSERT INTO poems_category VALUES (NULL, '$id_poem', 3) ";
            $mysqli->query($query);
        }
        else
        if ($category == 4){
            $query = "INSERT INTO poems_category VALUES (NULL, '$id_poem', 4) ";
            $mysqli->query($query);
        }
        else
        if ($category == 5){
            $query = "INSERT INTO poems_category VALUES (NULL, '$id_poem', 5) ";
            $mysqli->query($query);
        }
        else
        if ($category == 6){
            $query = "INSERT INTO poems_category VALUES (NULL, '$id_poem', 6) ";
            $mysqli->query($query);
        }
        else
        if ($category == 7){
            $query = "INSERT INTO poems_category VALUES (NULL, '$id_poem', 7) ";
            $mysqli->query($query);
        }
        else
        if ($category == 8){
            $query = "INSERT INTO poems_category VALUES (NULL, '$id_poem', 8) ";
            $mysqli->query($query);
        }
        else
        if ($category == 9){
            $query = "INSERT INTO poems_category VALUES (NULL, '$id_poem', 9) ";
            $mysqli->query($query);
        }
        else
        if ($category == 10){
            $query = "INSERT INTO poems_category VALUES (NULL, '$id_poem', 10) ";
            $mysqli->query($query);
        }
        $mysqli->close();
        $url = 'http://localhost/a/lk.php';
        header("Location: $url");
    }
    ?>
    <?php else:
                echo ''; ?>
    <?php endif; ?>

    <?php if(isset($_POST['my_poem']) && !isset($_POST['add_poem'])):
            require 'view_poem.php'; ?>
    <?php else:
        echo ''; ?>
    <?php endif; ?>
    </main>
</body>
</html>