<?php

if(!defined('SEC')){
    die('Нет доступа');
}

//Проверка пльзователя перед регистрацией
$result = $conn->query("SELECT * FROM F_user WHERE login = '{$_REQUEST['login']}' or email = '{$_REQUEST['email']}'");

$user = [];
$loginExist = '';
$emailExist = '';
if($result->num_rows >0){
    while($row = $result->fetch_assoc()){
        $user = $row;

        if($user['login'] === $_REQUEST['login']){
            $loginExist = 'Данный логин существует!';
            die(header('location: /'.PROJECT.'/?page=registration&message=login_exists'));
        }

        if($user['email'] === $_REQUEST['email']){
            $emailExist = 'Данный email существует!';
            die(header('location: /'.PROJECT.'/?page=registration&message=email_exists'));
        }
    }
}



//Шифр пароля
$_REQUEST['password'] = md5($_REQUEST['password']);

//Регистрация
if($_REQUEST['action'] === 'registration'){
   $sql = "INSERT INTO F_user (name, login, email, password) VALUES ('{$_REQUEST['name']}', 
          '{$_REQUEST['login']}' , '{$_REQUEST['email']}', '{$_REQUEST['password']}');";

   $result = mysqli_query($conn, $sql);
   die(header('location:/'.PROJECT.'/?message=reg_success'));
}
?>


<?php include PATH.'/header.php'?>
<h1>Регистрация</h1>

<form action="/<?=PROJECT?>/?page=registration&action=registration" method="POST">
    <input type="text" name="name" value="" placeholder="Имя"><br>
    <input type="text" name="login" value="" placeholder="Логин"><br>
    <input type="text" name="email" value="" placeholder="Почта"><br>
    <input type="password" name="password" value="" placeholder="Пароль"><br>
    <input type="submit" value="Отправить">
</form>