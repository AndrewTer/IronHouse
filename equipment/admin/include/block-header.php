<?
    defined('myeshop') or die('Доступ запрещён!');
    
    $result1 = mysql_query("SELECT * FROM feedback WHERE confirmed='no'");
    $count1 = mysql_num_rows($result1);
    
    if ($count1 > 0) {
        $count_str1 = '<p>+'.$count1.'</p>';
    }else
    {
        $count_str1 = '';
    }
    
?>
<div id="block-header">

<div id="block-header1">
<h3>OOO"IRON HOUSE". Панель Управления</h3>
<p id="link-nav"><? echo $_SESSION['urlpage']; ?></p>
</div>
<div id="block-header2">
<p align="right"><a>Администрация</a> | <a href="?logout">Выход</a></p>
<p align="right">Вы - <span>Администратор</span></p>
</div>

</div>

<div id="left-nav">
<ul>
<li><h5 id="raz1" align="center">Parking</h5></li>
<li><a href="messages.php">Сообщения</a><? echo $count_str1; ?></li>
<li><a href="equipment.php">Оборудование</a></li>
<li><a href="projects.php">Типовые проекты</a></li>
<li><a href="services.php">Услуги</a></li>
<li><a href="works.php">Работы</a></li>
<li><a href="slider_images.php">Слайдер</a></li>
<li><a href="show_stats.php?interval=1">Посещения</a></li>
<li><a href="settings.php"><h5 id="razN" align="center" >Настройки</h5></a></li>
</ul>

</div>
