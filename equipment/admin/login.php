<?php
session_start();
define('myeshop', true);
include("include/db_connect.php");
include("include/functions.php");
if($_POST["submit_enter"])
{
    $login = clear_string($_POST["input_login"]);
    $pass  = clear_string($_POST["input_pass"]);
    if($login && $pass)
    {
        //шифрование пароля
        $pass = md5($pass);
        $pass = strrev($pass);
        $pass = strtolower("mb03foo51".$pass."qj2jjdp9");
   $result = mysql_query("SELECT * FROM reg_admin WHERE login = '$login' and pass = '$pass'");
   if(mysql_num_rows($result) > 0)
   {
    $row = mysql_fetch_array($result);
    $_SESSION['auth_admin'] = 'yes_auth';
    header("Location: index.php");
   }else
   {
        $msgerror = "Неверный Логин и/или Пароль";
   }     
    }else
    {
        $msgerror = "Следует заполнить все поля!";
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style-login.css" rel="stylesheet" type="text/css" />
	<title>Вход</title>
</head>
<body>
<div id="block-pass-login">
<?
    if($msgerror){
        echo '<p id="msgerror" >'.$msgerror.'</p>';
    }
    
?>
<!-- Форма авторизации -->
<form method="post">
<ul id="pass-login">
<li><label>Логин</label><input type="text" name="input_login" /></li>
<li><label>Пароль</label><input type="password" name="input_pass" /></li>
</ul>
<p align="center"><input type="submit" id="submit_enter" name="submit_enter" value="Вход"/> </p>
</form>
</div>
</body>
</html>
