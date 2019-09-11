<?
   $db_host = "localhost";
   $db_user = "root"; 
   $db_pass = "";
   $db_database = "ironhouse";
   $connection = mysql_connect($db_host, $db_user, $db_pass);
   mysql_select_db($db_database,$connection) or die("БД не подключена".mysql_error());
   mysql_query("set names utf8");
?>
