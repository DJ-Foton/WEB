<?php
    session_start();
    if(isset($_POST['ok']))
    {
       login ();
    }

    $url = @$_REQUEST["url"];
    if ($url == null && @$_SESSION['authuser'] == 1){
        $url = "uvod";
    } else if (@$_SESSION['authuser'] != 1){
        $url = "login";
    } else if ($url == "logoff"){
        logoff();
    }
// nacist konfiguraci
	require '../config/config.inc.php';
	require '../config/functions.inc.php';					// pomocne funkce
	
	// nacist objekty - soubory .class.php
	require '../application/core/app.class.php';			// drzi hlavni funkcionalitu cele aplikace, obsahuje routing = navigovani po webu
	require '../application/core/db.class.php';			// zajisti pristup k db a spolecne metody pro dalsi pouziti
	require '../application/core/all.class.php';		// zajisti pristup ke konkretnim db tabulkam - objekt vetsinou zajisti pristup k cele sade souvisejicich tabulek
	
	// start the application
	$app = new app();
	
	// pripojit k db
	$app->Connect();
	
	// pripojeni k db
	$db_connection = $app->GetConnection();
	
	// vytvorit objekt, ktery mi poskytne pristup k DB a vlozit mu connector k DB
	$m = new all($db_connection);

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
	require_once '../Twig/lib/Twig/Autoloader.php';
	Twig_Autoloader::register();

	// cesta k adresari se sablonama - od index.php
	$loader = new Twig_Loader_Filesystem('templates');
	$twig = new Twig_Environment($loader); // takhle je to bez cache
    

    if ($url == "login"){
        // nacist danou sablonu z adresare
	$template = $twig->loadTemplate('login.htm');
        echo $template->render(array());
    } else {
        $template = $twig->loadTemplate('others.htm');
    // nacist danou sablonu z adresare
	echo $template->render(array('menu' => menu($url), 'body' => $obsah));
    }


    function logoff(){
    $_SESSION ['authuser'] = 0;
        header ("Location: /admin/");
    }

    function login () {
    $pass = "2Nadrazni8Pernink4";
    if ($_POST['heslo'] == $pass){
        $_SESSION['authuser'] = 1;
    }
    }

    function menu ($url){
    $prvky = array("Rezervace", "Akce", "Fotogalerie", "Fotky", "Slideshow");
    $s = "";
        foreach($prvky as $value){
            $s.="<li";
            if ($value."pr" == $url || $value."od" == $url || $value."up" == $url){
                $s.=" class=\"active\"";         
            }
           $s.= "><a href=\"javascript:;\" data-toggle=\"collapse\" data-target=\"#$value\"><i class=\"fa fa-fw fa-arrows-v\"></i> $value <i class=\"fa fa-fw fa-caret-down\"></i></a>
                        <ul id=\"$value\" class=\"collapse\">
                            <li>
                                <a href=\"".$value."pr\"><i class=\"fa fa-fw fa-file\"></i> Přidat</a>
                            </li>
                            <li>
                                <a href=\"".$value."od\"><i class=\"fa fa-fw fa-edit\"></i> Odebrat</a>
                            </li>";
            if ($value != "Slideshow" && $value != "Rezervace"){
                $s.="<li>
                                <a href=\"".$value."up\"><i class=\"fa fa-fw fa-wrench\"></i> Upravit</a>
                            </li>";
            }
             $s.="</ul>
                    </li>";                
        }
        unset ($value);
    return $s;
    }

?>