<?
define('myeshop', true);
//Подключение к Базе Данных
include("/include/db_connect.php");
//Установка соответствующей кодировки
$tname = $_POST['name'];
$tname=iconv("UTF-8", "WINDOWS-1251", $tname);
$temail= $_POST['email'];
$temail=iconv("UTF-8", "WINDOWS-1251", $temail);
$tphone = $_POST['phone'];
$tphone=iconv("UTF-8", "WINDOWS-1251", $tphone);
$treason = $_POST['reason'];
$tmessage = $_POST['message'];
$tmessage=iconv("UTF-8", "WINDOWS-1251", $tmessage);
//Проверка содержимого полей ввода и выбора на наличие текста
if($tname!="" && $temail!="" && $treason!="" && $tmessage!="")
{
    //Проверка на вверность email
    if (filter_var($temail, FILTER_VALIDATE_EMAIL))
    {
    //Получение ip
    $ip = $_SERVER['REMOTE_ADDR'];
    //Добавление сообщения в Базу Данных
    mysql_query("INSERT INTO feedback(name,email,number,reason,message,date,ip,confirmed) 
                    VALUES(
                        '".$tname."',
                        '".$temail."',
                        '".$tphone."',
                        '".$treason."',
                        '".$tmessage."',
                        NOW(),
                        '".$ip."',
                        'no'
                    )");
    $result = 3;
    }
    else{
        $result = 2;
    }
} else
{
    $result = 1;
}
//Вызов функции, которая возвращает ответ
echo getAnswer($result);
//Функция, которая возвращает ответ сервера
function getAnswer($result){
        switch($result){
            case 0: $answer = "";
            break;
            case 1: $answer = "<p id='form-error' align='center'>Ошибка при отправке!</br>Не все обязательные поля заполнены!</p>";
            break;
            case 2: $answer = "<p id='form-error' align='center'>Неверны email и/или номер телефона!</p>";
            break;
            case 3: $answer = "<p id='form-success' align='center'>Благодарим за ваше сообщение!</p>";
            break;
        }
    return $answer;
}  
?>
