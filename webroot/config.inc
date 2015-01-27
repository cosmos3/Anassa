<?php
	ini_set("error_reporting", E_ALL);
	ini_set("display_errors", 1);
	ini_set("output_buffering", 0);
	ini_set("xdebug.var_display_max_data", -1);
	ini_set("xdebug.var_display_max_children", -1);
	ini_set("xdebug.var_display_max_depth", -1);
	include("_config.inc");
	date_default_timezone_set("Europe/Stockholm");
	define("ANASSA_INSTALL_PATH", __DIR__."/..");
	define("ANASSA_THEME_RENDER", ANASSA_INSTALL_PATH."/theme/render.inc");
	define("ANASSA_IMG_PATH", __DIR__.DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR);
	define("ANASSA_CACHE_PATH", __DIR__."/cache/");
	define("ANASSA_GALLERY_PATH", __DIR__.DIRECTORY_SEPARATOR."img");
	define("ANASSA_GALLERY_BASEURL", "");
	define("ANASSA_TABLE_USER", "oophp_user");
	define("ANASSA_TABLE_MOVIE", "oophp_movie");
	define("ANASSA_TABLE_MOVIE_PEOPLE", "oophp_movie_people");
	define("ANASSA_TABLE_MOVIE_PEOPLE_ALL", "oophp_movie_people_all");
	define("ANASSA_VTABLE_MOVIE", "oophp_movie_vtable");
	define("ANASSA_TABLE_CONTENT", "oophp_content");
	define("ANASSA_DELIMITER", "|");
	define("ANASSA_DELIMITER_SUB", ",");
	include(ANASSA_INSTALL_PATH."/src/bootstrap.inc");
	
	session_name(preg_replace("/[^a-z\d]/i", "", __DIR__));
	session_start();
	
	$anassa=array();
	$anassa["lang"]="sv";
	$anassa["title_prefix"]="ANASSA - ";
	$anassa["favicon"]="favicon.ico";
	$anassa["css"]=array(
		"css/common.css"
		);
	$anassa["js"]=array(
		"js/common.js",
		"js/jquery-2.1.1.min.js",
		"js/modernizr.custom.30889.js"
		);
	$anassa["gat_ua"]="UA-54672703-2";
	$anassa["header"]="
<span class='siteTitle'>Anassa</span>
<span class='siteSlogan'>{ Drottning över de pyttesmå PHP-ramverken }</span>";
	$anassa["header_sub"]="";
	$txtLogin=(!isset($_SESSION["user"]) ? "Logga in" : "Logga ut");
	$urlLogin=(!isset($_SESSION["user"]) ? "user_login.php" : "user_logout.php");

	$anassa["menu_top"]=array(
		'item'=>array(
				'home'=>array(
					'text'=>"Hem",
					'url'=>"home.php",
					'img'=>"symbol_anassa.png",
					'title'=>"Borta bra, men hemma bäst"
					),
				'me'=>array(
					'text'=>"Om mig",
					'url'=>"me.php",
					'img'=>null,
					'title'=>"En liten presentation av mig själv"
					),
				'kmoms'=>array(
					'text'=>"Redovisning",
					'url'=>"kmoms.php",
					'img'=>null,
					'title'=>"Redovisning av kursmomenten"
					),
				'gallery'=>array(
					'text'=>"Galleriet",
					'url'=>"gallery.php",
					'img'=>null,
					'title'=>"Ett spel för galleriet"
					),
				'content'=>array(
					'text'=>"Innehåll",
					'url'=>(isset($_SESSION["user"]) ? "content.php" : ""),
					'img'=>null,
					'title'=>"Innehåll (sidor/bloggar)"
					),
				'blogs'=>array(
					'text'=>"Bloggar",
					'url'=>"blogs.php",
					'img'=>null,
					'title'=>"Bloggar"
					),
				'movies'=>array(
					'text'=>"Film-databas",
					'url'=>"movies.php",
					'img'=>null,
					'title'=>"Film-databas"
					),
				'source'=>array(
					'text'=>"Källkod",
					'url'=>"source.php",
					'img'=>null,
					'title'=>"Kika på källkoden"
					),
				'other'=>array(
					'text'=>"Övrigt",
					'url'=>"other.php",
					'img'=>null,
					'title'=>"Övrigt"
					),
				'rm'=>array(
					'text'=>"RM",
					'url'=>"../../kmom10/webroot/home.php",
					'img'=>"symbol_rm.png",
					'title'=>"Gå till projektet Rental Movies (kmom07/10)"
					)
				),
			'selected'=>function($url) {
				if (basename($_SERVER["SCRIPT_FILENAME"])==$url || CAnassa::readGet("url", null, "url")==$url) {
					return true;
				}
			}
			);
	
	$anassa["main"]="";
	$anassa["main_inc"]=false;
	$anassa["footer"]="
<div class='left'>
	Copyright (c) 2014 - Göran Hellberg [ <a href='mailto:cosmos3@telia.com'>cosmos3@telia.com</a> ]
</div>
<div class='right'>
	| ".CAnassa::txtLinkBlank('https://github.com/cosmos3/Anassa', 'Anassa på GitHub')."
	| ".CAnassa::txtLinkBlank('http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance', 'Unicorn')." |
</div>";
	$anassa["db"]=anassaDB();
?>