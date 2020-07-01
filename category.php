<!doctype html>
<html leng="EN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="lk.css?<?php echo time();?>">
      <link href="https://fonts.googleapis.com/css?family=PT+Sans|Playfair+Display+SC" rel="stylesheet">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.0/css/bulma.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="nav-menu" role="menubar">
            <a href="index.php" aria-current="page" role="menuitem">Главная</a>
            <a href="category.php" role="menuitem">Категории</a>
            <a href="authors.php" role="menuitem">Авторы</a>
            <?php
                if(!isset($_COOKIE['user'])):
            ?>
            <a href="registr.php" role="menuitem">Личный кабинет</a>
            <?php else: ?>
            <a href="lk.php" role="menuitem">Личный кабинет</a>
            <?php endif; ?>        
        </nav>
    </header>
        <div>
        <form class="lk_menu" method="post">
            <input type="submit" value="Любовь" name ="Любовь" class="form__button">
            <input type="submit" value="Женщина" name ="Женщина" class="form__button">
            <input type="submit" value="Природа" name ="Природа" class="form__button">
            <input type="submit" value="Жизнь" name ="Жизнь" class="form__button">
            <input type="submit" value="Война" name ="Война" class="form__button">
            <input type="submit" value="Дружба" name ="Дружба" class="form__button">
            <input type="submit" value="Семья" name ="Семья" class="form__button">
            <input type="submit" value="Мама" name ="Мама" class="form__button">
            <input type="submit" value="Общество" name ="Общество" class="form__button">
            <input type="submit" value="Без категории" name ="Без категории" class="form__button"><br>
        </form>
        </div>
        <?php
            $mysqli = new mysqli('std-mysql', 'std_946', 'cisco12345', 'std_946');
            $category = 0;

            if (mysqli_connect_error()){
                prinf("Соединение не установлено", mysqli_connect_error());
                exit();
            }
            if (isset($_POST['Любовь'])){
                $category = 1;
            }
            if (isset($_POST['Женщина'])){
                $category = 2;
            }
            if (isset($_POST['Природа'])){
                $category = 3;
            }
            if (isset($_POST['Жизнь'])){
                $category = 4;
            }
            if (isset($_POST['Война'])){
                $category = 5;
            }
            if (isset($_POST['Дружба'])){
                $category = 6;
            }
            if (isset($_POST['Семья'])){
                $category = 7;
            }
            if (isset($_POST['Мама'])){
                $category = 8;
            }
            if (isset($_POST['Общество'])){
                $category = 9;
            }
            if (isset($_POST['Без категории'])){
                $category = 10;
            }
            $query = $mysqli->query("SELECT * FROM poems_category JOIN poems ON (poems.id_poem=poems_category.id_poem) 
            JOIN author ON (poems.id_author=author.id_author) WHERE id_category='$category'");

            while ($row = mysqli_fetch_assoc($query)){
                echo'
            <div class="my_poems">
                <h3>'.$row['name_poem'].'</h3><br>
                <pre><p>'.$row['text_poem'].'</p></pre><br>
                <p>'.$row['name_author'].'</p>
            </div><hr>';}
            $mysqli->close();
    ?>
    </main>
</body>
</html>