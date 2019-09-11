<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
<link href="http://localhost/ironhouse/equipment/css/style.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<title>ООО"IRON HOUSE"</title>
</head>
<body id="container">
<div id="block-body">
<?php 
    include("include/block-header.php");
    include("admin/inc/count.php");
?>
<div id="block-content">
<h1 align="center" id="titles">Контакты</h1>
<div class="address-info">
    <div class="contacts">
    <table style="width: 100%;">
  <tr>
    <th colspan="2"><p align="center" style="color: rgb(46,95,122); margin-top: -5px; padding-bottom: 10px; border-bottom: 2px solid rgb(46,95,122); font: 20px cursive;">НАШИ КОНТАКТЫ</p></th>
  </tr>
  <tr>
    <td colspan="2"><p style="margin-top: -15px; padding-left: 15px; font: 17px cursive;">197343, Россия, г. Санкт-Петербург,<br /> ул. Матроса Железняка, д.53, Лит.А,<br/>пом.3-Н</p></td>
  </tr>
  <tr>
    <td><p style="margin-top: -10px; padding-left: 25px; font: 16px cursive; color: rgb(46,95,122); float: left; margin-left: 10px;"><img src="http://localhost/ironhouse/equipment/images/metro.png"/>  Пионерская</p></td>
    <td><p style="margin-top: -10px; padding-left: 30px; font: 16px cursive; color: rgb(46,95,122); float: left; margin-left: 10px;"><img src="http://localhost/ironhouse/equipment/images/metro.png"/>  Удельная</p></td>
  </tr>
  <tr>
    <td colspan="2"><p style="border-top: 2px solid #C0C0C0; padding-top: 10px; margin-top: -10px; padding-left: 15px; font: 16px cursive;">Телефон: 8 (904) 558 78 27</p></td>
  </tr>
  <tr>
    <td colspan="2"><p style="margin-top: -10px; padding-left: 15px; font: 16px cursive;">E-mail: company.ironhouse@gmail.com</p></td>
  </tr>
  <tr>
    <td colspan="2"><a id="vk" href="http://vk.com/oooironhouse"><img style="position: absolute; margin-left: 14px;" width="25px" src="http://localhost/ironhouse/equipment/images/vk.png"/><p style="border-top: 2px solid #C0C0C0; margin-top: -15px; padding-left: 40px; font: 17px cursive; padding-top: 15px;">Вступайте в нашу группу ВКонтакте</p></a></td>
  </tr>
</table>
    </div>
    <!--Карта-->
    <div id="cards">
    <script type="text/javascript" charset="utf-8" async 
    src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=MJ4NQ-gjksDBPk-4llvy_2gYzJIloIpu&width=720&height=330&lang=ru_RU&sourceType=constructor&scroll=true">
    </script>
</div>
<div style="height: 20px;"></div>
</div>
</div>
<?php
    include("include/block-footer.php");
?>
</div>
</body>
</html>
