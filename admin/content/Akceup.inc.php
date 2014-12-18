<div class="panel panel-yellow">
                            <div class="panel-heading">
                                <h3 class="panel-title">Úpravy akcí</h3>
                            </div>
                            <div class="panel-body">
                                
<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$akce = $m->LoadAll("akce");

if (@$_POST['neco']){
       echo "<form action=\"$actual_link\" method=\"post\" style=\"text-align: center\">
    <h5>Pro novou řádku napište -n- , např.: \"Ahoj-n-jak se máš?\"</h5>";
        foreach ($akce as $value=>$key){
           if ($key['id_akce'] == $_POST['akce']){
                echo "<div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">nazev akce:</h3><input type=\"text\" name=\"nazev\" value=\"".$key['nazev']."\" />
                            </div>
                        </div><br>
                        
                        <div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">popis akce:</h3><textarea type=\"text\" name=\"text\" cols=\"22\" rows=\"6\">".$key['popis_akce']."</textarea>
                            </div>
                        </div><br>
    
    <input type=\"hidden\" name=\"test\" value=\"neco\" />
    <div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">nazev akce de:</h3><input type=\"text\" name=\"nazev_de\" value=\"".$key['nazev_de']."\" />
                            </div>
                        </div><br>
                        
                        <div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">popis akce de:</h3><textarea type=\"text\" name=\"text_de\" cols=\"22\" rows=\"6\">".$key['popis_akce_de']."</textarea>
                            </div>
                        </div><br>
                        
<div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">nazev akce en:</h3><input type=\"text\" name=\"nazev_en\" value=\"".$key['nazev_en']."\" />
                            </div>
                        </div><br>    
    
                        <div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">popis akce en:</h3><textarea type=\"text\" name=\"text_en\" cols=\"22\" rows=\"6\">".$key['popis_akce_en']."</textarea>
                            </div>
                        </div><br>
                        <input type=\"hidden\" name=\"id\" value=\"".$key['id_akce']."\" />";
           } 
        }
        unset ($value, $key);
        echo "<input type=\"submit\" value=\"Upravit\" name=\"upravy\" class=\"btn btn-warning\" onclick=\"
                return confirm('Opravdu chcete provedené změny uložit?')\" /></form>";
    } else {
    if (@$_POST['upravy']){
        $items = array (array("column"=>"nazev", "value_mysql"=>"\"".$_POST['nazev']."\""),
                    array("column"=>"popis_akce", "value_mysql"=>"\"".$_POST['text']."\""),
                    array("column"=>"nazev_de", "value_mysql"=>"\"".$_POST['nazev_de']."\""),
                    array("column"=>"popis_akce_de", "value_mysql"=>"\"".$_POST['text_de']."\""),
                   array("column"=>"nazev_en", "value_mysql"=>"\"".$_POST['nazev_en']."\""),
                    array("column"=>"popis_akce_en", "value_mysql"=>"\"".$_POST['text_en']."\""));
        $m->UpdateDB("akce", $items, $_POST['id']);
        echo "<div class=\"alert alert-success\">
                    <strong>Úspěch! </strong> Úpravy byly úspěšně uloženy.
                </div>";
    }
    $akce = $m->LoadAll("akce");
        echo "<form action=\"$actual_link\" method=\"post\" style=\"text-align: center\">";
    foreach ($akce as $value=>$key){
       echo "<div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\"><input type=\"radio\" name=\"akce\" value=\"".$key['id_akce']."\" /> ".$key['nazev']."</h3>
                            </div>
                        </div><br>";
       
    }
    unset ($value, $key);
    echo "<input type=\"submit\" value=\"Upravit\" name=\"neco\" class=\"btn btn-warning\" \" /></form>";    
    }
?>
                                
                                </div>
                        </div>