<?
include("include/db_connect.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<link href="http://localhost/ironhouse/equipment/css/style.css" rel="stylesheet" type="text/css" />
	<title>ООО"IRON HOUSE"</title>
</head>
<body id="container">
<div id="block-body">
<?php 
    include("include/block-header.php");
    include("admin/inc/count.php");
?>
<div id="block-content">
<h1 align="center" id="titles">Работы</h1>
<div id="left">
<ul>
<?
$result = mysql_query("SELECT services.id as id, services.name as name, services.description as description, services.position as position 
FROM services
WHERE services.position='left'
GROUP BY services.name");
if(mysql_num_rows($result) > 0)
{
    $row = mysql_fetch_array($result);
    do
    {
    echo '
    <li id="serv">
    <p align="center" class="style-title-grid">'.$row["name"].'</p>
    <p class="description">'.$row["description"].'</p>';
    $result2 = mysql_query("
    SELECT service_img.photo as photo FROM services, service_img
    WHERE service_img.img='".$row["id"]."'
    GROUP BY service_img.photo");
    if(mysql_num_rows($result2)==1)
    {
    $row2 = mysql_fetch_array($result2);
    do
    {
    if($row2["photo"]!="" && file_exists("admin/images/source/services/".$row2["photo"]))
        {
            $img_path = 'http://localhost/ironhouse/equipment/admin/images/source/services/'.$row2["photo"];
            $max_width = 400;
            $max_height = 350;
            list($width, $height) = getimagesize($img_path);
            $ratioh = $max_height/$height;
            $ratiow = $max_width/$width;
            $ratio = min($ratioh,$ratiow);
            $width = intval($ratio*$width);
            $height = intval($ratio*$height);
        }else
        {
            $img_path = "http://localhost/ironhouse/equipment/admin/images/source/services/no-image.png";
            $width = 400;
            $height = 350;
        }
    echo '
    <div class="block-images-grid">
    <img id="img1" src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
    </div>
    ';
    }
    while($row2 = mysql_fetch_array($result2));            
    }else if(mysql_num_rows($result2) % 2==0 && mysql_num_rows($result2)>0){
        $row2 = mysql_fetch_array($result2);
    do
    {
    if($row2["photo"]!="" && file_exists("admin/images/source/services/".$row2["photo"]))
        {
            $img_path = 'http://localhost/ironhouse/equipment/admin/images/source/services/'.$row2["photo"];
            $width = 200;
            $height = 200;
            $max_width = 200;
            $max_height = 200;
            list($width, $height) = getimagesize($img_path);
            $ratioh = $max_height/$height;
            $ratiow = $max_width/$width;
            $ratio = min($ratioh,$ratiow);
            $width = intval($ratio*$width);
            $height = intval($ratio*$height);
        }else
        {
            $img_path = "http://localhost/ironhouse/equipment/admin/images/source/services/no-image.png";
            $width = 200;
            $height = 200;
        }
    echo '
    <img  id="img" src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
    ';
    }
    while($row2 = mysql_fetch_array($result2));  
        }
        else if(mysql_num_rows($result2) ==3){
        $row2 = mysql_fetch_array($result2);
    do
    {
    if($row2["photo"]!="" && file_exists("admin/images/source/services/".$row2["photo"]))
        {
            $img_path = 'http://localhost/ironhouse/equipment/admin/images/source/services/'.$row2["photo"];
            $max_width = 150;
            $max_height = 150;
            list($width, $height) = getimagesize($img_path);
            $ratioh = $max_height/$height;
            $ratiow = $max_width/$width;
            $ratio = min($ratioh,$ratiow);
            $width = intval($ratio*$width);
            $height = intval($ratio*$height);
        }else
        {
            $img_path = "http://localhost/ironhouse/equipment/admin/images/source/services/no-image.png";
            $width = 250;
            $height = 200;
        }
    echo '
    <img  id="img3" src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
    ';
    }
    while($row2 = mysql_fetch_array($result2));  
        }        
    }
    while($row = mysql_fetch_array($result));            
}
echo "</li>";
?>
</ul>
</div>
<div id="right">
<ul>
<?
$result = mysql_query("
SELECT services.id as id, services.name as name, services.description as description, services.position as position 
FROM services, service_img
WHERE services.position='right'
GROUP BY services.name");
if(mysql_num_rows($result) > 0)
{
    $row = mysql_fetch_array($result);
    do
    {
    echo '
    <li id="serv">
    <p align="center" class="style-title-grid">'.$row["name"].'</p>
    <p class="description">'.$row["description"].'</p>';
    $result2 = mysql_query("
    SELECT service_img.photo as photo FROM services, service_img
    WHERE service_img.img='".$row["id"]."'
    GROUP BY service_img.photo");
    if(mysql_num_rows($result2)==1)
    {
    $row2 = mysql_fetch_array($result2);
    do
    {
    if($row2["photo"]!="" && file_exists("admin/images/source/services/".$row2["photo"]))
        {
            $img_path = 'http://localhost/ironhouse/equipment/admin/images/source/services/'.$row2["photo"];
            $max_width = 400;
            $max_height = 350;
            list($width, $height) = getimagesize($img_path);
            $ratioh = $max_height/$height;
            $ratiow = $max_width/$width;
            $ratio = min($ratioh,$ratiow);
            $width = intval($ratio*$width);
            $height = intval($ratio*$height);
        }else
        {
            $img_path = "http://localhost/ironhouse/equipment/admin/images/source/services/no-image.png";
            $width = 400;
            $height = 350;
        }
        
    echo '
    <div class="block-images-grid">
    <img id="img1" src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
    </div>
    ';
    }
    while($row2 = mysql_fetch_array($result2));            
    }else if(mysql_num_rows($result2) % 2==0 && mysql_num_rows($result2)>0){
        $row2 = mysql_fetch_array($result2);
    do
    {
    if($row2["photo"]!="" && file_exists("admin/images/source/services/".$row2["photo"]))
        {
            $img_path = 'http://localhost/ironhouse/equipment/admin/images/source/services/'.$row2["photo"];
            $width = 200;
            $height = 200;
            $max_width = 200;
            $max_height = 200;
            list($width, $height) = getimagesize($img_path);
            $ratioh = $max_height/$height;
            $ratiow = $max_width/$width;
            $ratio = min($ratioh,$ratiow);
            $width = intval($ratio*$width);
            $height = intval($ratio*$height);
        }else
        {
            $img_path = "http://localhost/ironhouse/equipment/admin/images/source/services/no-image.png";
            $width = 200;
            $height = 200;
        }
    echo '
    <img  id="img" src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
    ';
    }
    while($row2 = mysql_fetch_array($result2));  
        }
        else if(mysql_num_rows($result2) ==3){
        $row2 = mysql_fetch_array($result2);
    do
    {
    if($row2["photo"]!="" && file_exists("admin/images/source/services/".$row2["photo"]))
        {
            $img_path = 'http://localhost/ironhouse/equipment/admin/images/source/services/'.$row2["photo"];
            $max_width = 150;
            $max_height = 150;
            list($width, $height) = getimagesize($img_path);
            $ratioh = $max_height/$height;
            $ratiow = $max_width/$width;
            $ratio = min($ratioh,$ratiow);
            $width = intval($ratio*$width);
            $height = intval($ratio*$height);
        }else
        {
            $img_path = "http://localhost/ironhouse/equipment/admin/images/source/services/no-image.png";
            $width = 250;
            $height = 200;
        }
    echo '
    <img  id="img3" src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
    ';
    }
    while($row2 = mysql_fetch_array($result2));  
        }        
    }
    while($row = mysql_fetch_array($result));            
}
echo "</li>";
?>
</ul>
</div>
</div>
<?php
    include("include/block-footer.php");
?>
</div>
</body>
</html>
