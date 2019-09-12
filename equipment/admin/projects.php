<?
    session_start();
    if($_SESSION['auth_admin'] == "yes_auth")
    {
    define('myeshop',true);
    if (isset($_GET["logout"]))
    {
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
    }
    
    $_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='projects.php' >Типовые проекты</a>";
    include("include/db_connect.php");
    
    include("include/functions.php");
    
    $action = $_GET["action"];
    if (isset($action))
    {
        $id = (int)$_GET["id"];
        switch($action){
            case 'delete':
            //удаление файла с изображением из папки
            $selected_image_for_delete = mysql_query("SELECT photo FROM solutions WHERE id='$id'");
            $deletePhoto = mysql_fetch_array($selected_image_for_delete);
            if (strlen($deletePhoto["photo"]) > 0 && file_exists("images/source/solutions/".$deletePhoto["photo"]))
            {
            unlink('images/source/solutions/'.$deletePhoto["photo"]);
            }
            //удаление данных из таблиц
            $delete = mysql_query("DELETE FROM solutions WHERE id='$id'");
            $delete_eq = mysql_query("DELETE FROM equipment_for_solution WHERE id_sol='$id'");
            break;
        }
    }
       
?>
<!DOCTYPE HTML>
<html>
<head>

	<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="jquery_confirm/jquery_confirm.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="jquery_confirm/jquery_confirm.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
	<title>Панель Управления</title>
</head>

<body>
<div id="block-body">
<?
    include("include/block-header.php");
    $all_count = mysql_query("SELECT * FROM solutions");
    $all_count_result = mysql_num_rows($all_count);
?>
<div id="block-content">
<div id="block-parametersT">
<ul id="options-list">
<li>Типовые проекты</li>
</ul>

</div>
<div id="block-info">
<p id="count-style">Всего типовых проектов - <strong>
<?
echo $all_count_result;
?>
</strong></p>

<p align="right" id="add-style"><a href="add-project.php">Добавить проект</a></p>
</div>

<ul id="block-solution">
<?
$num = 4;
$page = (int)$_GET['page'];
$count = mysql_query("SELECT COUNT(*) FROM solutions");
$temp = mysql_fetch_array($count);
$post = $temp[0];
// Находим общее число страниц
$total = (($post-1)/$num)+1;
$total = intval($total);
// Определяем начало сообщений для текущей страницы
$page = intval($page);
// Если значение $page меньше 1 или отрицательно
// переходим на первую страницу
// А если слишком большое, то переходим на последнюю
if(empty($page) or $page<0) $page=1;
if($page > $total) $page = $total;
// Вычисляем начиная с какого номера
// следует выводить сообщения
$start = $page * $num - $num;
if ($temp[0]>0)
{
    $result = mysql_query("SELECT * FROM solutions ORDER BY id DESC LIMIT $start, $num");
if (mysql_num_rows($result)>0)
{
    $row = mysql_fetch_array($result);
    do{
            if (strlen($row["photo"]) > 0 && file_exists("images/source/solutions/".$row["photo"]))
            {
            $img_path = 'images/source/solutions/'.$row["photo"];
            $max_width = 250;
            $max_height = 200;
            list($width,$height) = getimagesize($img_path);
            $ratioh = $max_height/$height;
            $ratiow = $max_width/$width;
            $ratio = min($ratioh, $ratiow);
            // New dimensions
            $width = intval($ratio*$width);
            $height = intval($ratio*$height);
            }else
            {
            $img_path = "images/source/solutions/no-image.png";
            $width = 200;
            $height = 200;
            }
        
        echo '
        <li>
        <p>'.$row["name"].'</p>
        <center>
        <img style="box-shadow: 0em 0em 10px #C5C5C5;" src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
        </center>
        <p align="center" class="link-action" >
        <a class="green" href="edit-project.php?id='.$row["id"].'">Изменить</a> | <a rel="projects.php?'.$url.'page='.$page.'&id='.$row["id"].'&action=delete" class="delete" >Удалить</a>
        </p>
        </li>';
        
    }while($row = mysql_fetch_array($result));
    echo '</ul>';
}    
}
if($page!=1){ $pstr_prev = '<li><a class="pstr-prev" href="projects.php?'.$url.'page='.($page - 1).'">Назад</a></li>';}
    if($page!=$total) {$pstr_next = '<li><a class="pstr-next" href="projects.php?'.$url.'page='.($page + 1).'">Вперёд</a></li>'; }       
    
    //формирование ссылок со страницами
    if($page - 5 > 0) $page5left = '<li><a href="projects.php?'.$url.'page='.($page-5).'">'.($page-5).'</a></li>';        
    if($page - 4 > 0) $page4left = '<li><a href="projects.php?'.$url.'page='.($page-4).'">'.($page-4).'</a></li>';
    if($page - 3 > 0) $page3left = '<li><a href="projects.php?'.$url.'page='.($page-3).'">'.($page-3).'</a></li>';
    if($page - 2 > 0) $page2left = '<li><a href="projects.php?'.$url.'page='.($page-2).'">'.($page-2).'</a></li>';
    if($page - 1 > 0) $page1left = '<li><a href="projects.php?'.$url.'page='.($page-1).'">'.($page-1).'</a></li>';
      
    if($page + 5 <= $total) $page5right = '<li><a href="projects.php?'.$url.'page='.($page+5).'">'.($page+5).'</a></li>';                            
    if($page + 4 <= $total) $page4right = '<li><a href="projects.php?'.$url.'page='.($page+4).'">'.($page+4).'</a></li>';    
    if($page + 3 <= $total) $page3right = '<li><a href="projects.php?'.$url.'page='.($page+3).'">'.($page+3).'</a></li>';    
    if($page + 2 <= $total) $page2right = '<li><a href="projects.php?'.$url.'page='.($page+2).'">'.($page+2).'</a></li>';    
    if($page + 1 <= $total) $page1right = '<li><a href="projects.php?'.$url.'page='.($page+1).'">'.($page+1).'</a></li>';            

if($page+5 < $total)
{
    $strtotal = '<li><p class="nav-point">...</p></li><li><a href="projects.php?'.$url.'page='.$total.'">'.$total.'</a></li>';
}
 else
{
    $strtotal = "";
    }
    ?>
  
  <div id="footerfix"></div>
    
<?    
if($total > 1)
{
    echo '
    <center>
    <div class="pstrnav">
    <ul>        
    ';
    echo $pstr_prev.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='projects.php?".$url."page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$strtotal.$pstr_next;    
    echo '
    </center>
    </ul>
    </div>    
    ';
    }
?>

</div>
</div>

</body>
</html>
<?php
}else
{
    header("Location: login.php"); 
}
?>
