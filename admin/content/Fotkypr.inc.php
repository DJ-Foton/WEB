<div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Vložení Fotky</h3>
                            </div>
                            <div class="panel-body">
                                
<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$fotogalerie = $m->LoadAll("fotogalerie");
$alt = @$_POST["alt"];
    $gal = @$_POST["gal"];

if (@$_POST['neco']){
        if ($alt != null){
if (@$_FILES['file'] != null){
if( $_FILES['file']['name'] != "")
{
    $info = pathinfo($_FILES['file']['name']);
    list($width, $height, $type, $attr) = getimagesize($_FILES['file']['tmp_name']);
    $dir = '../images/gallery/'.$_FILES['file']['name'];
    while (file_exists ($dir)){
        $pom = explode (".", $dir);
        $pom[count($pom)-2] .= "a";
        $dir = implode (".", $pom);
    }
    unset ($pom);
    
   if ( @!move_uploaded_file ($_FILES['file']['tmp_name'], $dir)){
       echo "<div class=\"alert alert-danger\">
                    <strong>Chyba! </strong> Soubor nelze ulozit do galerie.
                </div>";
   } else {
        $exp = explode ("/", $dir);
        $dir2 = '../images/gallery/thumbnails/'.$exp[count($exp)-1];
       make_thumb($dir, $dir2);
       addFoto($exp[count($exp)-1], $alt, $gal, $m);
        unset($exp);
        unset($width, $height, $type, $attr);
           echo "<div class=\"alert alert-success\">
                    <strong>Úspěch! </strong> Fotografie ".$exp[count($exp)-1]." byla ulozena do fotogalerie $gal.
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
        } else {
   echo "<div class=\"alert alert-danger\">
                    <strong>Chyba! </strong> Nezadali jste všechny povinné parametry.
                </div>";
}
}
    
    echo "<form action=\"$actual_link\" method=\"post\" style=\"text-align: center\" enctype=\"multipart/form-data\">
    <div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd; height: 45px;\">
                                <input type=\"file\" name=\"file\" style=\"float: right;\" />
                            </div>
                        </div><br>

<div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
<div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">popisek fotky:</h3><input type=\"text\" name=\"alt\" style=\"color: #000\" />
                            </div>
                        </div><br>
                        
                        <div class=\"panel panel-default\"  style=\"width: 300px; margin: 0 auto;\">
                        <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h3 class=\"panel-title\">galerie:</h3><select name=\"gal\" style=\"color: #000\">";
                            
$s = "";
    foreach ($fotogalerie as $key=>$value){
        $s.= "<option ";
        if ($s == "<option "){
            $s.= "selected ";
        }
        $s.= "name=\"".$value['nazev']."\" value=\"";
        $s.= $value['id_fotogalerie'];
        $s.= "\">".$value['nazev']."</option>";
    }
    unset ($key, $value);
echo $s;
 echo "</select></div>
                        </div><br>
<input type=\"submit\" name=\"neco\" value=\"Nahrat\" class=\"btn btn-primary\" />
</form>
                                
                                </div>
                        </div>";

function make_thumb($src, $dest) {
    $sirka = 120;
    $vyska = 90;
	/* read the source image */
	$source_image = imagecreatefromjpeg($src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	$desiret_width = $sirka;
	/* find the "desired height" of this thumbnail, relative to the desired width  */
	$desired_height = floor($height * ($sirka / $width));
	
    if ($desired_height < $vyska){
        $desired_height = $vyska;
        $desiret_width = floor($width * ($vyska/$height));
    }
    
	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desiret_width, $desired_height);
	
	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desiret_width, $desired_height, $width, $height);
    
	$to_crop_array = array('x' =>0 , 'y' => 0, 'width' => $sirka, 'height'=> $vyska);
    $thumb_im = imagecrop($virtual_image, $to_crop_array);
    
	/* create the physical thumbnail image to its destination */
	imagejpeg($thumb_im, $dest);
}

function addFoto($nazev, $alt, $gal, $m){
    $array = array (array("column"=>"id_fotka", "value_mysql"=>"NULL"),
                    array("column"=>"nazev", "value_mysql"=>"\"$nazev\""),
                    array("column"=>"alt", "value_mysql"=>"\"$alt\""),
                    array("column"=>"fotogalerie_id_fotogalerie", "value_mysql"=>"$gal"));
   $neco = $m ->Insert("fotka", $array);   
}

?>