<?php

	function showMenuTop($menu) {
		$html="
			<nav id='menu-top'>
				<ul>";
		foreach ($menu['item'] as $item) {
			$selected=($menu['selected']($item['url']) ? "selected" : "");
			if ($item['url']!="") {
				$html.="
						<li><a href='".$item['url']."' class='".$selected."' title='".$item['title']."'>"
					.($item['img'] ? "<img src='img/".$item['img']."' width='20' height='20' alt='".$item['title']."'/>" : "")
					.$item['text']."</a></li>";
			} else {
				$html.="
						<li class='disabled'>".($item['img'] ? "<img src='img/".$item['img']."' width='20' height='20' alt='".$item['title']."'/>" : "")
					.$item['text']."</li>";
			}
		}
		$html.="
				</ul>
			</nav>";
		return $html;
	}
	
	function txtPageTitle($text) {
		return "<h3>".$text."</h3>";
	}
	
	function getPageTitle($page, $h3) {
		global $anassa;
		$anassa['title']=$anassa['menu_top']['item'][$page]['title'];
		if ($h3) {
			return txtPageTitle($anassa['title']);
		} else {
			return $anassa['title'];
		}
	}

	function cleanTxt($value) {
		return filter_var(trim($value), FILTER_SANITIZE_STRING);
	}
	
	function cleanURL($url) {
		return html_entity_decode($url);
	}
	
	function readPost($var, $false) {
		return cleanTxt(isset($_POST[$var]) ? $_POST[$var] : $false);
	}
	
	function readGet($var, $false) {
		return cleanTxt(isset($_GET[$var]) ? $_GET[$var] : $false);
	}
	
	function readSession($var, $false) {
		return cleanTxt(isset($_SESSION[$var]) ? $_SESSION[$var] : $false);
	}
	
	function readSessionFromGet($var, $false) {
		if (!isset($_SESSION[$var])) {
			if (isset($_GET[$var])) {
				$_SESSION[$var]=readGet($var, $false);
			} else {
				$_SESSION[$var]=$false;
			}
		} elseif (isset($_GET[$var])) {
			$_SESSION[$var]=readGet($var, $false);
		}
		return $_SESSION[$var];
	}
	
	function readSessionFromPost($var, $false) {
		if (!isset($_SESSION[$var])) {
			if (isset($_POST[$var])) {
				$_SESSION[$var]=readPost($var, $false);
			} else {
				$_SESSION[$var]=$false;
			}
		} elseif (isset($_POST[$var])) {
			$_SESSION[$var]=readPost($var, $false);
		}
		return $_SESSION[$var];
	}
	
	function downloadFile($file) {	
		header("Content-Description: File Transfer");
		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=".basename($file));
		header("Content-Transfer-Encoding: binary");
		header("Expires: 0");
		header("Cache-Control: must-revalidate");
		header("Pragma: public");
		header("Content-Length: ".filesize($file));
		$f=fopen($file, 'r');
		fpassthru($f);
		fclose($f);
		exit();
	}

	function txtLinkBlank($link, $text) {
		return "<a href='".$link."' target='_blank'>".$text."</a>&nbsp;<img src='img/symbol_target_blank.png' width='12' height='10' alt='En länk för ".$text."'/>";
	}
	
	function txtDownloadFile($link, $text) {
		return "<a href='".$link."'><span class='download-file'>".$text."</span></a>";
	}
	
?>