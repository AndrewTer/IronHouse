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
<h1 align="center" id="titles">Ошибка 404</h1>
<div id="not_found">
<div style="float: left;">
<img src="images/404.png" width="auto" height="174" />
</div>
<p style="font: 18px sans-serif; color: #383838;">К сожалению, запрашиваемая Вами страница не найдена..</p>
<p style="font: 17px sans-serif; color: #383838;">Почему?</p>
<ol style="font: 17px sans-serif; color: #383838;">
<li>Ссылка, по которой Вы пришли, неверна.
<li>Вы неправильно указали путь или название страницы.
<li>Страница была удалёна со времени Вашего последнего посещения.
</ol>
<p style="font: 18px sans-serif; color: #383838;">Для продолжения работы с сайтом Вы можете перейти на <a id="main" href="http://localhost/ironhouse/equipment/">Главную страницу сайта.</a></p>
</div>
</div>
<?php
    include("include/block-footer.php");
?>
</div>
</body>
</html>
