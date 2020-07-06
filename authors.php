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
            <?php
                $user = $_COOKIE['user'];
                if($user = 'admin'){
                    echo '<a href="lk_admin.php" role="menuitem">Личный кабинет</a>';
                }else if(isset($_COOKIE['user'])){
                    echo'<a href="lk.php" role="menuitem">Личный кабинет</a>';
                }else{
                    echo'<a href="registr.php" role="menuitem">Личный кабинет</a>';
                }
            ?>
        </nav>
    </header>
    <?php
            $mysqli = new mysqli('std-mysql', 'std_946', 'cisco12345', 'std_946');

            if (mysqli_connect_error()){
                prinf("Соединение не установлено", mysqli_connect_error());
                exit();
            }
                $query = $mysqli->query("SELECT * FROM author");
                echo '<h2>Наши авторы</h2>';

                while ($row = mysqli_fetch_assoc($query)){
                    echo'
                    <ul><li>'.$row['name_author'].'</li>
                    </ul>';
                }

    ?>
    </main>
    <footer></footer>
</body>
</html>