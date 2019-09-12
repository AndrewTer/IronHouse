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
    
    $_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='services.php' >Услуги</a> \ <a>Изменение услуги</a>";
    include("include/db_connect.php");
    include("include/functions.php"); 
    
    $id = clear_string($_GET["id"]);
    
    if ($_POST["submit_save"])
    {
        $error = array();
        //проверка полей
        if (!$_POST["form_title"])
        {
            $error[] = "Укажите название услуги";
        }
        if (!$_POST["txt0"])
        {
            $error[] = "Укажите описание";
        }
        if (!$_POST["form_position"])
        {
            $error[] = "Укажите положение на странице сайта";
        }
        if (empty($_POST["galleryimg"]))
            {
                include("actions/upload-gallery-services.php");
                unset($_POST["galleryimg"]);
            }
        
        if (count($error))
        {
            $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";
        }else
        {
            $querynew = "name='{$_POST["form_title"]}', description='{$_POST["txt0"]}', position='{$_POST["form_position"]}'";
            $update = mysql_query("UPDATE services SET $querynew WHERE id='$id'");
            $_SESSION['message'] = "<p id='form-success'>Услуга успешно изменена!</p>";
            
        }
    }
     
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<title>Панель Управления</title>
</head>
<body>
<div id="block-body">
<?
    include("/include/block-header.php");
?>
<div id="block-content">
<div id="block-parameters">
<p id="title-page">Изменение услуги</p>
</div>
<?
    if(isset($_SESSION['message']))
    {
        echo $_SESSION['message'];
        unset($_SESSION['message']);        
    }
    if(isset($_SESSION['answer']))
    {
        echo "<p id='form-error'>".$_SESSION['answer']."</p>";;
        unset($_SESSION['answer']);        
                           
    }    
?>
<?php
$result = mysql_query("SELECT * FROM services WHERE id='$id'");
if(mysql_num_rows($result) > 0)
{
    $row = mysql_fetch_array($result);
    do
    {
        echo '
<div id="add">
<form enctype="multipart/form-data" method="post">
<ul id="edit-tovar">
<li>
<label class="stylelabel">Название</label>
<!--код php для сохранения данных в полях ввода в случае ошибок -->
<input type="text" name="form_title" value="'.$row["name"].'" />
</li>
<li>';

if ($row["position"] == "right") $right = "selected";
if ($row["position"] == "left") $left = "selected";

echo '
<label class="stylelabel">Положение на странице сайта</label>
<select name="form_position" id="pos" size="1">
<option '.$left.' value="left">Слева</option>
<option '.$right.' value="right">Справа</option>
</select>
</li>
<li>
<label class="stylelabel">Изображения</label>
</li>
</ul>
<div id="objects">
<div id="addimage1" class="addimage1">
<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
<input type="file" name="galleryimg[]" />
</div>
</div>
<p id="add-input">Добавить</p>
<ul id="gallery-img">
';

$query_img = mysql_query("SELECT * FROM service_img WHERE img='$id'");
if (mysql_num_rows($query_img) > 0)
{
    $result_img = mysql_fetch_array($query_img);
    do
    {
        if (strlen($result_img["photo"]) > 0 && file_exists("images/source/services/".$result_img["photo"]))
        {
            $img_path = 'images/source/services/'.$result_img["photo"];
            $max_width = 100;
            $max_height = 100;
            list($width, $height) = getimagesize($img_path);
            $ratioh = $max_height/$height;
            $ratiow = $max_width/$width;
            $ratio = min($ratioh, $ratiow);
            //New dimensions
            $width = intval($ratio*$width);
            $height = intval($ratio*$height); 
        }else
        {
            $img_path = "images/source/services/no-image.png";
            $width = 80;
            $height = 70;
        }
        echo '
        <li id="del'.$result_img["id"].'" >
        <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" title="'.$result_img["photo"].'" />
        <a class="del-img-service" img_id="'.$result_img["id"].'" ></a>
        </li>
        ';
    }while ($result_img = mysql_fetch_array($query_img));
}


echo '
</ul>
<h3 class="h3click">Описание</h3>
<div class="div-editor0">
<textarea id="editor0" name="txt0" cols="100" rows="20">'.$row["description"].'</textarea>
</div>
<ul>
<p align="right"><input type="submit" id="submit_form" name="submit_save" value="Сохранить" /></p>
</ul>
<br /> <br />
</form>
</div>
';
    }while($row = mysql_fetch_array($result));
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
