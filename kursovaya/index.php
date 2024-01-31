<?php

function d($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
//Безопасность
define('SEC', 1);
define('PATH', __DIR__);

//Создание сессии
session_start();


//Соединение с БД
include PATH.'/config.php';

//Проверка авторизации
$GLOBALS['currentUser'] = [];
if($_SESSION['login']){
    //Получение пользователя
    $result = $conn->query("SELECT * FROM F_user WHERE login = '{$_SESSION['login']}'");

    if($result->num_rows > 0){
        if($row = $result->fetch_assoc()){

            $GLOBALS['currentUser'] = $row;

            //d($GLOBALS['currentUser']);
        }
    }
}


$path = explode("\\", PATH);

define('PROJECT', end($path));



//Выход
if($_REQUEST['action'] === 'logout'){
    unset($_SESSION['login']);
    unset($_SESSION['password']);

    die(header('location:/'.PROJECT.'/?path=forum&message=reg_success'));
}


//Форум
if(!$_REQUEST['page'] || $_REQUEST['page'] === 'forum'){
    include PATH.'/forum.php';
    exit;
}

//Тема
if(!$_REQUEST['page'] || $_REQUEST['page'] === 'topic'){
    include PATH.'/topic.php';
    exit;
}

//Регистрация
if($_REQUEST['page'] === 'registration'){
    include PATH.'/registrarion.php';
    exit;
}

//Авторизация
if($_REQUEST['page'] === 'auth'){
    include PATH.'/auth.php';
    exit;
}

//Пустая страница
if(!$_REQUEST['page'] == ''){
    include PATH.'/forum.php';
    exit;
}
?>




