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
    
    $_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='services.php' >Услуги</a> \ <a>Добавление услуги</a>";
    include("include/db_connect.php");
    include("include/functions.php"); 
    
    if ($_POST["submit_add"])
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
        
        if (count($error))
        {
            $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";
        }else
        {
            mysql_query("INSERT INTO services(name, description, position)
                        VALUES (
                            '".$_POST["form_title"]."',
                            '".$_POST["txt0"]."', 
                            '".$_POST["form_position"]."'
                        )");
            $_SESSION['message'] = "<p id='form-success'>Услуга успешно добавлена!</p>";
            $id = mysql_insert_id();
            
            if (empty($_POST["galleryimg"]))
            {
                include("actions/upload-gallery-services.php");
                unset($_POST["galleryimg"]);
            }
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
<p id="title-page">Добавление услуги</p>
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
<div id="add">
<form enctype="multipart/form-data" method="post">
<ul id="edit-tovar">
<li>
<label class="stylelabel">Название</label>
<!--код php для сохранения данных в полях ввода в случае ошибок -->
<input type="text" name="form_title" value="<?php echo (isset($_POST['form_title']))?$_POST['form_title']:'';?>" />
</li>
<li>
<label class="stylelabel">Положение на странице сайта</label>
<select name="form_position" id="pos" size="1">
<option value="left">Слева</option>
<option value="right">Справа</option>
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

<h3 class="h3click">Описание</h3>
<div class="div-editor0">
<textarea id="editor0" name="txt0" cols="100" rows="20"><?php echo (isset($_POST['txt0']))?$_POST['txt0']:'';?></textarea>
</div>
<ul>
<p align="right"><input type="submit" id="submit_form" name="submit_add" value="Добавить услугу" /></p>
</ul>
<br /> <br />
</form>
</div>



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
