<?php
    $login = filter_var(trim($_post['login']), FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_post['pass']), FILTER_SANITIZE_STRING);

    if(mb_strlen($login)) < 5 || (mb_strlen($login)) > 90 {
        echo "Недопустимая длина логина";
        exit();
    }
?>
