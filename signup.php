<?php
    require "db.php";
    
    $data = $_POST;
    if(isset($data['do_signup']) )
    {
        $errors = array();
        if(trim($data['login']) == '')
        {
            $errors[] = 'Введите логи!';
        }
        if($data['password'] == '')
        {
            $errors[] = 'Введите пароль!';
        }
        if($data['password2'] != $data['password'])
        {
            $errors[] = 'Повторный пароль введен не верно!';
        }
        if(R::count('users', "login = ?", array($data['login'])) > 0 )
        {
            $errors[] = 'Пользователь уже существует!';
        }
        if(empty($errors))
        {
            $user = R::dispense('users');
            $user->login = $data['login'];
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
            R::store($user);
            echo '<div style="color:green;">вы успешно зарегистрированы</div><hr>';
        } else
        {
            echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
        }
    }

?>

<form action="/signup.php" method="post">
    <p>
        <strong>Ваш логин</strong><br>
        <input type="text" name="login" value='<?php echo @$data['login'];?>'>
    </p>
    <p>
        <strong>Ваш пароль</strong><br>
        <input type="password" name="password" value='<?php echo @$data['password'];?>'>
    </p>
    <p>
        <strong>Повторите пароль</strong><br>
        <input type="password" name="password2" value='<?php echo @$data['password2'];?>'>
    </p>
    <p>
        <button type="submit" name="do_signup">Зарегистрироваться</button>
    </p>
</form>