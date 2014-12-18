<img src="images/icons/gal.png" style="float: right; padding: 0 5px 0 0;">
<?php
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $id = @$_GET["id"];
    $s="";
   if ($id == null){
       
    $fotogalerie = $m->LoadAll("fotogalerie");
       
    echo "<h4>Fotogalerie</h4>";
    foreach($fotogalerie as $key=>$value){
     $s.= "<div id=\"fotogalerie\"><a href =\"$actual_link&id=";
    $s.= $value['id_fotogalerie'];
        $s.= "_";
        $s.= $value['nazev'];
        $s.= "#content\"><img src=\"images/icons/foto.png\">&nbsp;";
        $s.= $value['nazev'];
        $s.= "</a></div>";
       
       }
       unset($key, $value);
        echo $s;
   } else {
       $name = explode("_", $id);
       $fotky = $m->LoadAll("fotka");
    echo "<h4>Fotogalerie - $name[1]</h4>";
       $s.= "<div class=\"yoxview\" id=\"thumbnails\">";
       foreach ($fotky as $key=>$value){
           if ($name[0] == $value['fotogalerie_id_fotogalerie']){
               $s.= "<div id=\"fotky\">";
               $s.= "<a href=\"images/gallery/"; 
               $s.= $value['nazev']; 
               $s.= "\"><img src=\"images/gallery/thumbnails/";
               $s.= $value['nazev'];
               $s.= "\" alt=\"\" title=\"";
               $s.= $value['alt'];
               $s.= "\" /></a>";
               $s.= "</div>";
           }
       }
       unset($key, $value);
       $s.= "</div>";
       $s.= "<a href=\"javascript: history.go(-1)\"><h6>Zpět</h6></a>";
       echo $s;
   }
?>
