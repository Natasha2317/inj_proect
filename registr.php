<!doctype html>
<html leng="EN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подайте на слово</title>
    <link rel="stylesheet" href="style.css?<?php echo time();?>">
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
    <?php
     if(!isset($_COOKIE['user'])):
    ?>
    <h2>Регистрация</h2><h2 class="warning">Ввод без пробелов!</h2>
    <div class="form">
        <form action="" method="post">
        <div class="form__name">
            <label for="name">Имя (псевдоним)</label>
            <input type="text" name="name_user" id="name" placeholder="Введите имя или псевдоним"><br>
        </div>
        <div class="form__name">
            <label for="password">Пароль</label>
            <input type="password" name="password" id="password" placeholder="Придумайте пароль"><br>
        </div>
        <div class="form__name">
            <label for="email">e-mail</label>
            <input type="email" name="email" id="email" placeholder="Введите вашу почту"><br>
        </div>
        <div class="form__name">
            <label for="status">Статус</label>
            <select name="status" id="status">
                <option value="1" name="status">Автор</option>
                <option value="2" name="status">Читатель</option>
            </select>
        </div>
        <div class="form__name_button">
            <input type="submit" value="Зарегистрировться" name ="reg" class="form__button">
        <div class="form__name_button">
            <button value="in"><a href="autorization.php">Войти</a></button>
        </div>
        <div class="form__name_button">
            <button value="in"><a href="autorization_admin.php">Войти как админ</a></button>
        </div>
        </form>
    </div>
    <?php else:
    if($_COOKIE['user'] != 'admin'){
        $url = 'http://podaite.std-946.ist.mospolytech.ru/lk.php';
    }else{
        $url = 'http://podaite.std-946.ist.mospolytech.ru/lk_admin.php';
    }
        header("Location: $url");?>
    <?php endif; ?>
    <?php
    if (isset($_POST['reg'])){

    if (isset($_POST['name_user']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['status'])){

        // Переменные с формы
        $name_user = filter_var(trim($_POST['name_user']),FILTER_SANITIZE_STRING);
        $password = filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['email']),FILTER_SANITIZE_STRING);
        $status = $_POST['status'];

        if (mb_strlen($name_user)<2 || mb_strlen($name_user)>25){
            echo "Недопустимая длина имени";
            exit;
        }
        else if (mb_strlen($password)<5 || mb_strlen($password)>20){
            echo "Недопустимая длина пароля(от 5 до 20 символов)";
            exit;
        }

        // Параметры для подключения
        $mysqli = new mysqli('std-mysql', 'std_946', 'cisco12345', 'std_946');

        if (mysqli_connect_error()){
            prinf("Соединение не установлено", mysqli_connect_error());
            exit();
        }
        $password = md5($password."dekdlmkldml");
        $query = $mysqli->query("SELECT name_user FROM users WHERE name_user='$name_user'") ;
        $user = $query->fetch_assoc();
        if ($user){
            echo "<p class='warning'>Имя ".$name_user." уже занято</p>";
            exit;
        }
            else{
                $query = $mysqli->query("SELECT email FROM users WHERE email='$email'") ;
                $user = $query->fetch_assoc();
                if ($user){
                    echo "<p class='warning'>Почта ".$email." уже зарегистрирована</p>";
                    exit;
                }
            };
            if (!$user){
                $date = date("Y-m-d H:i:s");
                $query = "INSERT INTO users VALUES (NULL, '$name_user', '$email', '$password', '$status') ";
                $mysqli->query($query);
                $query = $mysqli->query("SELECT * FROM users WHERE name_user='$name_user'") ;
                while ($row = mysqli_fetch_assoc($query)){
                    $id_user = $row['id_user'];
                    $status = $row['status'];
                }
                if ($status == 1){
                    $query = "INSERT INTO author VALUES (NULL, '$name_user', '$id_user') ";
                    $mysqli->query($query);
                }
                $query = "INSERT INTO session VALUES (NULL, '$id_user', '$date') ";
                $mysqli->query($query);

                    $url = 'http://podaite.std-946.ist.mospolytech.ru/registr.php';
                    header("Location: $url");

                    $mysqli->close();
                }
    }
}
    ?>
    </main>
</body>
</html>