<div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title">Odebrání fotogalerií</h3>
                            </div>
                            <div class="panel-body">
                                
<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (@$_POST['neco']){
    $fota = $m->LoadAll("fotka");
    foreach ($_POST as $key=>$value){
        $je = false;
        if ($key != "neco"){   
        foreach ($fota as $k=>$v){
            if ($v['fotogalerie_id_fotogalerie'] == $value){
                $je = true;
                echo "<div class=\"alert alert-danger\">
                    <strong>Chyba! </strong> Fotogalerie ".$key." obsahuje fotky. Před odstraněním fotogalerie tyto fotky smažte.
                </div>";
                break;
            } 
        }
        unset ($v, $k);
        if ($je == false){
            $m -> DeleteByID("fotogalerie", $value);
            echo "<div class=\"alert alert-success\">
                    <strong>Úspěch! </strong> Smazání fotogalerie ".$key." proběhlo úspěšně.
                </div>";
        }
        }
    }
    unset ($value, $key);
    }

$fotogalerie = $m->LoadAll("fotogalerie");

    echo "<form action=\"$actual_link\" method=\"post\" style=\"text-align: center\">";
    foreach ($fotogalerie as $value=>$key){
       echo "<div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\"><input type=\"checkbox\" name=\"".$key['nazev']."\" value=\"".$key['id_fotogalerie']."\" /> ".$key['nazev']."</h3>
                            </div>
                        </div><br>";
       
    }
    unset ($value, $key);
    echo "<input type=\"submit\" value=\"Odebrat\" name=\"neco\" class=\"btn btn-danger\" onclick=\"
    return confirm('Opravdu chcete vybrané fotogalerie smazat?')\" /></form>";                        
?>
                                
                                </div>
                        </div>