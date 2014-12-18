<div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Vložení Fotky do slideshow</h3>
                            </div>
                            <div class="panel-body">
                                
<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (@$_POST['neco']){
if (@$_FILES['slid'] != null){
    $info = pathinfo($_FILES['slid']['name']);
    list($width, $height, $type, $attr) = getimagesize($_FILES['slid']['tmp_name']);
    if ($width == 960 && $height == 300){

    $dir = '../images/slideshow/'.$_FILES['slid']['name'];
    while (file_exists ($dir)){
        $pom = explode (".", $dir);
        $pom[count($pom)-2] .= "a";
        $dir = implode (".", $pom);
    }
    unset ($pom);
    
   if ( @!move_uploaded_file ($_FILES['slid']['tmp_name'], $dir)){
       echo "<div class=\"alert alert-danger\">
                    <strong>Chyba! </strong> Soubor se nepodařilo uložit do adresáře.
                </div>";
   } else {
    $exp = explode ("/", $dir);
    addSlide ($exp[count($exp)-1], $m);
    unset($exp);
    unset($width, $height, $type, $attr);
       echo "<div class=\"alert alert-success\">
                    <strong>Úspěch! </strong> Fotografie ".$exp[count($exp)-1]." byla ulozena do slideshow.
                </div>";
   }
    } else {
        echo "<div class=\"alert alert-danger\">
                    <strong>Chyba! </strong> Obrázek nemá požadované rozměry.
                </div>";
    }
}
else
{
    echo "<div class=\"alert alert-danger\">
                    <strong>Chyba! </strong> Nebyl vybrán žádný soubor.
                </div>";
} 
}
    
    echo "<form action=\"$actual_link\" method=\"post\" style=\"text-align: center\" enctype=\"multipart/form-data\">
    <div class=\"panel panel-default\"  style=\"width: 444px; margin: 0 auto;\">
                    <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd; height: 60px\">
                    <h3 class=\"panel-title\">Nahrat fotku do slideshow (sirka: 960px, vyska: 300px):</h3>
                                <input type=\"file\" name=\"slid\" style=\"float: right;\" />
                            </div>
                        </div><br>

<input type=\"submit\" name=\"neco\" value=\"Nahrat\" class=\"btn btn-primary\" />
</form>
                                
                                </div>
                        </div>";

    function addSlide ($nazev, $m){
        $array = array (array("column"=>"id_slideshow", "value_mysql"=>"NULL"),
                    array("column"=>"name", "value_mysql"=>"\"$nazev\""));
   $neco = $m ->Insert("slideshow", $array);
    }
?>