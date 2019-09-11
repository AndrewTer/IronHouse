<script>
    $(function () {
      var element = $(".equip"), display;
      var element2 = $(".b-carousel"), display2;
      var element3 = $(".sol"), display3;
      $(window).scroll(function () {
        display = $(this).scrollTop() >= 400;
        display2 = $(this).scrollTop() >= 550;
        display3 = $(this).scrollTop() >= 950;
        display != element.css('opacity') && element.stop().animate({ 'opacity': display }, 800);
        display2 != element2.css('opacity') && element2.stop().animate({ 'opacity': display2 }, 800);
        display3 != element3.css('opacity') && element3.stop().animate({ 'opacity': display3 }, 800);
      });
    });
  </script>
<?
include("include/db_connect.php");
?>
 <div class="ism-slider" data-transition_type="zoom" data-play_type="loop" data-radios="false" id="my-slider">
  <ol>
  <?
$result = mysql_query("SELECT * FROM slider_images");
if (mysql_num_rows($result)>0)
{
    $row = mysql_fetch_array($result);
    do{
        if (strlen($row['photo']) > 0 && file_exists("admin/images/source/slider/".$row['photo']))
        {
            $img_path = 'admin/images/source/slider/'.$row['photo'];
        }
        echo "
        <li>
        <img width='100%' height='900px' src=$img_path />
         </li>
        ";
    }while($row = mysql_fetch_array($result));
}   
?>
</ol>
</div>
<div style="width: auto;">
<p id="eqqp" align="center"><a href="http://localhost/ironhouse/equipment/equipment/" id="eqq">Наше оборудование</a></p>
</div>
<div class="equip" align="center">
<?
$result = mysql_query("SELECT * FROM equipment");
if(mysql_num_rows($result) > 0)
{
    $row = mysql_fetch_array($result);
    do
    {
       $result2 = mysql_query("SELECT equipment_img.id AS ID_IMG, equipment_img.photo AS PH FROM equipment_img, equipment WHERE equipment.id=equipment_img.img AND equipment.id=".$row["id"]." LIMIT 1");
       $row2 = mysql_fetch_array($result2);
    echo "
    <a href='http://localhost/ironhouse/equipment/equipment/".$row["id"]."-".ftranslite($row["name"])."'>";
            if($row2["PH"]!="" && file_exists("admin/images/source/equipment/".$row2["PH"]))
        {
            $img_path = 'admin/images/source/equipment/'.$row2["PH"];
            $max_width = 120;
            $max_height = 120;
            list($width, $height) = getimagesize($img_path);
            $ratioh = $max_height/$height;
            $ratiow = $max_width/$width;
            $ratio = min($ratioh,$ratiow);
            $width = intval($ratio*$width);
            $height = intval($ratio*$height);
            do
            {echo '<img id="imgeqM" src="admin/images/source/equipment/'.$row2["PH"].'"/>';}
            while($row2 = mysql_fetch_array($result2));    
        }else
        {
            $img_path = "admin/images/source/equipment/no-image.png";
            $width = 100;
            $height = 100;
            echo "<img id='imgeqM' src='".$img_path."'/>";
        }
        echo "</a>";
     }
    while($row = mysql_fetch_array($result));            
    } 
?>
</div>
<div style="width: auto;">
<p id="eqqp" align="center" style="color: rgb(46,95,122);">Наши работы</p>
</div>
<div class="b-carousel"> <!-- контейнер, в котором будет карусель -->
		<div class="b-carousel-button-left"></div> <!-- левая кнопка -->
		<div class="b-carousel-button-right"></div> <!-- правая кнопка -->
		<div class="h-carousel-wrapper"> <!-- видимая область карусели -->
			<div class="h-carousel-items"> <!-- весь набор элементов карусели -->
			  <?
                $resultw = mysql_query("SELECT * FROM works");
                if (mysql_num_rows($resultw)>0)
                    {
                        $roww = mysql_fetch_array($resultw);
                        do{
                            if (strlen($roww['photo']) > 0 && file_exists("admin/images/source/projects/".$roww['photo']))
                            {
                                 $img_pathw = 'admin/images/source/projects/'.$roww['photo'];
                            }
        echo "
        <div class='b-carousel-block'>
					<a class='a-carousel-image-link'>
						<img class='galimg' src=$img_pathw tabindex='0'/>
					</a>
				</div>
        ";
        }while($roww = mysql_fetch_array($resultw));
    }   
            ?>
			</div>
		</div>
</div>
<div style="width: auto;">
<p id="eqqp" align="center"><a href="http://localhost/ironhouse/equipment/typical_solutions/" id="eqq">Типовые решения</a></p>
</div>
<div class="sol">
<ul id="block-solution-grid">
<?
$result = mysql_query("SELECT * FROM solutions");
if(mysql_num_rows($result) > 0)
{
    $row = mysql_fetch_array($result);
    do
    {
    echo "
    <li>
    <a href='http://localhost/ironhouse/equipment/solution/".$row["id"]."-".ftranslite($row["name"])."' class='style-name-gridA'><p align='center' class='style-name-grid'>".$row["name"]."</p></a>
    <a href='http://localhost/ironhouse/equipment/solution/".$row["id"]."-".ftranslite($row["name"])."'><div class='block-images-grid'>";
            if($row["photo"]!="" && file_exists("admin/images/source/solutions/".$row["photo"]))
        {
            $img_path = 'admin/images/source/solutions/'.$row["photo"];
            $max_width = 480;
            $max_height = 480;
            list($width, $height) = getimagesize($img_path);
            $ratioh = $max_height/$height;
            $ratiow = $max_width/$width;
            $ratio = min($ratioh,$ratiow);
            $width = intval($ratio*$width);
            $height = intval($ratio*$height);
		echo '<img id="imgsol"   src="admin/images/source/solutions/'.$row["photo"].'" alt=""/>';   
        }else
        {
            $img_path = "admin/images/source/solutions/no-image.png";
            $width = 480;
            $height = 480;
            echo "<img id='imgsol' src='".$img_path."' width='100%' max-width='".$width."' height='".$height."'/>";
        }
   echo " </div></a>
   <p class='style-name-grid'>Стоимость проекта: от ".$row["price"]." руб.</p>
   ";
     }
    while($row = mysql_fetch_array($result));            
    }
    ?>
</ul> 
</div>
