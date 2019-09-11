<!DOCTYPE html >
<html>
<head>
	<title>Главная</title>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
		<link rel="stylesheet" type="text/css" href="css/main.css" />
	    <script type="text/javascript" src="/js/jQuery/jquery.js"></script>
	<meta name="robots" content="index,follow" />
    <!-- НОЧНОЕ НЕБО -->
    <style>
	body {
		background-color: black;

		/* Firefox */
		background-image:
			-moz-radial-gradient(circle, #FFFFFF 2px, rgba(248,255,128,.5) 4px, transparent 40px),
			-moz-radial-gradient(circle, #FFFFFF 1px, rgba(255,186,170,.4) 3px, transparent 30px),
			-moz-radial-gradient(circle, rgba(255,255,255,.9) 1px, rgba(251,255,186,.3) 2px, transparent 40px),
			-moz-radial-gradient(circle, rgba(255,255,255,.4), rgba(253,255,219,.2) 1px, transparent 30px);

		/* Webkit */
		background-image:
			-webkit-gradient(radial, 50% 50%, 2, 50% 50%, 40, from(white), color-stop(0.1, rgba(248,255,128,.5)), to(transparent)),
			-webkit-gradient(radial, 50% 50%, 1, 50% 50%, 30, from(white), color-stop(0.1, rgba(255,186,170,.4)), to(transparent)),
			-webkit-gradient(radial, 50% 50%, 1, 50% 50%, 40, from(rgba(255,255,255,.9)), color-stop(0.05, rgba(251,255,186,.3)), to(transparent)),
			-webkit-gradient(radial, 50% 50%, 0, 50% 50%, 30, from(rgba(255,255,255,.4)), color-stop(0.03, rgba(253,255,219,.2)), to(transparent));

		/* Background Attributes */
		background-size: 550px 550px, 350px 350px, 250px 270px, 220px 200px;
		background-position: 0 0, 30px 60px, 130px 270px, 70px 150px;

		/* Animation */
		animation-name: movement;
		animation-duration: 5s;
		animation-timing-function: linear;
		animation-iteration-count: infinite;

		/* Firefox */
		-moz-animation-name: movement;
		-moz-animation-duration: 5s;
		-moz-animation-timing-function: linear;
		-moz-animation-iteration-count: infinite;

		/* Webkit */
		-webkit-animation-name: movement;
		-webkit-animation-duration: 5s;
		-webkit-animation-timing-function: linear;
		-webkit-animation-iteration-count: infinite;
	}
	@keyframes movement
	{
		from {
				background-position: 0 0, 30px 60px, 130px 270px, 70px 150px;
		}
		to {
				background-position: -550px 0, -320px 60px, -120px 270px, -150px 150px;
		}
	}
	@-moz-keyframes movement
	{
		from {
				background-position: 0 0, 30px 60px, 130px 270px, 70px 150px;
		}
		to {
				background-position: -550px 0, -320px 60px, -120px 270px, -150px 150px;
		}
	}
	@-webkit-keyframes movement
	{
		from {
				background-position: 0 0, 30px 60px, 130px 270px, 70px 150px;
		}
		to {
				background-position: -550px 0, -320px 60px, -120px 270px, -150px 150px;
		}
	}
	</style>
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
<div class="layoutMain">
    <a href="equipment/" class="eq" title="переход к оборудованию"><img id="eq_img" src="img/parking.png" /></a>
    <a href="design" class="des" title="переход к дизайну"><img id="dis_img" src="img/design.png" /></a>
</div>
<div class="footer">
	<div class="hood"></div>
</div>

<script type="text/javascript" src="/js/min/allInOne.js"></script>

<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-5946665-14', 'poravkino.ru');
        ga('send', 'pageview');
</script>
<!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter24830660 = new Ya.Metrika({id:24830660, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/24830660" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
</body>
</html>
