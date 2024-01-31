<?php if(!defined('SEC')){die('Нет доступа');} ?>

<!DOCTYPE html>
<html lang="ru">
<link rel="stylesheet" href="styles.css">
<body>
<div class =tool_bar>
    <p class="logo">Сургутское собрание</p>
    <div class="tool_bar_a">
    <a href="/<?=PROJECT?>/">Форум</a>

    <?php if(!$_SESSION['login']):?>
        <a href="/<?=PROJECT?>/?page=auth">Авторизация</a>
        <a href="/<?=PROJECT?>/?page=registration">Регистрация</a>
    <?php else:?>
        <a href="/<?=PROJECT?>/?action=logout">Выход (<?=$_SESSION['login']?>)</a>
    <?php endif?>
    </div>
</div>
</body>
</html>