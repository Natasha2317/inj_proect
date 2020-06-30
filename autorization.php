<?php session_start() ?>
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
    <main>
    <?php
        if(!isset($_COOKIE['user'])):
    ?>
    <h2>Авторизация</h2>
    <div class="form">
        <form action="" method="post">
        <div class="form__name">
            <label for="name">Имя (псевдоним)</label>
            <input type="text" name="name_user" id="name" placeholder="Введите имя или псевдоним"><br>
        </div>
        <div class="form__name">
            <label for="password">Пароль</label>
            <input type="password" name="password" id="password" placeholder="Введите пароль"><br>
        </div>
        <div class="form__name_button">
            <input name="in" type="submit" value="Войти" class="form__button">
        </div>
        <div class="form__name_button">
            <button><a href="registr.php">к регистрации</a></button>
        </div>
        <div class="form__name_button">
            <button value="Войти"><a href="autorization_admin.php">Войти как админ</a></button>
        </div>
        </form>
    </div>
    <?php else:
        $url = 'http://localhost/a/lk.php';
        header("Location: $url");?>
    <?php endif; ?>
    </main>
    <?php

    if (isset($_POST['in'])){

        // Переменные с формы
        $name_user = filter_var(trim($_POST['name_user']),FILTER_SANITIZE_STRING);
        $password = filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);


        // Параметры для подключения
        $mysqli = new mysqli('localhost', 'root', '', 'my_bd');

        if (mysqli_connect_error()){
            prinf("Соединение не установлено", mysqli_connect_error());
            exit();
        }
        $password = md5($password."dekdlmkldml");
        $query = $mysqli->query("SELECT * FROM users WHERE name_user='$name_user' AND password='$password' and status=1") ;
        $user = $query->fetch_assoc();
        if (!$user) {
            echo "<p class='warning'>Такой пользователь не найден или</p><p class='warning reader'> вы читатель</p><p class='warning good'>(Приятного чтения!)</p>";
            exit;
        }
        setcookie("user", $user['name_user'], time() + 3600* 10, "/");
        $mysqli->close();
        $url = 'http://localhost/a/autorization.php';
        header("Location: $url");
    }
        ?>
    <footer></footer>
</body>
</html>