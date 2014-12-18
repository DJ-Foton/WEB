<script type="text/javascript" src="../yoxview/yoxview-init.js"></script>
    
		<script type="text/javascript">
			$(document).ready(function(){
				$("#thumbnails").yoxview({
					lang: 'cs',
					backgroundColor: '#000',
                    backgroundOpacity: 0.7,
                    buttonsFadeTime: 150
				});
			});
		</script>

<div class="panel panel-yellow">
                            <div class="panel-heading">
                                <h3 class="panel-title">Úpravy fotek</h3>
                            </div>
                            <div class="panel-body">
                            
<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$galery = $m->LoadAll("fotogalerie");
$foto = $m->LoadAll("fotka");


echo "<form action=\"$actual_link#reserve\" method=\"post\" enctype=\"multipart/form-data\" style=\"text-align: center\">";
 if (@$_POST['neco']){
      foreach ($foto as $value=>$key){
        if ($_POST['foto'] == $key['nazev']){
           echo "<div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
<div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">popisek fotky:</h3><input type=\"text\" name=\"alt\" style=\"color: #000\" value=\"".$key['alt']."\" />
                            </div>
                        </div><br>
                        
                        <div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                        <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">galerie:</h3><select name=\"gal\" style=\"color: #000\">";
                            
$s = "";
    foreach ($galery as $k=>$v){
        $s.= "<option ";
        if ($key['fotogalerie_id_fotogalerie'] == $v['id_fotogalerie']){
            $s.= "selected ";
        }
        $s.= "name=\"".$v['nazev']."\" value=\"";
        $s.= $v['id_fotogalerie'];
        $s.= "\">".$v['nazev']."</option>";
    }
    unset ($k, $v);
echo $s;
 echo "</select></div>
                        </div><br>
                        <input type=\"hidden\" name=\"id\" value=\"".$key['id_fotka']."\" />";
            break;
        }
      }
     unset ($key, $value);
     echo "<input type=\"submit\" value=\"Uložit\" name=\"uprava\" class=\"btn btn-warning\" onclick=\"
                return confirm('Opravdu chcete provedené změny uložit?')\" /></form>";
    } else {
     if (@$_POST['uprava']){
         $items = array (array("column"=>"alt", "value_mysql"=>"\"".$_POST['alt']."\""),
                   array("column"=>"fotogalerie_id_fotogalerie", "value_mysql"=>"".$_POST['gal'].""));
        $m->UpdateDB("fotka", $items, $_POST['id']);
    echo "<div class=\"alert alert-success\">
                    <strong>Úspěch! </strong> Úpravy byly úspěšně uloženy.
                </div>";
}
     $galery = $m->LoadAll("fotogalerie");
$foto = $m->LoadAll("fotka");
     
foreach ($galery as $key=>$value){
    echo "<div class=\"panel panel-default\"  style=\" margin: 0 auto; width: 55%\">
<div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">".$value['nazev']."</h3>
                            </div>
                            <div class=\"panel-body yoxview\" id=\"thumbnails\" style=\"text-align: center\">";
                            foreach ($foto as $k=>$v){
                                if ($v['fotogalerie_id_fotogalerie'] == $value['id_fotogalerie']){
                                    echo "<div style=\"display: inline-block; padding-right: 5px; padding-bottom: 5px;\">
                                    <div class=\"panel panel-default\"  style=\" margin: 0 auto; width: 170px\">
<div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                    <input type=\"radio\" name=\"foto\" value=\"".$v['nazev']."\" />
                                    <a href=\"../images/gallery/".$v['nazev']."\"><img src=\"../images/gallery/thumbnails/".$v['nazev']."\" alt=\"\" title=\"".$v['alt']."\" /></a></div></div></div>";
                                }
                            }
                          echo "</div>
                        </div><br>";
}
 
echo "<input type=\"submit\" value=\"Upravit\" name=\"neco\" class=\"btn btn-warning\" /></form>";
  }                         
  echo "</div>
                        </div>";

?>