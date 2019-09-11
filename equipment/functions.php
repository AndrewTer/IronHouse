<?php
//Подключение к базе данных
include("include/db_connect.php");
//Функция очистки текста от спец.символов
function clear_string($cl_str){
    $cl_str = strip_tags($cl_str); //удаление тегов html и php
    $cl_str = mysql_real_escape_string($cl_str); //очистка спец. символов //функция не работает без подключения к БД
    $cl_str = trim($cl_str); //удаление пробелов
    return $cl_str;
}
//Функция транслита
function ftranslite($name){
    $name=preg_replace("/[\s+\.\,]/","-",$name);
    $name=preg_replace("/[\"\'!\?\(\)\:\$\%]/","",$name);
    static $trans=array(
    'а'=>'a', 'б'=>'b', 'в'=>'v', 'г'=>'g', 'д'=>'d', 'е'=>'e', 'ж'=>'zh', 'з'=>'z',
    'и'=>'i', 'й'=>'y', 'к'=>'k', 'л'=>'l', 'м'=>'m', 'н'=>'n', 'о'=>'o', 'п'=>'p',
    'р'=>'r', 'с'=>'s', 'т'=>'t', 'у'=>'u', 'ф'=>'f', 'ы'=>'i', 'э'=>'e', 'А'=>'A',
    'Б'=>'B', 'В'=>'V', 'Г'=>'G', 'Д'=>'D', 'Е'=>'E', 'Ж'=>'ZH', 'З'=>'Z', 'И'=>'I',
    'Й'=>'Y', 'К'=>'K', 'Л'=>'L', 'М'=>'M', 'Н'=>'N', 'О'=>'O', 'П'=>'P', 'Р'=>'R',
    'С'=>'S', 'Т'=>'T', 'У'=>'U', 'Ф'=>'F', 'Ы'=>'I', 'Э'=>'E', 'ё'=>"yo", 'х'=>"h",
    'ц'=>"ts", 'ч'=>"ch", 'ш'=>"sh", 'щ'=>"shch", 'ъ'=>"", 'ь'=>"", 'ю'=>"yu", 'я'=>"ya",
    'Ё'=>"YO", 'Х'=>"H", 'Ц'=>"TS", 'Ч'=>"CH", 'Ш'=>"SH", 'Щ'=>"SHCH", 'Ъ'=>"", 'Ь'=>"",
    'Ю'=>"YU", 'Я'=>"YA"                                 
    );
    $strstring = strtr($name, $trans);
    return strtolower($strstring);
}
//Группировка цен по разрядам
function group_numerals($int){
    switch (strlen($int)){
        case '4':
        $price = substr($int,0,1).' '.substr($int,1,4);
        break;
        case '5':
        $price = substr($int,0,2).' '.substr($int,2,5);
        break;
        case '6':
        $price = substr($int,0,3).' '.substr($int,3,6);
        break;
        case '7':
        $price = substr($int,0,1).' '.substr($int,1,3).' '.substr($int,4,7);
        break;
        default:
        $price = $int;
        break;
    }
    return $price;
}
?>
