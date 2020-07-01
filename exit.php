<?php
    setcookie("user", $user['name_user'], time() - 3600 * 10 , "/");
    $url = 'http://podaite.std-946.ist.mospolytech.ru/index.php';
    header("$url");
?>