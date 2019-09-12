<?php
defined('myeshop') or die('Доступ запрещён!');
$error_img = array();

if ($_FILES['upload_image']['error'] > 0)
{
    //в зависимости от номера ошибки выводим соответствующее сообщение
    switch ($_FILES['upload_image']['error'])
    {
        case 1: $error_img[] = 'Размер файла превышает допустимое значение UPLOAD_MAX_FILE_SIZE'; break;
        case 2: $error_img[] = 'Размер файла превышает допустимое значение MAX_FILE_SIZE'; break;
        case 3: $error_img[] = 'Не удалось загрузить часть файла'; break;
        case 4: $error_img[] = 'Файл не был загружен'; break;
        case 5: $error_img[] = 'Отсутствует временная папка'; break;
        case 6: $error_img[] = 'Не удалось записать файл на диск'; break;
        case 7: $error_img[] = 'PHP-расширение остановило загрузку файла'; break;
    }
}else
{
    //проверяем расширения
    if ($_FILES['upload_image']['type'] == 'image/jpeg' || $_FILES['upload_image']['type'] == 'image/jpg' || $_FILES['upload_image']['type'] == 'image/png' || $_FILES['upload_image']['type'] == 'image/JPG'  || $_FILES['upload_image']['type'] == 'image/JPEG'  || $_FILES['upload_image']['type'] == 'image/PNG'  || $_FILES['upload_image']['type'] == 'image/bmp'  || $_FILES['upload_image']['type'] == 'image/BMP'  ||  $_FILES['upload_image']['type'] == 'image/tiff' || $_FILES['upload_image']['type'] == 'image/TIFF'  || $_FILES['upload_image']['type'] == 'image/PICT' || $_FILES['upload_image']['type'] == 'image/pict'  || $_FILES['upload_image']['type'] == 'image/gif' || $_FILES['upload_image']['type'] == 'image/GIF')
    {
     $imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['upload_image']['name']));   
        //папка для загрузки
     $uploaddir = 'images/source/slider/';
     //новое сгенерированное имя файла
     $newfilename = 'slide'.'-'.$id.rand(10,1000).'.'.$imgext;
     //путь к файлу (папка.файл)
    $uploadfile = $uploaddir.$newfilename;
    
    //загружаем файл move_uploaded_file
    if (@move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploadfile))
    {
        $update = mysql_query("INSERT INTO slider_images (photo) VALUES('$newfilename')");
    }
    else
    {
        $error_img[] = "Ошибка загрузки файла";
    }
    }else
    {
        $error_img[] = "Допустимые расширения: jpeg, jpg, png";
    }
}

?>
