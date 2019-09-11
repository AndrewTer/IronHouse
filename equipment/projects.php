<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
<link href="http://localhost/ironhouse/equipment/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://localhost/ironhouse/equipment/js/jquery-1.8.2.min.js"></script>
<script>
$(document).ready(function(){
$('.block-part').click(function(){
 $(this).find('p').slideToggle(300);   
});
});
</script>
	<title>ООО"IRON HOUSE"</title>
</head>
<body id="container">
<div id="block-body">
<?php 
    include("include/block-header.php");
    include("admin/inc/count.php");
?>
<div id="block-content">
<h1 align="center" id="titles">Типовые решения</h1>
<div class="sol">
<ul id="block-solution-grid">
<?
$result = mysql_query("SELECT * FROM solutions");
if(mysql_num_rows($result) > 0)
{
    $row = mysql_fetch_array($result);
    do
    {
    echo "
    <li>
    <a href='http://localhost/ironhouse/equipment/solution/".$row["id"]."-".ftranslite($row["name"])."' class='style-name-gridA'><p align='center' class='style-name-grid'>".$row["name"]."</p></a>
    <a href='http://localhost/ironhouse/equipment/solution/".$row["id"]."-".ftranslite($row["name"])."'><div class='block-images-grid'>";
            if($row["photo"]!="" && file_exists("admin/images/source/solutions/".$row["photo"]))
        {
            $img_path = 'admin/images/source/solutions/'.$row["photo"];
            $max_width = 200;
            $max_height = 200;
            list($width, $height) = getimagesize($img_path);
            $ratioh = $max_height/$height;
            $ratiow = $max_width/$width;
            $ratio = min($ratioh,$ratiow);
            $width = intval($ratio*$width);
            $height = intval($ratio*$height);       
		echo '<img id="imgsol" src="http://localhost/ironhouse/equipment/admin/images/source/solutions/'.$row["photo"].'" alt=""/>';
        }else
        {
            $img_path = "http://localhost/ironhouse/equipment/admin/images/source/solutions/no-image.png";
            $width = 200;
            $height = 200;
            echo "<img id='imgsol' src='".$img_path."' width='100%' max-width='".$width."' height='".$height."'/>";
        }
   echo " </div></a>
   <p class='style-name-grid'>Стоимость проекта: от ".group_numerals($row["price"])." руб.</p>";
     }
    while($row = mysql_fetch_array($result));            
    }
    echo '</ul></div>';   
?>
</div>
<?php
    include("include/block-footer.php");
?>
</div>
</div>
</body>
</html>
