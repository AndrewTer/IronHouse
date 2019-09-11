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
    $id=$_GET["id"];
?>
<div id="block-content">
<?
$result = mysql_query("SELECT * FROM solutions WHERE id=".$id);
if(mysql_num_rows($result) > 0)
{
    $row = mysql_fetch_array($result);
    do
    {
?>
    <p align='center' class='style-name-sol'> <? echo $row["name"]; ?></p>
    <div class="block-sol">
    <div style="height: auto; overflow: hidden;">
    <div style="float: left; width: auto; height: auto; padding-right: 20px; padding-bottom: 10px;">
<? 
        if($row["photo"]!="" && file_exists("admin/images/source/solutions/".$row["photo"]))
        {
            $img_path = 'http://localhost/ironhouse/equipment/admin/images/source/solutions/'.$row["photo"];
            $max_width = 200;
            $max_height = 200;
            list($width, $height) = getimagesize($img_path);
            $ratioh = $max_height/$height;
            $ratiow = $max_width/$width;
            $ratio = min($ratioh,$ratiow);
            $width = intval($ratio*$width);
            $height = intval($ratio*$height);
		echo '<img id="imgsol_select" src="http://localhost/ironhouse/equipment/admin/images/source/solutions/'.$row["photo"].'" alt=""/>';
        }else
        {
            $img_path = "http://localhost/ironhouse/equipment/admin/images/source/solutions/no-image.png";
            $width = 200;
            $height = 200;
            echo "<img id='imgsol_select' src='".$img_path."' width='100%' max-width='".$width."' height='".$height."'/>";
        }
        ?>
        </div>
        <div>
        <?
        echo '<p align="center" style="font: 18px sans-serif; color: rgb(13,95,142);">Стоимость данного проекта: от '.group_numerals($row["price"]).' руб.</p>
        <p style="font: 18px sans-serif; color: #383838;">'.$row["description"].'</p>';
    }
    while($row = mysql_fetch_array($result));            
}   
?>
</div>
</div>
<div style="border-top: 2px solid #E0E0E0; margin-top: 20px;">
<p align="center" style="font: 21px sans-serif; color: rgb(13,95,142);">Используемое оборудование</p>
<div style="margin-left: 5px;">
<ul id="block-equipment-grid-for-solution">
<?php
$resulteq = mysql_query("SELECT * FROM `equipment_for_solution` WHERE id_sol=".$id);
if(mysql_num_rows($resulteq) > 0)
{
    $roweq = mysql_fetch_array($resulteq);
    do
    {
       $result2 = mysql_query("SELECT equipment.id AS id_eq, equipment.name AS name, equipment_img.id AS ID_IMG, equipment_img.photo AS PH FROM equipment_img, equipment WHERE equipment.id=equipment_img.img AND equipment.id=".$roweq["id_eq"]." LIMIT 1");
       $row2 = mysql_fetch_array($result2);
        
    echo "
    <li>
    <a href='http://localhost/ironhouse/equipment/equipment/".$row2["id_eq"]."-".ftranslite($row2["name"])."' class='style-name-gridA'><p align='center' class='style-name-grid'>".$row2["name"]."</p></a>
    <a href='http://localhost/ironhouse/equipment/equipment/".$row2["id_eq"]."-".ftranslite($row2["name"])."'><div class='block-images-grid'>";
    if(mysql_num_rows($result2) > 1)
        {
            echo '<div class="sliderr"><ul>';
            do
            {
            if($row2["PH"]!="" && file_exists("admin/images/source/equipment/".$row2["PH"]))
            {
            $img_path = 'http://localhost/ironhouse/equipment/admin/images/source/equipment/'.$row2["PH"]; 
            $max_width = 200;
            $max_height = 200;
            list($width, $height) = getimagesize($img_path);
            $ratioh = $max_height/$height;
            $ratiow = $max_width/$width;
            $ratio = min($ratioh,$ratiow);
            $width = intval($ratio*$width);
            $height = intval($ratio*$height);
		echo '<li><img src="http://localhost/ironhouse/equipment/admin/images/source/equipment/'.$row2["PH"].'" alt=""/></li>';
		}else
        {
            echo '<li><img src="http://localhost/ironhouse/equipment/admin/images/source/equipment/no-image.png" alt=""/></li>';
        }
            }
            while($row2 = mysql_fetch_array($result2));    
        echo '</ul></div>';    
        }
        else if(mysql_num_rows($result2) == 1){
            if($row2["PH"]!="" && file_exists("admin/images/source/equipment/".$row2["PH"]))
        {
            $img_path = 'http://localhost/ironhouse/equipment/admin/images/source/equipment/'.$row2["PH"];
            $max_width = 200;
            $max_height = 200;
            list($width, $height) = getimagesize($img_path);
            $ratioh = $max_height/$height;
            $ratiow = $max_width/$width;
            $ratio = min($ratioh,$ratiow);
            $width = intval($ratio*$width);
            $height = intval($ratio*$height);
            do
            {
		echo '<img id="imgeq" src="http://localhost/ironhouse/equipment/admin/images/source/equipment/'.$row2["PH"].'" alt=""/>';
            }
            while($row2 = mysql_fetch_array($result2));    
        }else
        {
            $img_path = "http://localhost/ironhouse/equipment/admin/images/source/equipment/no-image.png";
            $width = 200;
            $height = 200;
            echo "<img id='imgeq' src='".$img_path."' width='100%' max-width='".$width."' height='".$height."'/>";
        }}
   echo " </div></a>";
     }
    while($roweq = mysql_fetch_array($resulteq));            
    } 
?>
<li>
    <a class="style-name-gridA"><p align="center" class="style-name-grid">Шлагбаум</p></a>
    <a><div class="block-images-grid">
    <?php
    if(file_exists("admin/images/source/equipment/shlagbaum.png"))
        {
            $img_path = 'http://localhost/ironhouse/equipment/admin/images/source/equipment/shlagbaum.png';
            $max_width = 200;
            $max_height = 200;
            list($width, $height) = getimagesize($img_path);
            $ratioh = $max_height/$height;
            $ratiow = $max_width/$width;
            $ratio = min($ratioh,$ratiow);
            $width = intval($ratio*$width);
            $height = intval($ratio*$height);
            echo '<img id="imgeq" src="http://localhost/ironhouse/equipment/admin/images/source/equipment/shlagbaum.png" alt=""/>';  
        }else
        {
            $img_path = "http://localhost/ironhouse/equipment/admin/images/source/equipment/no-image.png";
            $width = 200;
            $height = 200;
            echo "<img id='imgeq' src='".$img_path."' width='100%' max-width='".$width."' height='".$height."'/>";
        }
    ?>
    </div></a>
</ul></div>
</div>
</div>
</div>
<?php
    include("include/block-footer.php");
?>
</div>
</body>
</html>
