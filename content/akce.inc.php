<?php
$akce = $m->LoadAll("akce");
$s = "";
foreach ($akce as $key=>$value){
    $s.= "<h4>";
    $s.= $value['nazev'];
    $s.= "</h4>";
    $pom = explode ("-n-", $value['popis_akce']);
    foreach ($pom as $p){
        $s.= "<h6>";
        $s.= $p;
        $s.= "</h6>";
    }
    unset ($p);
}
echo $s;
?>