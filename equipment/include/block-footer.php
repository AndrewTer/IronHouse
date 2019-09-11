<div id="block-footer">
<script>
$(document).ready(function() {
$('body').append('<div class="button-up" style="display: none;opacity: 0.7;width: 100%;max-width:90px;height:100%;position: fixed;left: 0px;top: 0px;cursor: pointer;text-align: center;line-height: 100px;color: #45688E;">&#9650; Вверх</div>');
$ (window).scroll (function () {
if ($ (this).scrollTop () > 300) {
$ ('.button-up').fadeIn();} else {
$ ('.button-up').fadeOut();}});
$('.button-up').click(function(){
$('body,html').animate({
scrollTop: 0
}, 100);
return false;
});
$('.button-up').hover(function() {
$(this).animate({
'opacity':'1',
}).css({'background-color':'#E1E7ED','color':'#45688E'});
}, function(){
$(this).animate({
'opacity':'0.7'
}).css({'background':'none','color':'#45688E'});;
});
});
</script>
<table align="center" class="footertab">
<tr><th>
<p align="left"><a id="indo" href="http://localhost/ironhouse/equipment/">ГЛАВНАЯ</a></p>
<p align="left"><a id="indo" href="http://localhost/ironhouse/equipment/o_nas/">О НАС</a></p>
<p align="left"><a id="indo" href="http://localhost/ironhouse/equipment/equipment/">ОБОРУДОВАНИЕ</a></p>
<p align="left"><a id="indo" href="http://localhost/ironhouse/equipment/typical_solutions/">ПРОЕКТЫ</a></p>
</th>
<th>
<p align="left"><a id="indo" href="http://localhost/ironhouse/equipment/services/">РАБОТЫ</a></p>
<p align="left"><a id="indo" href="http://localhost/ironhouse/equipment/partners/">ПАРТНЕРАМ</a></p>
<p align="left"><a id="indo" href="http://localhost/ironhouse/equipment/articles/">СТАТЬИ</a></p>
<p align="left"><a id="indo" href="http://localhost/ironhouse/equipment/contacts/">КОНТАКТЫ</a></p>
</th>
<th>
<h4 style="padding-bottom: 0px;">Рассказать в сетях:</h4>
<div class="pluso" data-background="transparent" data-options="medium,round,line,horizontal,nocounter,theme=08" data-services="vkontakte,facebook,twitter,email"></div>
</th></tr>
</table>
<script type="text/javascript">(function() {
  if (window.pluso)if (typeof window.pluso.start == "function") return;
  if (window.ifpluso==undefined) { window.ifpluso = 1;
    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
    var h=d[g]('body')[0];
    h.appendChild(s);
  }})();</script>
<div id="prava">
<p align="center" class="prava">©2016 OOO"IRON HOUSE". Все права защищены.</p>
</div>
</div>
