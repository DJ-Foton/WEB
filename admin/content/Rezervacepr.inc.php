<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"date1",
			dateFormat:"%Y-%m-%d",
            cellColorScheme:"ocean_blue"
		});
        new JsDatePick({
			useMode:2,
			target:"date2",
			dateFormat:"%Y-%m-%d",
            cellColorScheme:"ocean_blue"
		});
	};
</script>
<div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Vložení rezervace</h3>
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
        if ($key != "od" && $key != "do" && $key != "neco"){
            $l .= "$value/";
        }
    }
    unset ($key, $value);
    $resPokoje = explode("/", $l);
    array_pop ($resPokoje);
    $poleDatumu = createDateRangeArray($od, $do);
    saveDates($poleDatumu, $m);
    saveReservation($poleDatumu, $resPokoje, $m);
} else {
    echo "<div class=\"alert alert-danger\">
                    <strong>Chyba! </strong> Nezadali jste všechny povinné parametry.
                </div>";
}
}

$s="";
echo "<form action=\"$actual_link\" method=\"post\" enctype=\"multipart/form-data\" style=\"text-align: center\">";
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
echo "<input type=\"submit\" value=\"Uložit\" name=\"neco\" class=\"btn btn-primary\" /></form>
                           
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

function saveDates($pole, $m){
    $data = $m->LoadAll("datum");
    foreach ($pole as $den){
        $tmp = 0;
        foreach ($data as $key=>$ulozeny){
            if ($den == $ulozeny['rezervace']){
                $tmp = 1;
                break;
            }
        }
        unset ($key, $ulozeny);
        if ($tmp == 0){
            $array = array (array("column"=>"id_datum", "value_mysql"=>"NULL"),
                    array("column"=>"rezervace", "value_mysql"=>"\"$den\""));
            $neco = $m ->Insert("datum", $array);
        }
    }
    unset ($den); 
}

function saveReservation($datumy, $pokoje, $m){
    $dbData = $m->LoadAll("datum");
    $reserve = $m->LoadAll("datum_has_pokoj");
    foreach ($pokoje as $pokoj){
        $tmp = 0;
        foreach($dbData as $key=>$value){
            foreach($datumy as $datum){
                if ($datum == $value['rezervace']){
                    foreach ($reserve as $neco=>$res){
                        if ($res['datum_id_datum'] == $value['id_datum'] && $res['pokoj_id_pokoj'] == $pokoj){
                            $tmp = 1;
                            echo "<div class=\"alert alert-danger\">
                                        <strong>Chyba! </strong> Pokoj ".$pokoj." je na datum ".$value['rezervace']." zerezervovany..!.
                                    </div>";
                        }
                    }
                    unset ($neco, $res);
                }
            }
            unset ($datum);
        }
        unset ($key, $value);
        if ($tmp == 1){
                        return;
            }
        foreach($dbData as $key=>$value){
            foreach($datumy as $datum){
                if ($datum == $value['rezervace']){
                    $array = array (array("column"=>"datum_id_datum", "value_mysql"=>"".$value['id_datum'].""),
                             array("column"=>"pokoj_id_pokoj", "value_mysql"=>"".$pokoj.""));
                    $neco = $m ->Insert("datum_has_pokoj", $array); 
                    }
            }
            unset ($datum);
        }
        unset ($key, $value);
    }
    unset ($pokoj);
        echo "<div class=\"alert alert-success\">
                    <strong>Úspěch! </strong> Uložení rezervace proběhlo úspěšně.
                </div>";
}


?>