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
    
    $_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='settings.php' >Настройки</a>";
    include("include/db_connect.php");
    include("include/functions.php");
    if($_POST["submit_change"])
    {
        $oldlogin = $_POST["oldlog"];
        $newlogin  = $_POST["newlog"];
        $newloginreset  = $_POST["newlogreset"];
        if($oldlogin && $newlogin && $newloginreset)
        {
            $result = mysql_query("SELECT * FROM reg_admin WHERE login = '$oldlogin'");
            if(mysql_num_rows($result) > 0)
            {
                $row = mysql_fetch_array($result);
                if($newlogin==$newloginreset){
                    $result = mysql_query("UPDATE reg_admin SET login='$newlogin' WHERE id='".$row["id"]."'");
                     $great = "Логин успешно изменён!";
                }else
                {
                    $msgerror = "Логин не изменён, так как новый логин повторен неправильно!";
                }
            }else
            {
                $msgerror = "Неверный Логин!";
            }     
        
        }else
        {
            $msgerror = "Следует заполнить все поля!";
        }
    }
    
    if($_POST["submit_changePass"])
    {
        $oldpass = $_POST["oldpass"];
        $newpass  = $_POST["newpass"];
        $newpassreset  = $_POST["newpassreset"];
        if($oldpass && $newpass && $newpassreset)
        {
            //шифрование старого пароля
            $oldpass = md5($oldpass);
            $oldpass = strrev($oldpass);
            $oldpass = strtolower("mb03foo51".$oldpass."qj2jjdp9");
            //шифрование нового пароля
            $newpass = md5($newpass);
            $newpass = strrev($newpass);
            $newpass = strtolower("mb03foo51".$newpass."qj2jjdp9");
            //шифрование нового пароля для повтора
            $newpassreset = md5($newpassreset);
            $newpassreset = strrev($newpassreset);
            $newpassreset = strtolower("mb03foo51".$newpassreset."qj2jjdp9");
            $result = mysql_query("SELECT * FROM reg_admin WHERE pass = '$oldpass'");
            if(mysql_num_rows($result) > 0)
            {
                $row = mysql_fetch_array($result);
                if($newpass==$newpassreset){
                    $result = mysql_query("UPDATE reg_admin SET pass='$newpass' WHERE id='".$row["id"]."'");
                     $greatP = "Пароль успешно изменён!";
                }else
                {
                    $msgerrorP = "Пароль не изменён, так как новый пароль повторен неправильно!";
                }
            }else
            {
                $msgerrorP = "Неверный Пароль!";
            }     
        
        }else
        {
            $msgerrorP = "Следует заполнить все поля!";
        }
    }
    
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
<li>Настройки</li>
</ul>
</div>
<p align='center' id="log">Изменить логин</p>
<div id="loginchange">
<?
    if($msgerror){
        echo '<p align="center" id="msgerror" >'.$msgerror.'</p>';
    }
    if($great){
        echo '<p align="center" id="msgres">'.$great.'</p>';
    }
?>
<form method="post">
<table align='center'  cellspacing='0' cellpadding='5'>
   <tr> 
    <td width='45%'  align='right'  valign='top'>Старый логин:</td><td width='55%' valign='top'><input type="text" name="oldlog" id="oldlog" /></td>
   </tr>
   <tr> 
    <td width='45%' align='right' valign='top'>Новый логин:</td><td width='55%' valign='top'><input type="text" name="newlog" id="newlog" /></td>
   </tr>
   <tr> 
    <td width='45%' align='right' valign='top'>Повторить новый логин:</td><td width='55%' valign='top'><input type="text" name="newlogreset" id="newlogreset" /></td>
   </tr>
   <tr> 
    <td width='45%' align='right' valign='top'></td><td width='55%' valign='top'><p><input type="submit" id="submit_log" name="submit_change" value="Изменить логин" /></p></td>
   </tr>
</table>
</form>
</div>

<p align='center' id="log">Изменить пароль</p>
<div id="passwchange">
<?
    if($msgerrorP){
        echo '<p align="center" id="msgerrorP" >'.$msgerrorP.'</p>';
    }
    if($greatP){
        echo '<p align="center" id="msgresP">'.$greatP.'</p>';
    }
?>
<form method="post">
<table align='center'  cellspacing='0' cellpadding='5'>
   <tr> 
    <td width='45%'  align='right'  valign='top'>Старый пароль:</td><td width='55%' valign='top'><input type="password" name="oldpass" id="oldpass" /></td>
   </tr>
   <tr> 
    <td width='45%' align='right' valign='top'>Новый пароль:</td><td width='55%' valign='top'><input type="password" name="newpass" id="newpass" /></td>
   </tr>
   <tr> 
    <td width='45%' align='right' valign='top'>Повторить новый пароль:</td><td width='55%' valign='top'><input type="password" name="newpassreset" id="newpassreset" /></td>
   </tr>
   <tr> 
    <td width='45%' align='right' valign='top'></td><td width='55%' valign='top'><p><input type="submit" id="submit_log" name="submit_changePass" value="Изменить пароль" /></p></td>
   </tr>
</table>
</form>
</div>

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
