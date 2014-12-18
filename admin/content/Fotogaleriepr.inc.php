<div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Vložení fotogalerie</h3>
                            </div>
                            <div class="panel-body">
                                
<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (@$_POST["nazev"] != null && @$_POST["nazev_en"] != null && @$_POST["nazev_de"] != null){
       addFotogal($_POST["nazev"], $_POST["nazev_de"], $_POST["nazev_en"], $m);
    echo "<div class=\"alert alert-success\">
                    <strong>Úspěch! </strong> Uložení fotogalerie ".$_POST["nazev"]." proběhlo úspěšně.
                </div>";
    } else if (@$_POST['test'] == "neco"){
      echo "<div class=\"alert alert-danger\">
                    <strong>Chyba! </strong> Nezadali jste všechny povinné parametry.
                </div>";
    }

    echo "<form action=\"$actual_link\" method=\"post\" style=\"text-align: center\">
    <div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">nazev galerie:</h3><input type=\"text\" name=\"nazev\" style=\"color: #000\" />
                            </div>
                        </div><br>
    
    <input type=\"hidden\" name=\"test\" value=\"neco\" />
    <div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">nazev galerie en:</h3><input type=\"text\" name=\"nazev_en\" style=\"color: #000\" />
                            </div>
                        </div><br>
<div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">nazev galerie de:</h3><input type=\"text\" name=\"nazev_de\" style=\"color: #000\" />
                            </div>
                        </div><br>
    
    
    <input type=\"submit\" value=\"Uložit\" name=\"neco\" class=\"btn btn-primary\" /></form>
                                
                                </div>
                        </div>";
function addFotogal($nazev, $nazev_de, $nazev_en, $m){
    $array = array (array("column"=>"id_fotogalerie", "value_mysql"=>"NULL"),
                    array("column"=>"nazev", "value_mysql"=>"\"$nazev\""),
                    array("column"=>"nazev_de", "value_mysql"=>"\"$nazev_de\""),
                   array("column"=>"nazev_en", "value_mysql"=>"\"$nazev_en\""));
   $neco = $m ->Insert("fotogalerie", $array);   
}

?>