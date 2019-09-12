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
    
    $_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='equipment.php' >Оборудование</a> \ <a>Добавление оборудования</a>";
    include("include/db_connect.php");
    include("include/functions.php"); 
    
    if ($_POST["submit_add"])
    {
        $error = array();
        //проверка полей
        if (!$_POST["form_title"])
        {
            $error[] = "Укажите название оборудования";
        }
        if (!$_POST["txt0"])
        {
            $error[] = "Укажите описание";
        }
        if (!$_POST["txt1"])
        {
            $error[] = "Укажите функции";
        }
        if (!$_POST["txt2"])
        {
            $error[] = "Укажите пользовательский интерфейс";
        }
        if (!$_POST["txtch"])
        {
            $error[] = "Укажите характеристики";
        }
        if (!$_POST["txt3"])
        {
            $error[] = "Укажите принцип работы";
        }
        if (!$_POST["temperature"])
        {
            $error[] = "Укажите интервал температур";
        }
        if (!$_POST["humidity"])
        {
            $error[] = "Укажите относительную влажность воздуха";
        }
        if (!$_POST["voltage"])
        {
            $error[] = "Укажите номинальное переменное напряжение сети";
        }
        if (!$_POST["frequency"])
        {
            $error[] = "Укажите частоту";
        }
        if (!$_POST["current"])
        {
            $error[] = "Укажите номинальный потребляемый ток сети";
        }
        if (!$_POST["output_voltage"])
        {
            $error[] = "Укажите выходное напряжение";
        }
        if (!$_POST["class"])
        {
            $error[] = "Укажите класс защиты от поражения электротоком";
        }
        
        if (count($error))
        {
            $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";
        }else
        {
            mysql_query("INSERT INTO equipment(name, description, functions, interface, characteristics, temperature, humidity, voltage, frequency, current, output_voltage, class, principle_of_operation)
                        VALUES (
                            '".$_POST["form_title"]."',
                            '".$_POST["txt0"]."',
                            '".$_POST["txt1"]."',
                            '".$_POST["txt2"]."',
                            '".$_POST["txtch"]."',
                            '".$_POST["temperature"]."',
                            '".$_POST["humidity"]."',
                            '".$_POST["voltage"]."',
                            '".$_POST["frequency"]."',
                            '".$_POST["current"]."',
                            '".$_POST["output_voltage"]."',
                            '".$_POST["class"]."',
                            '".$_POST["txt3"]."'
                        )");
            $_SESSION['message'] = "<p id='form-success'>Оборудование успешно добавлено!</p>";
            $id = mysql_insert_id();
            
            if (empty($_POST["galleryimg"]))
            {
                include("actions/upload-gallery-equipment.php");
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
<p id="title-page">Добавление оборудования</p>
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
<textarea id="editor0" name="txt0" cols="90" rows="20"><?php echo (isset($_POST['txt0']))?$_POST['txt0']:'';?></textarea>
<!--<script type="text/javascript">
var ckeditor0 = CKEDITOR.replace("editor0");
AjexFileManager.init({
    returnTo: "ckeditor",
    editor: ckeditor0
});
</script>
-->
</div>

<h3 class="h3click">Функции</h3>
<div class="div-editor1">
<textarea id="editor1" name="txt1" cols="100" rows="20"><?php echo (isset($_POST['txt1']))?$_POST['txt1']:'';?></textarea>
<script type="text/javascript">
var ckeditor1 = CKEDITOR.replace("editor1");
AjexFileManager.init({
    returnTo: "ckeditor",
    editor: ckeditor1
});
</script>
</div>

<h3 class="h3click">Пользовательский интерфейс</h3>
<div class="div-editor2">
<textarea id="editor2" name="txt2" cols="100" rows="20"><?php echo (isset($_POST['txt2']))?$_POST['txt2']:'';?></textarea>
<script type="text/javascript">
var ckeditor2 = CKEDITOR.replace("editor2");
AjexFileManager.init({
    returnTo: "ckeditor",
    editor: ckeditor2
});
</script>
</div>

<h3 class="h3click">Принцип работы</h3>
<div class="div-editor3">
<textarea id="editor3" name="txt3" cols="100" rows="20"><?php echo (isset($_POST['txt3']))?$_POST['txt3']:'';?></textarea>
<script type="text/javascript">
var ckeditor3 = CKEDITOR.replace("editor3");
AjexFileManager.init({
    returnTo: "ckeditor",
    editor: ckeditor3
});
</script>
</div>

<h3 class="h3click">Технические характеристики</h3>
<div class="div-editor4">
<label id="ch">Характеристики</label><br /><br />
<textarea id="editor5" name="txtch" cols="100" rows="20"><?php echo (isset($_POST['txtch']))?$_POST['txtch']:'';?></textarea>
<script type="text/javascript">
var ckeditor5 = CKEDITOR.replace("editor5");
AjexFileManager.init({
    returnTo: "ckeditor",
    editor: ckeditor5
});
</script>
<ul id="edit-tovar">

<li>
<label>Интервал температур</label>
<input type="text" name="temperature" value="<?php echo (isset($_POST['temperature']))?$_POST['temperature']:'';?>" />
</li>
<li>
<label>Относительная влажность воздуха</label>
<input type="text" name="humidity" value="<?php echo (isset($_POST['humidity']))?$_POST['humidity']:'';?>" />
</li>
<li>
<label>Номинальное переменное напряжение сети</label>
<input type="text" name="voltage" value="<?php echo (isset($_POST['voltage']))?$_POST['voltage']:'';?>" />
</li>
<li>
<label>Частота</label>
<input type="text" name="frequency" value="<?php echo (isset($_POST['frequency']))?$_POST['frequency']:'';?>" />
</li>
<li>
<label>Номинальный потребляемый ток сети</label>
<input type="text" name="current" value="<?php echo (isset($_POST['current']))?$_POST['current']:'';?>" />
</li>
<li>
<label>Выходное напряжение</label>
<input type="text" name="output_voltage" value="<?php echo (isset($_POST['output_voltage']))?$_POST['output_voltage']:'';?>" />
</li>
<li>
<label>Класс защиты от поражения электротоком</label>
<input type="text" name="class" value="<?php echo (isset($_POST['class']))?$_POST['class']:'';?>" />
</li>
</ul>
</div>

<ul>
<p align="right"><input type="submit" id="submit_form" name="submit_add" value="Добавить оборудование" /></p>
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
