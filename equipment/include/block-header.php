<?
define('myeshop', true);
include("db_connect.php");
include("functions.php");
?>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<script src="http://localhost/ironhouse/equipment/js/jquery-1.8.2.min.js"></script>
<script src="http://localhost/ironhouse/equipment/js/dm-modal.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#form-feedback').submit(function(event){
        event.preventDefault();
        $.ajax({
            url: 'http://localhost/ironhouse/equipment/feedback_lib.php',
            type: 'post',
            data: $('#form-feedback').serialize(),
            success: function(answer){
                $('#answer').html(answer);
            }
        });
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    var touch = $('#touch-menu');
    var menu=$('#navbar');
    $(touch).on('click', function(e){
        e.preventDefault();
        menu.slideToggle();
    });
    $(window).resize(function(){
        var wid=$(window).width();
        if(wid>760){ menu.removeAttr('style');}
    });
});
</script>
<!-- Основной верхний блок -->
<div id="block-header">
<div id="header-top-block"> 
<!--<p id="top-text">OOO"IRON HOUSE"</p> -->
<!--<a id="selectionA" href="http://localhost/ironhouse/"><p id="selection">Вернуться к выбору</p></a> -->
</div>
<!-- Логотип -->
<a href="http://localhost/ironhouse/equipment/"><img id="img-logo" src="http://localhost/ironhouse/equipment/images/logo.png" /></a>
<div id="personal-info">
<p align="right" style="color: #383838;">Телефон для связи</p>
<h3 align="right">8(904)558 78 27</h3>
<img src="http://localhost/ironhouse/equipment/images/phone-icon.png" />
<p align="right" style="color: #383838;">Режим работы:</p>
<p align="right" style="color: #383838;">Будние дни: с 9:00 до 20:00</p>
<p align="right" style="color: #383838;">Суббота,воскресенье - выходные</p>
<img src="http://localhost/ironhouse/equipment/images/time.png" />
</div>
<!-- Средняя навигация -->
<div id="top-menu">
<table id="main_menu" cellspacing="0">
<a href="#" id="touch-menu">Меню</a>
<tr>
      <td><a href="http://localhost/ironhouse/equipment/">Главная</a></td>
      <td><a href="http://localhost/ironhouse/equipment/o_nas/">О нас</a></td>
      <td><a href="http://localhost/ironhouse/equipment/equipment/">Оборудование</a></td>
      <td><a href="http://localhost/ironhouse/equipment/typical_solutions/">Типовые решения</a></td>
      <td><a href="http://localhost/ironhouse/equipment/services/">Услуги</a></td>
      <td><a href="http://localhost/ironhouse/equipment/partners/">Партнёрам</a></td>
      <td><a href="http://localhost/ironhouse/equipment/articles/">Статьи</a></td>
      <td><a href="http://localhost/ironhouse/equipment/contacts/">Контакты</a></td>
</tr></table>
<ul id="navbar">
      <li><a href="http://localhost/ironhouse/equipment/">Главная</a></li>
      <li><a href="http://localhost/ironhouse/equipment/o_nas/">О нас</a></li>
      <li><a href="http://localhost/ironhouse/equipment/equipment/">Оборудование</a></li>
      <li><a href="http://localhost/ironhouse/equipment/typical_solutions/">Типовые решения</a></li>
      <li><a href="http://localhost/ironhouse/equipment/services/">Услуги</a></li>
      <li><a href="http://localhost/ironhouse/equipment/partners/">Партнёрам</a></li>
      <li><a href="http://localhost/ironhouse/equipment/articles/">Статьи</a></li>
      <li><a href="http://localhost/ironhouse/equipment/contacts/">Контакты</a></li>            
    </ul>
</div>
</div>
<!-- Кнопка для отображения формы Обратной Связи -->
<a rel="popup_contact" href="#?w=600" id="rum_sst_tab" class="poplight" name="rum_sst_tab">Обратная связь</a>
<!-- Блок, в котором находится форма Обратной Связи -->
<div id="popup_contact" class="popup_block">
     <div class="note">
         <img src="http://localhost/ironhouse/equipment/images/email.jpg" alt="Контакты" style="float:left;margin:5px 10px 5px 0; " />
	 <h1>Уважаемые друзья!</h1>
         <p>Обращаем Ваше внимание, что пункты отмеченные звездочкой, обязательны для заполнения.</p>
     </div>
     <!-- Блок, в котором должно отображаться сообщение в случае ошибки или сообщение об успешной отправке сообщения пользователя -->
     <div id="answer"></div>
     <!-- Форма обратной связи -->
     <form id="form-feedback" action="" name="form-feedback" method="post">	
	   <fieldset>
		   <p class="first"><label for="name">Имя *</label><input type="text" name="name" id="name" size="30" placeholder="| " autocomplete="off" /></p>
		  <p><label for="email">Email *</label><input type="text" placeholder="example@mail.ru" name="email" id="email" size="30" placeholder="| " autocomplete="off" /></p>
		 <p><label for="phone">Номер телефона (не обязательно)</label><input type="text" name="phone" id="phone" size="30" placeholder="| " autocomplete="off" /></p>			
     <p><label for="reason">Тема письма:</label>
     <select name = "reason">
				<option value = "non">Без темы</option>
				<option value = "er">Найдена ошибка!</option>
                <option value = "help">Требуется помощь</option>
                <option value = "pz">Пожелания</option>
    </select></p>
   </fieldset>	
	  <fieldset>																			
	      <p><label for="message">Сообщение:</label><textarea name="message" id="message" cols="30" rows="10"></textarea></p>								
	 </fieldset>				
	<p class="submit"><button name="submit_send">Отправить</button></p>						
    </form>
</div>
