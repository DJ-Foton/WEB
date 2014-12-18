<div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Vložení akce</h3>
                            </div>
                            <div class="panel-body">
                                
<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $name = @$_POST["nazev"];
    $text = @$_POST["text"];
    $name_de = @$_POST["nazev_de"];
    $text_de = @$_POST["text_de"];
    $name_en = @$_POST["nazev_en"];
    $text_en = @$_POST["text_en"];
if (@$_POST['neco']){
if ($name != null && $text !=null && $name_de != null && $text_de !=null && $name_en != null && $text_en !=null){
    addAkce($name, $text, $name_de, $text_de, $name_en, $text_en, $m);
    echo "<div class=\"alert alert-success\">
                    <strong>Úspěch! </strong> Uložení akce $name proběhlo úspěšně.
                </div>";
    } else {
        echo "<div class=\"alert alert-danger\">
                    <strong>Chyba! </strong> Nezadali jste všechny povinné parametry.
                </div>";
}
}

    echo "<form action=\"$actual_link\" method=\"post\" style=\"text-align: center\">
    <h5>Pro novou řádku napište -n- , např.: \"Ahoj-n-jak se máš?\"</h5>
    <div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">nazev akce:</h3><input type=\"text\" name=\"nazev\" />
                            </div>
                        </div><br>
                        
                        <div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">popis akce:</h3><textarea type=\"text\" name=\"text\" cols=\"22\" rows=\"6\"></textarea>
                            </div>
                        </div><br>
    
    <input type=\"hidden\" name=\"test\" value=\"neco\" />
    <div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">nazev akce de:</h3><input type=\"text\" name=\"nazev_de\" />
                            </div>
                        </div><br>
                        
                        <div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">popis akce de:</h3><textarea type=\"text\" name=\"text_de\" cols=\"22\" rows=\"6\"></textarea>
                            </div>
                        </div><br>
                        
<div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">nazev akce en:</h3><input type=\"text\" name=\"nazev_en\" />
                            </div>
                        </div><br>    
    
                        <div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">popis akce en:</h3><textarea type=\"text\" name=\"text_en\" cols=\"22\" rows=\"6\"></textarea>
                            </div>
                        </div><br>
    
    <input type=\"submit\" value=\"Uložit\" name=\"neco\" class=\"btn btn-primary\" /></form>
                                
                                </div>
                        </div>";

function addAkce($nazev, $text, $nazev_de, $text_de, $nazev_en, $text_en, $m){
    $array = array (array("column"=>"id_akce", "value_mysql"=>"NULL"),
                    array("column"=>"nazev", "value_mysql"=>"\"$nazev\""),
                    array("column"=>"popis_akce", "value_mysql"=>"\"$text\""),
                    array("column"=>"nazev_de", "value_mysql"=>"\"$nazev_de\""),
                    array("column"=>"popis_akce_de", "value_mysql"=>"\"$text_de\""),
                   array("column"=>"nazev_en", "value_mysql"=>"\"$nazev_en\""),
                    array("column"=>"popis_akce_en", "value_mysql"=>"\"$text_en\""));
   $neco = $m ->Insert("akce", $array);   
}

?>