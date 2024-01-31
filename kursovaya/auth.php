<?php if(!defined('SEC')){die('Нет доступа');}

$password = md5($_REQUEST['password']);

if($_REQUEST['action'] === 'auth'){
    $result = $conn->query("SELECT * FROM F_user WHERE login = '{$_REQUEST['login']}' and password = '{$password}'");

    $user = [];
    if($result->num_rows > 0){
        if($row = $result->fetch_assoc()){
            $user = $row;

           // print_r($user);

            $_SESSION['login'] = $user['login'];
            $_SESSION['password'] = $user['password'];
            die(header('location:/'.PROJECT.'/?path=forum&message=reg_success'));
        }
    }
}
?>





<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="index_styles.css">
    <link rel="stylesheet" href="user_form.css">
</head>
<body>
<?php include PATH.'/header.php'?>
<div class="content">
    <div class="forma">
        <p class="auth_txt">Авторизация</p>
        <form action="/<?=PROJECT?>/?page=auth&action=auth" method="POST">
            <input type="text" name="login" value="" placeholder="Логин"><br>
            <input type="password" name="password" value="" placeholder="Пароль"><br>
            <input class="submit_btn" type="submit" value="Отправить">
        </form>
    </div>
</div>
</body>
</html>