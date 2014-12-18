<?php

    $url = @$_REQUEST["url"];
    if ($url == null){
        $url = "uvod";
    }
// nacist konfiguraci
	require 'config/config.inc.php';
	require 'config/functions.inc.php';					// pomocne funkce
	
	// nacist objekty - soubory .class.php
	require 'application/core/app.class.php';			// drzi hlavni funkcionalitu cele aplikace, obsahuje routing = navigovani po webu
	require 'application/core/db.class.php';			// zajisti pristup k db a spolecne metody pro dalsi pouziti
	require 'application/core/all.class.php';		// zajisti pristup ke konkretnim db tabulkam - objekt vetsinou zajisti pristup k cele sade souvisejicich tabulek
	
	// start the application
	$app = new app();
	
	// pripojit k db
	$app->Connect();
	
	// pripojeni k db
	$db_connection = $app->GetConnection();
	
	// vytvorit objekt, ktery mi poskytne pristup k DB a vlozit mu connector k DB
	$m = new all($db_connection);

    $menu = $m->LoadAll("menu");

    $poleObr = $m->LoadAll("slideshow");

    $nazev_souboru = "content/$url.inc.php";

	if (file_exists($nazev_souboru) && !is_dir($nazev_souboru))
	{
        ob_start();
        include($nazev_souboru);
        $obsah = ob_get_clean();
	} 
// Twig stahnout z githubu - klidne staci zip a dat do slozky twig-master
		// kontrolu provedete dle umisteni souboru Autoloader.php, ktery prikladam pro kontrolu
	
	// nacist twig - kopie z dokumentace
	require_once 'Twig/lib/Twig/Autoloader.php';
	Twig_Autoloader::register();

	// cesta k adresari se sablonama - od index.php
	$loader = new Twig_Loader_Filesystem('templates');
	$twig = new Twig_Environment($loader); // takhle je to bez cache
    

    if ($url == "uvod" || $url == "about-us" || $url == "uber-uns"){
        $akceDir = "content/akce.inc.php";
        if ($url == "about-us"){
           $akceDir = "content/action.inc.php";
        } else if ($url == "uber-uns"){
           $akceDir = "content/aktion.inc.php";
        }
        ob_start();
        include($akceDir);
        $akce = ob_get_clean();
        // nacist danou sablonu z adresare
	$template = $twig->loadTemplate('uvod.htm');
        echo $template->render(array('menu' => nactiMenu($menu, $url), 'slideshow' => nactiSlideshow($poleObr), 'body' => $obsah, 'akce' => $akce, 'footer' => nactiFooter ($menu)));
    } else {
        $template = $twig->loadTemplate('view.htm');
    // nacist danou sablonu z adresare
	echo $template->render(array('menu' => nactiMenu($menu, $url), 'slideshow' => nactiSlideshow($poleObr), 'body' => $obsah, 'footer' => nactiFooter ($menu)));
    } 

    function nactiMenu($urlMenu, $url){
        $s = "<ul>";
        
        foreach($urlMenu as $key=>$value){
            $s.= "<li><a href=\""; 
            $s.= $value['url']."\"";
                if ($value['url'] == $url){
                $s.= " class=\"current\"";
                }
            $s.= "> ";
            $s.= $value['nazev'];
            $s.= " </a></li>";
        } 
        unset($value, $key);
        $s.= "</ul>";
        return $s;
    }

    function nactiFooter($urlMenu){
        $s = "<ul>";
        $pole = array ();
        foreach($urlMenu as $key =>$value){
            $pom = "<li><a href=\""; 
            $pom.= $value['url']."\"";
            $pom.= "> ";
            $pom.= $value['nazev'];
            $pom.= " </a></li>";
            $pole[] = $pom;
        }
        unset($value, $key);
        $s .= implode(" &#124 ", $pole);
        $s.= "</ul>";
        return $s;
    }

    function nactiSlideshow($poleObr){
        $i = 1;
        $s = "";
        shuffle ($poleObr);
        foreach ($poleObr as $key =>$value){
            $s.= "<img src=\"images/slideshow/";
            $s.= $value['name'];
            $s.= "\" style=\"position: absolute; top: 0px; left: 0px; display: block; z-index: ";
            $s.=$i;
            $s.= "; opacity: 0; width: 956px; height: 300px;\">";
            $i++;
        }
        unset ($key, $value);
        return $s;
    }
	
    function zjistiJazykMenu ($pole, $url){
        $fin = 0;
        foreach ($pole as $key=>$value){
            if ($url == $value['url']){
                $fin = 1;
                break;
            }
        }
        return $fin;
    }

?>