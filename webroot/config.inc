<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('output_buffering', 0);

	ini_set('xdebug.var_display_max_data', -1);
	ini_set('xdebug.var_display_max_children', -1);
	ini_set('xdebug.var_display_max_depth', -1);

	define('ANASSA_INSTALL_PATH', __DIR__."/..");
	define('ANASSA_THEME_PATH', ANASSA_INSTALL_PATH."/theme/render.inc");
	
	include(ANASSA_INSTALL_PATH."/src/bootstrap.inc");
	include(ANASSA_INSTALL_PATH."/theme/functions.inc");

	session_name(preg_replace("/[^a-z\d]/i", "", __DIR__));
	session_start();
	
	$anassa=array();
	$anassa['lang']="sv";
	$anassa['title_prefix']="ANASSA - ";
	$anassa['favicon']="favicon.ico";
	$anassa['css']=array(
		"css/common.css"
		);
	$anassa['js']=array(
		"js/common.js",
		"js/modernizr.custom.30889.js"
		);
	$anassa['gat_ua']="UA-54672703-2";
	$anassa['header']="
		<span class='siteTitle'>Anassa</span>
		<span class='siteSlogan'>{ Drottning över de pyttesmå PHP-ramverken }</span>";
	$anassa['header_sub']="";
	$anassa['menu_top']=array(
		'item'=>array(
				'home'=>array(
					'text'=>"Hem",
					'url'=>"home.php",
					'img'=>"menu_symbol_home.png",
					'title'=>"Borta bra, men hemma bäst"),
				'me'=>array(
					'text'=>"Om mig",
					'url'=>"me.php",
					'img'=>null,
					'title'=>"En liten presentation av mig själv"),
				'kmoms'=>array(
					'text'=>"Redovisning",
					'url'=>"kmoms.php",
					'img'=>null,
					'title'=>"Redovisning av kursmomenten"),
				'source'=>array(
					'text'=>"Källkod",
					'url'=>"source.php",
					'img'=>null,
					'title'=>"Kika på källkoden"),
				'vardump'=>array(
					'text'=>"varDump",
					'url'=>"vardump.php",
					'img'=>null,
					'title'=>"Dumpning av Anassa!"),
				'error404'=>array(
					'text'=>"error 404",
					'url'=>"jag_letar_efter_en_annan_sida.php",
					'img'=>null,
					'title'=>"ERROR 404"),
				'dice'=>array(
					'text'=>"Tärningspel",
					'url'=>"",//dice.php",
					'img'=>null,
					'title'=>"Tärningspel"),
				'calendar'=>array(
					'text'=>"Kalender",
					'url'=>"",//"calendar.php",
					'img'=>null,
					'title'=>"Kalender"),
				'ctrlTest'=>array(
					'text'=>"ctrlTest",
					'url'=>"ctrlTest.php",
					'img'=>null,
					'title'=>"ctrlTest")
				),
			'selected'=>function($url) {
				if (basename($_SERVER['SCRIPT_FILENAME'])==$url) {
					return true;
				}
			}
			);
	$anassa['main']="";
	$anassa['main_inc']=false;
	$anassa['footer']="
		<div class='left'>
			Copyright (c) Göran Hellberg [ <a href='mailto:cosmos3@telia.com'>cosmos3@telia.com</a> ]
		</div>
		<div class='right'>
			| ".txtLinkBlank('https://github.com/cosmos3/Anassa', 'Anassa på GitHub')."
			| ".txtLinkBlank('http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance', 'Unicorn')." |
		</div>";
?>