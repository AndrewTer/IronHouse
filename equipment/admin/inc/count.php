<?php
include 'db_connect.php';
//получаем IP-адрес посетителя и сохраняем текущую дату
$visitor_ip = $_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d");
//узнаём, были ли посещения за сегодня
$res = mysql_query("SELECT visit_id FROM visits WHERE date='$date'");
//если сегодня ещё не было посещений
if(mysql_num_rows($res) == 0)
{
    //очищаем таблицу ips
    mysql_query("DELETE FROM ips");
    //заносим в базу IP-адрес текущего посетителя
    mysql_query("INSERT INTO ips SET ip_address='$visitor_ip'");
    //заносим в базу данных дату посещения и устанавливаем кол-во просмотров и уник. посещений в значение 1
    $res_count = mysql_query("INSERT INTO visits SET date='$date', hosts=1, views=1");
}
//если посещения сегодня уже были
else
{
    //проверяем, есть ли уже в базе IP-адрес, с которого происходит обращение
    $current_ip = mysql_query("SELECT ip_id FROM ips WHERE ip_address='$visitor_ip'");
    //если такой IP-адрес уже сегодня был (т.е. это не уникальный посетитель)
    if(mysql_num_rows($current_ip) == 1)
    {
        //добавляем для текущей даты +1 просмотр (хит)
        mysql_query("UPDATE visits SET views=views+1 WHERE date='$date'");
    }
    //если сегодня такого IP-адреса ещё не было (т.е. это уникальный посетитель)
    else
    {
        //заносим в базу IP-адрес этого посетителя
        mysql_query("INSERT INTO ips SET ip_address = '$current_ip'");
        //добавляем в базу +1 уникального посетителя (хост) и +1 просмотр (хит)
        mysql_query("UPDATE visits SET hosts=hosts+1, views=views+1 WHERE date='$date'");
    }
}
?>
