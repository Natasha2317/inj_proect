<?php
    setcookie("user", $user['name_user'], time() - 3600, "/");
    $url = 'http://localhost/a/index.php';
    header("Location: $url");
?>