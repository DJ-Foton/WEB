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

<div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title">Odebrání fotek</h3>
                            </div>
                            <div class="panel-body">
                            
<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (@$_POST['neco']){
    $i = 0;
    foreach ($_POST as $key=>$value){
        if ($key != "neco"){
            $i++;
            $m -> DeleteByID("fotka", $key);
            $soubor = "../images/gallery/".$value;
            unlink ($soubor);
            $soubor = "../images/gallery/thumbnails/".$value;
            unlink ($soubor);
            echo "<div class=\"alert alert-success\">
                    <strong>Úspěch! </strong> Smazání $i fotografií proběhlo úspěšně.
                </div>";
        }
    }
    unset ($key, $value);
}

$galery = $m->LoadAll("fotogalerie");
$foto = $m->LoadAll("fotka");

echo "<form action=\"$actual_link#reserve\" method=\"post\" enctype=\"multipart/form-data\" style=\"text-align: center\">";
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
                                    <input type=\"checkbox\" name=\"".$v['id_fotka']."\" value=\"".$v['nazev']."\" />
                                    <a href=\"../images/gallery/".$v['nazev']."\"><img src=\"../images/gallery/thumbnails/".$v['nazev']."\" alt=\"\" title=\"".$v['alt']."\" /></a></div></div></div>";
                                }
                            }
    unset ($k, $v);
                          echo "</div>
                        </div><br>";
}
unset ($key, $value);
echo "<input type=\"submit\" value=\"Odebrat\" name=\"neco\" class=\"btn btn-danger\" onclick=\"
    return confirm('Opravdu chcete vybrané fotky smazat?')\" /></form>
                           
    </div>
                        </div>";

?>