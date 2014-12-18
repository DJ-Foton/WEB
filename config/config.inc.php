<?php

/**
 * Hlavni konfiguracni soubor.
 * 
 * Tady by mely byt vsechny duletize informace typu pripojeni k db, 
 * prefixy db tabulek a nazvy tabulek. Pro nazvy sloupcu tabulek neni treba
 * zakladat vlastni konstanty.
 *  
 */

	/**
	 * Configuration for: Error reporting
	 * Useful to show every little problem during development, but only show hard errors in production
	 */
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	/**
	 * URL projektu.
	 * Lokalni stroj: "127.0.0.1" nebo "localhost" + cesta k home adresari projektu s index.php
	 */
	define('WEB_DOMAIN', 'localhost');

	/**
	 * Pripojeni k DB.
	 */
	
	// lokalni 
	define('DB_TYPE', 'mysql');
	define('DB_HOST', '127.0.0.1');
	define('DB_DATABASE_NAME', 'jelen');
	define('DB_USER_LOGIN', 'root');
	define('DB_USER_PASSWORD', '');

	
	
	/**
	 * Tady jsou ruzna databazova nastaveni.
	 */
	
	// prefix vsech mych tabulek
	//define('TABLE_PREFIX', 'madostal_');
	
	// tabulka predmetu
	//define('menu', TABLE_PREFIX.'predmety');
?>