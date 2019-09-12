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
    
    $_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='projects.php' >Типовые проекты</a> \ <a>Изменение проекта</a>";
    include("include/db_connect.php");
    include("include/functions.php"); 
    
    $id = clear_string($_GET["id"]);
    $action = clear_string($_GET["action"]);
    
    if(isset($action))
    {
        switch($action){
            case 'delete':
            
            if(file_exists("images/source/solutions/".$_GET["img"]))
            {
                unlink("images/source/solutions/".$_GET["img"]);
            }
            break;
        }
    }
    
    if ($_POST["submit_edit"])
    {
        $error = array();
        //проверка полей
        if (!$_POST["form_title"])
        {
            $error[] = "Укажите название проекта";
        }
        if (!$_POST["txt0"])
        {
            $error[] = "Укажите описание";
        }
        if (!$_POST["form_price"])
        {
            $error[] = "Укажите цену проекта";
        }
        
        if (count($error))
        {
            $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";
        }else
        {
            $querynew = "name='{$_POST["form_title"]}', description='{$_POST["txt0"]}', price='{$_POST["form_price"]}'";
            mysql_query("UPDATE solutions SET $querynew WHERE id='$id'");
            
            if (empty($_POST["upload_image"]))
            {
                include("actions/upload-image-project.php");
                unset($_POST["upload_image"]);
            }
            
            //очищаем всё выбранное ранее оборудование проекта и заменяем на новое
            $clear = mysql_query("DELETE FROM equipment_for_solution WHERE id_sol='$id'");
            $all_count = mysql_query("SELECT id FROM equipment");
            if (mysql_num_rows($all_count)>0)
            {
                $rowcount = mysql_fetch_array($all_count);
                do{
                if ($_POST[$rowcount['id']])
                {
                    mysql_query("INSERT INTO equipment_for_solution (id_sol, id_eq)
                        VALUES (
                            '".$id."',
                            '".$rowcount["id"]."'
                        )");
                }
                }while($rowcount = mysql_fetch_array($all_count));
            }
            
             $_SESSION['message'] = "<p id='form-success'>Проект успешно изменён!</p>";   
            
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
<p id="title-page">Изменение типового проекта</p>
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
$result = mysql_query("SELECT * FROM solutions WHERE id='$id'");
if(mysql_num_rows($result) > 0)
{
    $rowR = mysql_fetch_array($result);
    do
    {
        echo '
<div id="add">
<form enctype="multipart/form-data" method="post">
<ul id="edit-tovar">
<li>
<label class="stylelabel">Название</label>
<!--код php для сохранения данных в полях ввода в случае ошибок -->
<input type="text" name="form_title" value="'.$rowR["name"].'" />
</li>
<li>
<label class="stylelabel">Минимальная стоимость</label>
<input id="pos" type="number" name="form_price" min="100" max="10000000" step="1" value="'.$rowR["price"].'" />
</li>
<li>
<label class="stylelabel">Выберите используемое оборудование</label>
</li>
</ul>
<div id="objectseq">
<ul id="eq-list">';
?>
<?
 $result = mysql_query("SELECT equipment.id as id, equipment.name as name FROM equipment");
if (mysql_num_rows($result)>0)
{
    $row = mysql_fetch_array($result);
    do{
        $resultimg = mysql_query("SELECT photo FROM equipment_img WHERE img=".$row['id']);
        //проверяем на наличие оборудовании в проекте
        $check = mysql_query("SELECT id_eq FROM equipment_for_solution WHERE id_sol='$id' AND id_eq=".$row['id']);
        if (mysql_num_rows($check)>0)
        {
        echo "<li>
        <div style='height: auto;'><p style='height: auto;'><input id='chk' type='checkbox' checked='checked' name='".$row['id']."'>".$row['name']."</p>
        </div>";
        }else
        {
        echo "<li>
        <div style='height: auto;'><p style='height: auto;'><input id='chk' type='checkbox' name='".$row['id']."'>".$row['name']."</p>
        </div>";
        }
        echo"
        <div class='block-equipment-images'>
        <p align='center' id='show_image'>Показать изображения</p>
        <ul>";
        if (mysql_num_rows($resultimg)>0)
    {
    $rowimg = mysql_fetch_array($resultimg);
    do{
        if (strlen($rowimg["photo"]) > 0 && file_exists("images/source/equipment/".$rowimg["photo"]))
            {
            $img_path = 'images/source/equipment/'.$rowimg["photo"];
            
            $width = 200;
            $height = 180;
            }else
            {
            $img_path = "images/source/equipment/no-image.png";
            $width = 200;
            $height = 180;
            }
            echo "<div style='float:left; margin-right: 10px;'><img style='box-shadow: 0em 0em 10px #C5C5C5;' src='".$img_path."' width='".$width."' height='".$height."' /></div>";
            }while($rowimg = mysql_fetch_array($resultimg));
    }   
        
        echo "</ul>
        </div>
        </li>";    
    }while($row = mysql_fetch_array($result));
}   
?>
<?
echo '
</ul>
</div>
<ul id="edit-tovar">
<li>
<label class="stylelabel">Изображение</label>
</li>
</ul>';
if (strlen($rowR["photo"]) > 0 && file_exists("images/source/solutions/".$rowR["photo"]))
{
    $img_path = 'images/source/solutions/'.$rowR["photo"];
            $max_width = 250;
            $max_height = 200;
            list($width, $height) = getimagesize($img_path);
            $ratioh = $max_height/$height;
            $ratiow = $max_width/$width;
            $ratio = min($ratioh, $ratiow);
            //New dimensions
            $width = intval($ratio*$width);
            $height = intval($ratio*$height); 
            
            echo '<ul id="img-sol">
        <li>
        <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" title="'.$result_img["photo"].'" />
        <a href="edit-project.php?id='.$rowR["id"].'&img='.$rowR["photo"].'&action=delete" ></a>
        </li></ul>
        ';
}else
        {        
echo '<div id="objects">
<div id="addimage1" class="addimage1">
<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
<input type="file" name="upload_image" />
</div>
</div>';       
}
echo '
<div class="desc">
<h3 class="h3click">Описание</h3>
<div class="div-editor0">
<textarea id="editor0" name="txt0" cols="90" rows="20">'.$rowR["description"].'</textarea>
</div>
</div>
<ul>
<p align="right"><input type="submit" id="submit_form" name="submit_edit" value="Сохранить" /></p>
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
