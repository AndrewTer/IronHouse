<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    define('myeshop', true);
    include("../include/db_connect.php");
    $path = "../images/source/equipment/".$_POST["title"];
    if (file_exists($path))
    {
        unlink($path);
        $delete = mysql_query("DELETE FROM equipment_img WHERE id = '{$_POST["id"]}'");
        echo "delete";
    }else
    {
       $delete = mysql_query("DELETE FROM equipment_img WHERE id = '{$_POST["id"]}'");
        echo "delete";
    }
}
?>