<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"date1",
			dateFormat:"%Y-%m-%d",
            cellColorScheme:"purple"
		});
        new JsDatePick({
			useMode:2,
			target:"date2",
			dateFormat:"%Y-%m-%d",
            cellColorScheme:"purple"
		});
	};
</script>

<div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title">Odebrání rezervace</h3>
                            </div>
                            <div class="panel-body">
                            
<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$pokoje = $m->LoadAll("pokoj");
    $od = @$_POST["od"];
    $do = @$_POST["do"];
if (@$_POST['neco']){
if ($od != null && $do != null){
    $l = "";
    foreach ($_POST as $key=>$value){
        if ($key != "od" && $key != "do" && $key !="neco"){
            $l .= "$value/";
        }
    }
    unset ($key, $value);
    $resPokoje = explode("/", $l);
    array_pop ($resPokoje);
    $poleDatumu = createDateRangeArray($od, $do);
    foreach ($resPokoje as $pokoj){
        foreach($poleDatumu as $datum){
            $array = array (array ("column"=>"rezervace", "symbol"=>"=", "value_mysql"=>"\"$datum\""));
            $date = $m->GetByID("datum", $array);
            $m->DeleteRByID("datum_has_pokoj", $pokoj, $date['id_datum']);
        }
    }
    echo "<div class=\"alert alert-success\">
                    <strong>Úspěch! </strong> Odebrání rezervace proběhlo úspěšně.
                </div>";
} else {
    echo "<div class=\"alert alert-danger\">
                    <strong>Chyba! </strong> Nezadali jste všechny povinné parametry.
                </div>";
}
}

$s="";
echo "<form action=\"$actual_link#reserve\" method=\"post\" enctype=\"multipart/form-data\" style=\"text-align: center\">";
echo "<div class=\"panel panel-default\"  style=\"width: 444px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
				<h5>od: &nbsp; <input name=\"od\" id=\"date1\" type=\"text\" /></h5>
                            </div>
                        </div><br>";
echo "<div class=\"panel panel-default\"  style=\"width: 444px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <h5>do: &nbsp; <input id=\"date2\" name=\"do\" type=\"text\" /></h5>
                            </div>
                        </div><br>";
    foreach ($pokoje as $key=>$value){
        $s.= "<div class=\"panel panel-default\"  style=\"width: 444px; margin: 0 auto;\">
                            <div class=\"panel-heading\" style=\"color: #333; background-color: #f5f5f5; border-color: #ddd;\">
                                <input type=\"checkbox\" name=\"Pokoj_".$value['id_pokoj']."\" value=\"".$value['id_pokoj']."\" /> ".$value['nazev']."
                            </div>
                        </div><br>";
    }
             unset ($key, $value);
echo $s;
echo "<input type=\"submit\" value=\"Odebrat\" name=\"neco\" class=\"btn btn-danger\" onclick=\"
    return confirm('Opravdu chcete vybrané rezervace smazat?')\" /></form>
                           
    </div>
                        </div>";

function createDateRangeArray($strDateFrom, $strDateTo)
{   
  
    $aryRange=array();

    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+=86400; // add 24 hours
            array_push($aryRange,date('Y-m-d',$iDateFrom));
        }
    }
    return $aryRange;
}

?>