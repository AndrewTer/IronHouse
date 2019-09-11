<?
include("include/db_connect.php");
include("admin/inc/count.php");
?>
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
</script>
<link href="http://localhost/ironhouse/equipment/css/style.css" rel="stylesheet" type="text/css" />
	<title>ООО"IRON HOUSE"</title>
</head>
<body id="container">
<div id="block-body">
<?php 
    include("include/block-header.php");
?>
<div id="block-content">
<h1 align="center" id="titles">Оборудование</h1>
<div style="margin-left: 20px;">
<ul id="block-equipment-grid">
<?
$result = mysql_query("SELECT * FROM equipment");
if(mysql_num_rows($result) > 0)
{
    $row = mysql_fetch_array($result);
    do
    {
       $result2 = mysql_query("SELECT equipment_img.id AS ID_IMG, equipment_img.photo AS PH FROM equipment_img, equipment WHERE equipment.id=equipment_img.img AND equipment.id=".$row["id"]);
       $row2 = mysql_fetch_array($result2);
    echo "
    <li>
    <a href='http://localhost/ironhouse/equipment/equipment/".$row["id"]."-".ftranslite($row["name"])."' class='style-name-gridA'><p align='center' class='style-name-grid'>".$row["name"]."</p></a>
    <a href='http://localhost/ironhouse/equipment/equipment/".$row["id"]."-".ftranslite($row["name"])."' class='style-name-gridA'><div class='block-images-grid'>";
    if(mysql_num_rows($result2) > 1)
        {
            echo '<div class="sliderr"><ul>';
            do
            {
            if($row2["PH"]!="" && file_exists("admin/images/source/equipment/".$row2["PH"]))
            {
            $img_path = 'admin/images/source/equipment/'.$row2["PH"]; 
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
            $img_path = 'admin/images/source/equipment/'.$row2["PH"];
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
		echo '<img id="imgeq"   src="http://localhost/ironhouse/equipment/admin/images/source/equipment/'.$row2["PH"].'" alt=""/>';
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
   echo " </div></a>";
     }
    while($row = mysql_fetch_array($result));            
    }
    echo '</ul></div>';   
?>
</div>
<div id="under-equipment">
<p id="text-equipment">
Среди линейки оборудования для парковки и паркингов АП-ПРО мы предлагаем: въездные и выездные стойки, автоматические кассы оплаты, кассы оплаты, совмещенные с въездной стойкой, ручные кассы оплаты, стойки акцептирования (предоставления скидки) и соответствующее программное обеспечение.
</p>
<p id="text-equipment">
Данные позиции оборудования вкупе с другими необходимыми элементами парковки (шлагбаум, светофор, счетчик мест, ограничительные столбики и др.) позволяют организовать совершенно различные решения для автоматизации парковок, которые во многом зависят от того, какие проблемы они будут решать (подробнее типовые проекты).
</p>
<p id="text-equipment">
Наши автоматические парковочные системы призваны решить многие вопросы, с которыми может столкнуться владелец парковки. Некоторые из них рассмотрены ниже:
</p>
<ul id="list-equipment">
<li>неэффективное использование парковочных площадей, получение дополнительного дохода;</li>
<li>увеличение выручки. Поскольку учет каждого въезда/выезда позволяет пресечь неправомерные действия со стороны операторов;</li>
<li>упорядочивание движения транспорта, устранение заторов на въезде;</li>
<li>автоматизация процесса расчета и оплаты;</li>
<li>ведение статистики посещений клиентами;</li>
<li>повышение имиджа комплексов, парковок и паркингов;</li>
<li>снижение риска угона автомобилей за счет использования системы фотофиксации номеров;</li>
<li>решение проблемы брошенного автотранспорта;</li>
<li>устранение неправомерных жалоб о порче автомобилей;</li>
<li>увеличение заполняемости парковки;</li>
<li>значительная экономия на постах охраны;</li>
<li>уникальное программное обеспечение позволяет удаленно контролировать физическую работу паркинга в любое время суток, получать финансовые отчеты о прибыли, состоянии диспенсеров для купюр, корректировать работу парковки.</li>
</ul>
<p id="text-equipment">
Наше оборудование для парковок работает на билетах со штрих-кодом и бесконтактными картами доступа.
</p>
<p id="text-equipment">
Использование билетов со штрих-кодом для разовых посещений является оптимальным решением для применения в автоматических парковочных системах. Это легко объясняется тем, что для печати используется чековая термобумага распространенного стандартного размера, поэтому затраты на ее поиски и приобретение минимальны. Один рулон термобумаги обеспечивает 5000 въездных билетов.
</p>
<p id="text-equipment">
Кроме того, преимуществом таких билетов является и то, что при его утере не наносится значительный материальный ущерб владельцу парковки.
</p>
<p id="text-equipment">
Использование карт доступа имеет место, когда существуют постоянные пользователи парковки или паркинга. Это могут быть, например, клиенты комплекса, работники и другие пользователи. Абонементская карта доступа является дебетовой с определенным периодом действия (например, месяц). Кроме того, карта может быть запрограммирована на различные тарифы.
</p>
<p id="text-equipment">
Автоматизация парковок и паркингов с нами – это просто и эффективно!
</p>
</div>
<?php
    include("include/block-footer.php");
?>
</div>
</div>
</body>
</html>
