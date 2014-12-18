<img src="images/icons/menu.png" style="float: right; padding: 0 5px 0 0;">
<h4>Jídelní lístek</h4>

<?php
    $kategorie = $m->LoadAll("kategorie_jidel");
    $jidla = $m->LoadAll("jidlo");
    foreach ($kategorie as $key=>$typ){
        $s = "<div id=\"table\"><h4>";
        $s.= $typ['nazev'];
        $s.= "</h4>";
        $s .= "<table class=\"table table-hover table-bordered\"\">";
        $s.= "<thead><tr style=\"background-color:#eee;\"><th style=\"width: 8%\">Gramáž</th><th>Název</th><th style=\"width: 8%\">Cena</th></tr></thead>";
        foreach($jidla as $klic=>$value){
            if ($typ['id_kategorie_jidel'] == $value['kategorie_jidel_id_kategorie_jidel']){
                $s.= "<tr><td>";
                $s.= $value['gramy'];
                $s.= "</td><td>";
                $s.= $value['nazev'];
                $s.= "</td><td>";
                $s.= $value['cena'];
                $s.= ",-</td></tr>";
            }
        }
        unset($value, $klic);
        $s.= "</table></div>";
        echo $s;
    }
unset($typ, $key);
?>

<h6>Všechny pokrmy lze upravit na poloviční porci se 75% cenou.</h6>