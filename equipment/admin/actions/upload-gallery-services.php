<?php
defined('myeshop') or die('Доступ запрещён!');
if($_FILES['galleryimg']['name'][0]){
    for($i = 0; $i < count($_FILES['galleryimg']['name']); $i++){
        $error_gallery = "";
        if($_FILES['galleryimg']['name'][$i]){
            $galleryimgType = $_FILES['galleryimg']['type'][$i]; //тип файла
            $types = array("image/gif", "image/png", "image/jpeg", "image/jpg", "image/JPG", "image/JPEG", "image/GIF");
            
            //расширение картинки
            $imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['galleryimg']['name'][$i]));
            //папка для загрузки
            $uploaddir = 'images/source/services/';
            //новое сгенерированное имя файла
            $newfilename = 'service'.$id.'-'.rand(10,1000).'.'.$imgext;
            //путь к файлу (папка.файл)
            $uploadfile = $uploaddir.$newfilename;
            
            if(!in_array($galleryimgType, $types)){
                $error_gallery = "<p id='form-error'>Допустимые расширения - .gif, .jpg, .png</p>";
                $_SESSION['answer'] = $error_gallery;
                continue;
            }
            if(empty($error_gallery))
            {
                if(@move_uploaded_file($_FILES['galleryimg']['tmp_name'][$i], $uploadfile)){
                    
                    mysql_query("INSERT INTO service_img(img, photo) 
                            VALUES('".$id."','".$newfilename."')");
                }else{
                   $_SESSION['answer'] = "Ошибка загрузки файла"; 
                }
            }
            
            
        }
    }
}
?>
