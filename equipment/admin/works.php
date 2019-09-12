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
    
    $_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='works.php' >Работы</a>";
    include("include/db_connect.php");
    include("include/functions.php");     
    
    $action = $_GET["action"];
    if (isset($action))
    {
        $id = (int)$_GET["id"];
        switch($action){
            case 'delete':
            //удаление файла с изображением из папки
            $selected_image_for_delete = mysql_query("SELECT photo FROM works WHERE id='$id'");
            $deletePhoto = mysql_fetch_array($selected_image_for_delete);
            if (strlen($deletePhoto["photo"]) > 0 && file_exists("images/source/projects/".$deletePhoto["photo"]))
            {
            unlink('images/source/projects/'.$deletePhoto["photo"]);
            }
            //удаление данных из таблицы
            $delete = mysql_query("DELETE FROM works WHERE id='$id'");
            break;
        }
    }
    
    if ($_POST["submit_add"])
    {
            if (empty($_POST["upload_image"]))
            {
            $id = mysql_insert_id();
                include("actions/upload-image-works.php");
                unset($_POST["upload_image"]);
                $_SESSION['message'] = "<p id='form-success'>Изображение успешно добавлено!</p>";
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
    $all_count = mysql_query("SELECT * FROM works");
    $all_count_result = mysql_num_rows($all_count);
?>
<div id="block-content">
<div id="block-parametersT">
<ul id="options-list">
<li>Работы</li>
</ul>
</div>
<div id="block-info">
<p id="count-style">Всего изображений - <strong>
<?
echo $all_count_result;
?>
</strong></p>
</div>
<div id="block-select">
<div id="img-upload">
<form enctype="multipart/form-data" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
<input type="file" name="upload_image" />
<input type="submit" id="submit_addimg" name="submit_add" value="Добавить изображение" />
</form>
</div>
</div>
<ul id="block-work">
<?
$num = 4;
$page = (int)$_GET['page'];
$count = mysql_query("SELECT COUNT(*) FROM works");
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
    $result = mysql_query("SELECT * FROM works ORDER BY id DESC LIMIT $start, $num");
if (mysql_num_rows($result)>0)
{
    $row = mysql_fetch_array($result);
    do{
        if (strlen($row["photo"]) > 0 && file_exists("images/source/projects/".$row["photo"]))
        {
            $img_path = 'images/source/projects/'.$row["photo"];
            $max_width = 250;
            $max_height = 200;
            list($width,$height) = getimagesize($img_path);
            $ratioh = $max_height/$height;
            $ratiow = $max_width/$width;
            $ratio = min($ratioh, $ratiow);
            $width = intval($ratio*$width);
            $height = intval($ratio*$height);
        }
        echo '
        <li>
        <center>
        <img style="box-shadow: 0em 0em 10px #C5C5C5;" src="'.$img_path.'" width="'.$max_width.'" height="'.$max_height.'" />
        </center>
        <p align="center" class="link-action" >
        <a rel="works.php?'.$url.'page='.$page.'&id='.$row["id"].'&action=delete" class="delete" >Удалить</a>
        </p>
        </li>';
    }while($row = mysql_fetch_array($result));
    echo '</ul>';
}    
}
if($page!=1){ $pstr_prev = '<li><a class="pstr-prev" href="works.php?'.$url.'page='.($page - 1).'">Назад</a></li>';}
    if($page!=$total) {$pstr_next = '<li><a class="pstr-next" href="works.php?'.$url.'page='.($page + 1).'">Вперёд</a></li>'; }       
    
    //формирование ссылок со страницами
    if($page - 5 > 0) $page5left = '<li><a href="works.php?'.$url.'page='.($page-5).'">'.($page-5).'</a></li>';        
    if($page - 4 > 0) $page4left = '<li><a href="works.php?'.$url.'page='.($page-4).'">'.($page-4).'</a></li>';
    if($page - 3 > 0) $page3left = '<li><a href="works.php?'.$url.'page='.($page-3).'">'.($page-3).'</a></li>';
    if($page - 2 > 0) $page2left = '<li><a href="works.php?'.$url.'page='.($page-2).'">'.($page-2).'</a></li>';
    if($page - 1 > 0) $page1left = '<li><a href="works.php?'.$url.'page='.($page-1).'">'.($page-1).'</a></li>';
    
    if($page + 5 <= $total) $page5right = '<li><a href="works.php?'.$url.'page='.($page+5).'">'.($page+5).'</a></li>';                            
    if($page + 4 <= $total) $page4right = '<li><a href="works.php?'.$url.'page='.($page+4).'">'.($page+4).'</a></li>';    
    if($page + 3 <= $total) $page3right = '<li><a href="works.php?'.$url.'page='.($page+3).'">'.($page+3).'</a></li>';    
    if($page + 2 <= $total) $page2right = '<li><a href="works.php?'.$url.'page='.($page+2).'">'.($page+2).'</a></li>';    
    if($page + 1 <= $total) $page1right = '<li><a href="works.php?'.$url.'page='.($page+1).'">'.($page+1).'</a></li>';            

if($page+5 < $total)
{
    $strtotal = '<li><p class="nav-point">...</p></li><li><a href="works.php?'.$url.'page='.$total.'">'.$total.'</a></li>';
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
    echo $pstr_prev.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='works.php?".$url."page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$strtotal.$pstr_next;    
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
