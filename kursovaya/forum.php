<?php if(!defined('SEC')){die('Нет доступа');}

// Создание темы
if($_REQUEST['action'] === 'add_topic' && $GLOBALS['currentUser']){

    $time = time();

    $sql = "INSERT INTO F_topic (name, countMessages, userId, dateCreate) VALUES ('{$_REQUEST['name']}', 
                         '0', '{$GLOBALS['currentUser']['id']}',
        '".time()."');";

    $result = mysqli_query($conn, $sql);

   // d($GLOBALS['currentUser']); exit();
   // d(mysqli_error($conn));  exit();
    die(header('location: /'.PROJECT.'/'));


}

//Список тем
$result = $conn->query("SELECT * FROM F_topic");

//Если темы есть

$topicList = [];
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $topicList[] = $row;
    }
}

//Список пользователей
$result = $conn->query("SELECT * FROM F_user");

$userList = [];
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $userList[$row['id']] = $row;
    }
}
?>



<!DOCTYPE html>

<html lang="ru"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Форум - темы</title>
    <link rel="stylesheet" href="forum_styles.css">
</head>
<body>
<?php include PATH.'/header.php'?>
<div class="wrapper">
    <div class="sidebar_left"></div>
    <div class="content">
        <h1>Форум</h1>
        <table>
            <thead>
            <tr>
                <th>Название темы</th>
                <th>Кол. сообщений</th>
                <th>Автор</th>
                <th>Дата создания</th>
                <th>Посл. ответ</th>
                <th>Дата ответа</th>
            </tr>
            </thead>
            <tbody>
            <tr>
               <?php foreach($topicList as $topic):?>
                    <tr>
                        <td><a class="forum_href" href="#"><?=$topic['name']?></a></td>
                        <td><a class="forum_href" href="#"><?=$topic['countMessages']?></a></td>
                        <td><a class="forum_href" href="#"><?=$userList[$topic['userId']]['name']?></a></td>
                        <td><?=date('d-m-Y H:i:s', $topic['dateCreate'])?></td>
                        <td><?=$userList[$topic['replyUserId']]['name']?></td>
                        <td><?=date('d-m-Y H:i:s', $topic['dateReply'])?></td>
                    </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <?php if($GLOBALS['currentUser']):?>
        <table class="reply_form">
            <thead>
            <tr>
                <th>Создать новую тему</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <form class="message_form" action="/<?=PROJECT?>/?page=forum&action=add_topic" method="post">
                        <input type="text" name="name" placeholder="Название темы">
                        <textarea name="message" placeholder="Напишите сообщение"></textarea>
                        <input type="submit" name="create" value="Создать">
                    </form>
                </td>
            </tr>
            </tbody>
        </table>
        <?php endif?>
    </div>
    <div class="sidebar_right"></div>
</div>

</body></html>