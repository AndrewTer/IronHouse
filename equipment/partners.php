<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
<link href="http://localhost/ironhouse/equipment/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://localhost/ironhouse/equipment/js/jquery-1.8.2.min.js"></script>
<script>
$(document).ready(function(){
$('.block-part').click(function(){
 $(this).find('div').slideToggle(300);   
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
<h1 align="center" id="titles">Партнёрам</h1>
<div id="partt">
<div class='block-part' style="border-top: 1px solid transparent;">
<h3 align="center">Дилерам</h3>
<div class="partn">
<p class="partnersP">Наша компания приглашает к сотрудничеству дилеров, монтажные и подрядные организации!<br/><br/>Наше оборудование зарекомендовало себя как надежное и простое в установке и обслуживании. Мы гарантируем качество своей продукции.<br/><br/>Все отношения с нашими партнерами регулируются дилерским договором.</p>
</div>
</div>
<div class='block-part' style="border-top: 1px solid transparent;">
<h3 align="center">Монтажным организациям</h3>
<div class="partn">
<p class="partnersP">Мы всегда рады сотрудничеству с монтажными организациями. Для получения подробной информации, позвоните нам или пришлите запрос на почту. </p>
</div>
</div>
<div class='block-part' style="border-top: 1px solid transparent;">
<h3 align="center">Поставщикам</h3>
<div class="partn">
<p class="partnersP">Мы всегда готовы рассмотреть интересные предложения и новые идеи от наших поставщиков, а также условия сотрудничества с новыми поставщиками. Присылайте Ваши предложения нам на электронную почту с пометкой в теме письма "Поставщик", и мы обязательно их рассмотрим.</p>
</div>
</div>
</div>
</div>
<?php
    include("include/block-footer.php");
?>
</div>
</body>
</html>
