<div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title">Odebrání akce</h3>
                            </div>
                            <div class="panel-body">
                                
<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$akce = $m->LoadAll("akce");

if (@$_POST['neco']){
    foreach ($_POST as $key=>$value){
        if ($key != "neco"){   
        foreach ($akce as $k=>$v){
            if ($v['id_akce'] == $value){
                $m -> DeleteByID("akce", $value);
                echo "<div class=\"alert alert-success\">
                    <strong>Úspěch! </strong> Smazání akce ".$key." proběhlo úspěšně.
                </div>";
            } 
        }
        unset ($v, $k);
        }
    }
    unset ($value, $key);
    }
    $akce = $m->LoadAll("akce");
    echo "<form action=\"$actual_link\" method=\"post\" style=\"text-align: center\">";
    foreach ($akce as $value=>$key){
       echo "<div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\"><input type=\"checkbox\" name=\"".$key['nazev']."\" value=\"".$key['id_akce']."\" /> ".$key['nazev']."</h3>
                            </div>
                        </div><br>";
       
    }
    unset ($value, $key);
    echo "<input type=\"submit\" value=\"Odebrat\" name=\"neco\" class=\"btn btn-danger\" onclick=\"
    return confirm('Opravdu chcete vybrané fotogalerie smazat?')\" /></form>";                        
?>
                                
                                </div>
                        </div>