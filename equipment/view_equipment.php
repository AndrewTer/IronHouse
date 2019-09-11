<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>   
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
 $(".sliderr").each(function () { // обрабатываем каждый слайдер
  var obj = $(this);
  $(obj).append("<div class='nav'></div>");
  $(obj).find("li").each(function () {
   $(obj).find(".nav").append("<span rel='"+$(this).index()+"'></span>"); // добавляем блок навигации
   $(this).addClass("sliderr"+$(this).index());
  });
  $(obj).find("span").first().addClass("on"); // делаем активным первый элемент меню
 });
});
function sliderJS (obj, sl) { // slider function
 var ul = $(sl).find("ul"); // находим блок
 var bl = $(sl).find("li.sliderr"+obj); // находим любой из элементов блока
 var step = $(bl).width(); // ширина объекта
 $(ul).animate({marginLeft: "-"+step*obj}, 500); // 500 это скорость перемотки
}
$(document).on("click", ".sliderr .nav span", function() { // slider click navigate
 var sl = $(this).closest(".sliderr"); // находим, в каком блоке был клик
 $(sl).find("span").removeClass("on"); // убираем активный элемент
 $(this).addClass("on"); // делаем активным текущий
 var obj = $(this).attr("rel"); // узнаем его номер
 sliderJS(obj, sl); // слайдим
 return false;
});
$(function () {
      var element = $("#under-equipment"), display;
      $(window).scroll(function () {
        display = $(this).scrollTop() >= 520;
        display != element.css('opacity') && element.stop().animate({ 'opacity': display }, 800);
      });
    });
function tab(el) { 
    // Получить список вкладок меню 
    var menu=el.parentNode; 
    var tabs=menu.getElementsByTagName('li'); 
    for (var i=0; i<tabs.length; i++) { 
        // Вкладка 
        var tab=tabs[i]; 
        // Блок контента 
        var content=document.getElementById(tab.id+'_content'); 
        // Это вкладка на которой кликнули мышкой 
        if (tab.id==el.id) { 
            // Сделать вкладку активной 
            tab.className='tab_active'; 
            // Показать связанный с ней блок контента 
            if (content) { 
                content.className='tab_content visible'; 
            } 
        } 
        else { 
            // Сделать вкладку неактивной 
            tab.className=''; 
            // Скрыть связанный с ней блок контента 
            if (content) { 
                content.className='tab_content'; 
            } 
        } 
    } 
} 
</script>
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
$result = mysql_query("SELECT * FROM equipment WHERE id=".$id);
if(mysql_num_rows($result) > 0)
{
    $row = mysql_fetch_array($result);
    do
    {
?>
    <p align='center' class='style-name-sol'> <? echo $row["name"]; ?></p>
    <div class="block-sol">
    <div>
    <div style="height: auto; overflow: hidden;">
    <div style="float: left; width: auto; height: auto; padding-right: 20px; padding-bottom: 10px;">
<? 
       $result2 = mysql_query("SELECT equipment_img.id AS ID_IMG, equipment_img.photo AS PH FROM equipment_img, equipment WHERE equipment.id=equipment_img.img AND equipment.id=".$row["id"]);
       $row2 = mysql_fetch_array($result2);
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
        }
        }
        ?>
        </div>
        <? echo '<p style="font: 18px sans-serif; color: #383838;">'.$row["description"].'</p>'; ?>
        </div>
 <div style="width: auto; height: auto;"> 
<!-- меню с вкладками -->
<ul id="menus">
  <li id="func" class="tab_active" onclick="tab(this);">Функции</li>
  <li id="inter" onclick="tab(this);">Пользовательский интерфейс</li>
  <li id="techn" onclick="tab(this);">Технические характеристики</li>
  <li id="work" onclick="tab(this);">Принцип работы</li>
</ul>
<!-- контейнер со страницами --> 
<div id="conta"> 
  <div id="func_content" class="tab_content visible"><? $functions=$row['functions']; echo "$functions";?></div> 
  <div id="inter_content" class="tab_content"><? $interface=$row['interface']; echo "$interface";?></div> 
  <div id="techn_content" class="tab_content">
  <? 
$char=$row['characteristics']; echo "$char<br>"; 
$interval=$row['temperature'];
$vlaga=$row['humidity'];
$napseti=$row['voltage'];
$chast=$row['frequency'];
$nomtok=$row['current'];
$napr=$row['output_voltage'];
$classz=$row['class'];
echo "<table width='100%' max-width='472px' cellspacing='0' cellpadding='5'>
   <tr> 
    <td width='280' valign='top'>Интервал температур</td><td valign='top'>$interval</td>
   </tr>
   <tr> 
    <td width='280' valign='top'>Относительная влажность воздуха</td><td valign='top'>$vlaga</td>
   </tr>
   <tr> 
    <td width='280' valign='top'>Номинальное переменное напряжение сети</td><td valign='top'>$napseti</td>
   </tr>
   <tr> 
    <td width='280' valign='top'>Частота</td><td valign='top'>$chast</td>
   </tr>
   <tr> 
    <td width='280' valign='top'>Номинальный потребляемый ток сети</td><td valign='top'>$nomtok</td>
   </tr>
   <tr> 
    <td width='280' valign='top'>Выходное напряжение</td><td valign='top'>$napr</td>
   </tr>
   <tr> 
    <td width='280' valign='top'>Класс защиты от поражения электротоком</td><td valign='top'>$classz</td>
   </tr>
  </table>";
?>
  </div> 
  <div id="work_content" class="tab_content"><? $principle_of_operation=$row['principle_of_operation']; echo "$principle_of_operation";?></div> 
</div> 
</div>                 
<?  }
    while($row = mysql_fetch_array($result));            
}   
?>
</div>
</div>
</div>
<?php
    include("include/block-footer.php");
?>
</div>
</body>
</html>
