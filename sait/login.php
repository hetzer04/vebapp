<?php
    require "../sait/db.php";

    $data = $_post;
    if(isset($data['do_login']))
    {
        $errors = array();
        $user = R::findOne('users', 'login = ?', array($data['login']));
        if($user)
        {
            if(password_verify($data['password'], $user->password))
            {
                $_SESSION['logged_user'] = $user;
                echo '<div style="color:green;">вы вошли</div><hr>';
            }else
            {
                $errors[] = 'Пароль не верен';
            }
        }else
        {
            $errors[] = 'Пользователь с таким логином не найден';
        }
        if( ! empty($errors))
        {
            echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
        }
    }

?>

<form action="login.php" method="POST">
    <p>
        <strong>Ваш логин</strong><br>
        <input type="text" name="login" value='<?php echo @$data['login'];?>'>
    </p>
    <p>
        <strong>Ваш пароль</strong><br>
        <input type="password" name="password" value='<?php echo @$data['password'];?>'>
    </p>
    <p>
        <button type="submit" name="do_login">Войти</button>
    </p>
</form>