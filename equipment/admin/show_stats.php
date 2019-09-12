<?
    session_start();
    //Проверка авторизации
    if($_SESSION['auth_admin'] == "yes_auth")
    {
    define('myeshop',true);
    if (isset($_GET["logout"]))
    {
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
    }
    $_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='show_stats.php' >Статистика посещений</a>";
    include("include/db_connect.php");
    include("include/functions.php");
    $date = date("Y-m-d");
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
	<title>Панель Управления</title>
</head>

<body>
<div id="block-body">
<?
    include("include/block-header.php");
?>
<div id="block-content">
<div id="block-parametersT">
<ul id="options-list">
<li>Статистика посещений</li>
</ul>
</div>
<div id="block-infoO">
<ul id="review-info-countP">
<li><a class="stat" href="?interval=1">За сегодня</a></li>
<li><a class="stat" href="?interval=7">За последнюю неделю</a></li>
</ul>
</div>
<table align="center" style="border: 1px solid silver;">
<tr>
    <td align="center" style="border: 1ps solid silver;">Дата</td>
    <td align="center" style="border: 1ps solid silver;">Уникальных посетителей</td>
    <td align="center" style="border: 1ps solid silver;">Просмотров</td>
</tr>
<?php
if ($_GET['interval'])
{
    $interval = $_GET['interval'];
    //если в качестве параметров передано не число
    if (!is_numeric($interval))
    {
        echo '<p><b>Недопустимый параметр!</b></p>';
    }
    $res = mysql_query("SELECT * FROM visits ORDER BY date DESC LIMIT $interval");
    while($row = mysql_fetch_assoc($res))
    {
        echo '<tr>
                <td align="center" style="border: 1px solid silver;">'. $row['date'].'</td>
                <td align="center" style="border: 1px solid silver;">'. $row['hosts'].'</td>
                <td align="center" style="border: 1px solid silver;">'. $row['views'].'</td>
              </tr>';
    }
}
?>
</table>
</div>
</div>
</body>
</html>
<?
}else
{
    header("Location: login.php"); 
}
?>
