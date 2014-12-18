<div class="panel panel-yellow">
                            <div class="panel-heading">
                                <h3 class="panel-title">Úpravy fotogalerií</h3>
                            </div>
                            <div class="panel-body">
                                
<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$fotogalerie = $m->LoadAll("fotogalerie");

if (@$_POST['neco']){
       echo "<form action=\"$actual_link\" method=\"post\" style=\"text-align: center\">";
        foreach ($fotogalerie as $value=>$key){
           if ($key['id_fotogalerie'] == $_POST['radio']){
                echo "<div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">nazev galerie:</h3><input type=\"text\" value=\"".$key['nazev']."\" name=\"nazev\" style=\"color: #000\" />
                            </div>
                        </div><br>

    <div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">nazev galerie en:</h3><input type=\"text\" value=\"".$key['nazev_en']."\" name=\"nazev_en\" style=\"color: #000\" />
                            </div>
                        </div><br>
<div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">nazev galerie de:</h3><input type=\"text\" value=\"".$key['nazev_de']."\" name=\"nazev_de\" style=\"color: #000\" />
                            </div>
                        </div><br>
                        <input type=\"hidden\" name=\"id\" value=\"".$key['id_fotogalerie']."\" />";
           } 
        }
        unset ($value, $key);
        echo "<input type=\"submit\" value=\"Upravit\" name=\"upravy\" class=\"btn btn-warning\" onclick=\"
                return confirm('Opravdu chcete provedené změny uložit?')\" /></form>";
    } else {
    if (@$_POST['upravy']){
        $items = array (array("column"=>"nazev", "value_mysql"=>"\"".$_POST['nazev']."\""),
                    array("column"=>"nazev_de", "value_mysql"=>"\"".$_POST['nazev_de']."\""),
                   array("column"=>"nazev_en", "value_mysql"=>"\"".$_POST['nazev_en']."\""));
        $m->UpdateDB("fotogalerie", $items, $_POST['id']);
        echo "<div class=\"alert alert-success\">
                    <strong>Úspěch! </strong> Úpravy byly úspěšně uloženy.
                </div>";
    }
    $fotogalerie = $m->LoadAll("fotogalerie");
        echo "<form action=\"$actual_link\" method=\"post\" style=\"text-align: center\">";
        foreach ($fotogalerie as $value=>$key){
           echo "<div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                                <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                    <h3 class=\"panel-title\"><input type=\"radio\" name=\"radio\" value=\"".$key['id_fotogalerie']."\" /> ".$key['nazev']."</h3>
                                </div>
                            </div><br>";

        }
        unset ($value, $key);
        echo "<input type=\"submit\" value=\"Upravit\" name=\"neco\" class=\"btn btn-warning\" /></form>";   
    }
?>
                                
                                </div>
                        </div>