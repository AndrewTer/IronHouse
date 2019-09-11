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
    
    $_SESSION['urlpage'] = "<a href='index.php' >Главная</a>";
    include("include/db_connect.php");
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
    
    //общее количество оборудования
    $query1 = mysql_query("SELECT * FROM equipment");
    $result1 = mysql_num_rows($query1);
    //общее количество услуг
    $query2 = mysql_query("SELECT * FROM services");
    $result2 = mysql_num_rows($query2);
    //общее количество сообщений
    $query3 = mysql_query("SELECT * FROM feedback");
    $result3 = mysql_num_rows($query3);
    //общее количество типовых проектов
    $query4 = mysql_query("SELECT * FROM solutions");
    $result4 = mysql_num_rows($query4);
    //извлекаем статистику по текущей дате
    $res = mysql_query("SELECT views, hosts FROM visits WHERE date = '$date'");
    $row = mysql_fetch_assoc($res);
    $resd = mysql_query("SELECT views, hosts FROM visitsd WHERE date = '$date'");
    $rowd = mysql_fetch_assoc($resd);
?>
<div id="block-content">
<div id="block-parameters">
<p id="title-page">Общая статистика</p>
</div>
<h3 align="center">Parking</h3>
<ul id="general-statistics">
<li><p>Всего сообщений<span><? echo $result3; ?></span></p></li>
<li><p>Оборудования<span><? echo $result1; ?></span></p></li>
<li><p>Типовых проектов<span><? echo $result4; ?></span></p></li>
<li><p>Услуг<span><? echo $result2; ?></span></p></li>
<li><p>Уникальных посетителей за сегодня<span><? echo $row['hosts']; ?></span></p></li>
<li><p>Просмотров за сегодня<span><? echo $row['views']; ?></span></p></li>
</ul>
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
