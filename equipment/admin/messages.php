<?
    session_start();
    if($_SESSION['auth_admin'] == "yes_auth")
    {
    define('myeshop',true);
    if (isset($_GET["logout"]))
    {
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
    }
    
    $_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='messages.php' >Сообщения</a>";
    include("include/db_connect.php");
    include("include/functions.php");
    $id = clear_string($_GET["id"]);
    $action = $_GET["action"];
    if (isset($action))
    {
        switch ($action) {
            case 'accept':
            $update = mysql_query("UPDATE feedback SET confirmed='yes' WHERE id='$id'");
            break;
            case 'delete':
            $delete = mysql_query("DELETE FROM feedback WHERE id = '".$id."'");
            break;
        }
    }
    $sort = $_GET["sort"];
    switch($sort){
        case 'all-messages':
        $sort = " id DESC";
        $sort_name = 'Все';
        break;
        case 'confirmed':
        $sort = " confirmed = 'yes' DESC";
        $sort_name = 'Прочитанные';
        break;
        case 'no-confirmed':
        $sort = " confirmed = 'no' DESC";
        $sort_name = 'Непрочитанные';
        break;
        default:
        $sort = " id DESC";
        $sort_name = 'Все';
        break;
    }
?>
<!DOCTYPE HTML>
<html>
<head>

	<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="jquery_confirm/jquery_confirm.css" rel="stylesheet" type="text/css" />   
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="jquery_confirm/jquery_confirm.js"></script>
	<title>Панель Управления</title>
</head>

<body>
<div id="block-body">
<?
    include("include/block-header.php");
    
    $all_count = mysql_query("SELECT * FROM feedback");
    $all_count_result = mysql_num_rows($all_count);
    
    $yes_count = mysql_query("SELECT * FROM feedback WHERE confirmed = 'yes'");
    $yes_count_result = mysql_num_rows($yes_count);
    
    $no_count = mysql_query("SELECT * FROM feedback WHERE confirmed = 'no'");
    $no_count_result = mysql_num_rows($no_count);
?>
<div id="block-content">
<div id="block-parametersT">
<ul id="options-list">
<li>Сортировать</li>
<li><a id="select-links" href="#"><? echo $sort_name; ?></a>
<ul id="list-links-sort">
<li><a href="messages.php?sort=all-messages"><strong>Все</strong></a></li>
<li><a href="messages.php?sort=confirmed"><strong>Прочитанные</strong></a></li>
<li><a href="messages.php?sort=no-confirmed"><strong>Непрочитанные</strong></a></li>
</ul>
</li>
</ul>
</div>
<div id="block-infoO">
<ul id="review-info-count">
<li>Всего сообщений - <strong><? echo $all_count_result; ?></strong></li>
<li>Прочитанных - <strong><? echo $yes_count_result; ?></strong></li>
<li>Непрочитанных - <strong><? echo $no_count_result; ?></strong></li>
</ul>
</div>
<?
$result = mysql_query("SELECT * FROM feedback ORDER BY $sort");
if(mysql_num_rows($result) > 0)
{
    $row = mysql_fetch_array($result);
    do{
        echo '
        <div class="block-messages">
        <p class="message-datetime" >'.$row["date"].'</p>';
        if ($row["confirmed"] == 'yes')
        {
            $status = '<span class="green">Прочитано</span>';
            echo '
        <p class="message-email" ><strong>'.$row["email"].'</strong> - '.$status.'</p>
        <p class="message-links" ><a class="delete" rel="messages.php?id='.$row["id"].'&action=delete" >Удалить</a></p>
        ';
        }else
        {
            $status = '<span class="red">Не прочитано</span>';
            echo '
        <p class="message-email" ><strong>'.$row["email"].'</strong> - '.$status.'</p>
        <p class="message-links" ><a class="green" href="messages.php?id='.$row["id"].'&action=accept" >Прочитать</a> | <a class="delete" rel="messages.php?id='.$row["id"].'&action=delete" >Удалить</a></p>';
        }
        $reason = $row["reason"];
        switch($reason){
        case 'non':
            $topic = 'Без темы';
        break;
        case 'er':
            $topic = 'Найдена ошибка!';
        break;
        case 'help':
            $topic = 'Требуется помощь';
        break;
        case 'pz':
            $topic = 'Пожелания';
        break;
        }
        echo '
        <ul>
        <li><strong>E-mail</strong> - '.$row["email"].'</li>
        <li><strong>ФИО</strong> - '.$row["name"].'</li>
        <li><strong>Телефон</strong> - '.$row["number"].'</li>
        <li><strong>IP</strong> - '.$row["ip"].'</li>
        <li><strong>Дата сообщения</strong> - '.$row["date"].'</li> 
        <li><strong>Тема сообщения</strong> - '.$topic.'</li> 
        <li><strong>Текст сообщения</strong>: <br>'.$row["message"].'</li> 
        </ul>
        </div>  
        ';
    }while ($row = mysql_fetch_array($result));
}


?>
</div>
</div>
</body>
</html>
<?php
}else
{
    header("Location: login.php"); 
}
?>
