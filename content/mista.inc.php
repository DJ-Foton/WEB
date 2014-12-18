<img src="images/icons/king11.png" style="float: right;">
<h4>Volná místa</h4>

<?php
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $ok = @$_POST["sel"];

   $mes = date('n');
    $rok = date ('Y');
    $s = "<div style=\"text-align: center\" ><form action=\"$actual_link#content\" method=\"post\"><select name=\"sel\" style=\"text-align: center;\">";
    
    if ($ok == null){
        $ok = $mes."_".$rok; 
    }
for ($i =0;$i<7;$i++){
    if ($mes+$i >12){
        $mes-=12;
        $rok++;
    }
    $mesic = jmenoMesice($mes+$i);
    $s.= "<option ";
    if ($mes+$i."_".$rok == $ok || "0".($mes+$i)."_".$rok == $ok){
        $s.= "selected ";
    }
    $s.= "name=\"$mesic\" value=\"";
    if ($mes+$i < 10){
    $s.="0";
    }
    $s.= $mes+$i;
    $s.= "_";
    $s.= "$rok\">$mesic $rok</option>";
}
    $s.= "</select>&nbsp;<input type=\"submit\" value=\"ok\" name=\"ok\"></input></form></div>";
    echo $s;

        $tmp = explode ("_", $ok);
        $pokoje = $m->LoadAll("pokoj");
        $rezervace = $m->LoadAll("datum_has_pokoj");
        $datum = $m->LoadAll("datum");
        $num = cal_days_in_month (CAL_GREGORIAN, $tmp[0], $tmp[1]);
        $s="";
        foreach ($pokoje as $key=>$value){
            $s.= "<div id=\"table\"><h4>";
            $s.= $value['nazev'];
            $s.= "</h4>";
            $s.= "<table class=\"table table-bordered\"\">";
            $pom = 1;
            for ($i=1;$i<=($num/7)+1;$i++){
                $s.= "<tr>";
                for($j=1;$j<=7;$j++){
                    if ($pom > $num){
                        break;
                    }
                    $s.= "<td style=\"width: 14%; text-align: center; ";
                    if (date("d") > $pom && date("m") == $tmp[0] && date("Y")== $tmp[1]){
                        $s .= "background-color:#bbb ";
                    } else {
                    foreach ($rezervace as $ke=>$val){
                        if ($val['pokoj_id_pokoj'] == $value['id_pokoj']){
                            foreach ($datum as $k=>$v){
                                if ($val['datum_id_datum'] == $v['id_datum']){
                                    $pom2 = $pom;
                                    if ($pom <10){
                                        $pom2 = "0".$pom;
                                    }
                                    if($v['rezervace'] == $tmp[1]."-".$tmp[0]."-".$pom2){
                                    $s.= "background: url(images/icons/cross.png) center left no-repeat; background-color:#ffffff";
                                    break;
                                    }
                                } 
                            }
                            unset ($k, $v);
                        }
                    }
                    }
                    unset ($ke, $val);
                    $s.= "\">";
                    $s.= $pom;
                    $s.= "</td>";
                    $pom++;
                }
                $s.= "</tr>";
            }
                 $s.= "</table></div>";
        }
        
        unset ($key, $value);
        echo $s;

function jmenoMesice ($mes){
    $mesic = "";
    switch ($mes){
        case 1: $mesic = "Leden"; break;
        case 2: $mesic = "Únor"; break;
        case 3: $mesic = "Březen"; break;
        case 4: $mesic = "Duben"; break;
        case 5: $mesic = "Květen"; break;
        case 6: $mesic = "Červen"; break;
        case 7: $mesic = "Červenec"; break;
        case 8: $mesic = "Srpen"; break;
        case 9: $mesic = "Září"; break;
        case 10: $mesic = "Říjen"; break;
        case 11: $mesic = "Listopad"; break;
        case 12: $mesic = "Prosinec"; break;
    }
 return $mesic;   
}

?>