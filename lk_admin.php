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
            <a href="lk_admin.php" role="menuitem"><span class="visually-hidden">Текущий пункт:</span>Админ</a>
        </nav>
    </header>
    <main>

        <div>
        <form class="lk_menu" method="post">
            <input type="submit" value="Все стихи" name ="admin_my_poem" class="form__button">
            <input type="submit" value="Пользователи" name ="admin_count_user" class="form__button">
            <div class="form__name_button">
                <button><a href="exit.php">Выйти</a></button>
            </div>
        </form>
        </div>
        <?php
            if(isset($_POST['admin_my_poem'])):
        ?>
        <?php
            $mysqli = new mysqli('localhost', 'root', '', 'my_bd');

            if (mysqli_connect_error()){
                prinf("Соединение не установлено", mysqli_connect_error());
                exit();
            }
            $name_session = $_COOKIE['user'];
            $query = $mysqli->query("SELECT * FROM poems JOIN author ON poems.id_author=author.id_author");
            echo '<h2>Все стихотворения</h2>';

            while ($row = mysqli_fetch_assoc($query)){
                echo'
            <div class="my_poems">
                <h3>'.$row['name_poem'].'</h3><br>
                <pre><p>'.$row['text_poem'].'</p></pre><br>
                <p>'.$row['name_author'].'</p>
                <div class="form__name_button">
                <button><a href="edit.php?id=<?= $my_id_poem ?>">Изменить</a></button>
                <button><a href="delete.php?id=<?= $my_id_poem ?>">Удалить</a></button>
            </div>
            </div>'; }?>
    <?php else:
                echo ''; ?>
    <?php endif; ?>

    <?php if(isset($_POST['admin_count_user']) && !isset($_POST['admin_my_poem'])): ?>
    <?php
            $mysqli = new mysqli('localhost', 'root', '', 'my_bd');

            if (mysqli_connect_error()){
                prinf("Соединение не установлено", mysqli_connect_error());
                exit();
            }
            $query = $mysqli->query("SELECT name_user, email, name_status FROM status JOIN users
            ON (status.id_status=users.status)");
            echo '<h2>Данные</h2>';

            echo'<table><tr>
                <td>Имя польз.</td>
                <td>Email</td>
                <td>Статус</td>
                </tr>';

            while ($row = mysqli_fetch_assoc($query)){
                echo'
                <tr><td>'.$row['name_user'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['name_status'].'</td>
                </tr>';}
            echo'</table>';
        $query = $mysqli->query("SELECT count(name_user)FROM users");
        while ($row = mysqli_fetch_assoc($query)){
                echo '<p class="itog marg">Общее количество пользователей сайта: '.$row['count(name_user)'].'</p><br>';
                } ;
        $query = $mysqli->query("SELECT count(id_poem)FROM poems");
        while ($row = mysqli_fetch_assoc($query)){
                echo '<p class="itog">Общее количество стихов: '.$row['count(id_poem)'].'</p>';
                };

            ?>
    <?php else:
                echo ''; ?>
    <?php endif; ?>
    </main>
</body>
</html>