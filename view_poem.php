<?php
            $mysqli = new mysqli('localhost', 'root', '', 'my_bd');

            if (mysqli_connect_error()){
                prinf("Соединение не установлено", mysqli_connect_error());
                exit();
            }
            $name_session = $_COOKIE['user'];
            $query = $mysqli->query("SELECT * FROM poems JOIN author ON poems.id_author=author.id_author WHERE name_author='$name_session'");
            echo '<h2>Мои стихотворения</h2>';

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