<?php

	/**
	 * This is class CAnassa
	 *
	 */	
	class CAnassa {

		public static function cleanVar($value, $sanitize) {
			$value=trim($value);
			switch ($sanitize) {
				case "email": {
					$value=filter_var($value, FILTER_SANITIZE_EMAIL);
					break;
				}
				case "float": {
					$value=filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT);
					break;
				}
				case "int": {
					$value=filter_var($value, FILTER_SANITIZE_NUMBER_INT);
					break;
				}
				case "html": {
					$value=htmlentities($value, null, "UTF-8");
					break;
				}
				case "special": {
					$value=filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
					break;
				}
				case "string": {
					$value=filter_var($value, FILTER_SANITIZE_STRING);
					break;
				}
				case "url": {
					$value=filter_var($value, FILTER_SANITIZE_URL);
					break;
				}
			}
			return $value;
		}

		public static function readPost($var, $false, $sanitize="", $inArray=array()) {
			if (isset($_POST[$var])) {
				$tmp=self::cleanVar($_POST[$var], $sanitize);
				if ($inArray) {
					if (in_array($tmp, $inArray)) {
						return $tmp;
					} else {
						return $false;
					}
				}
				return ($tmp=="" ? $false : $tmp);
			}
			return $false;
		}
		
		public static function readGet($var, $false, $sanitize="", $inArray=array()) {
			if (isset($_GET[$var])) {
				$tmp=self::cleanVar($_GET[$var], $sanitize);
				if ($inArray) {
					if (in_array($tmp, $inArray)) {
						return $tmp;
					} else {
						return $false;
					}
				}
				return $tmp;
			}
			return $false;
		}
		
		public static function readSession($var, $false, $set) {
			$value=(isset($_SESSION[$var]) ? $_SESSION[$var] : $false);
			if ($set) {
				$_SESSION[$var]=$false;
			}
			return $value;
		}
		
		public static function readSessionFromGet($var, $false) {
			if (!isset($_SESSION[$var])) {
				if (isset($_GET[$var])) {
					$_SESSION[$var]=self::readGet($var, $false);
				} else {
					$_SESSION[$var]=$false;
				}
			} elseif (isset($_GET[$var])) {
				$_SESSION[$var]=self::readGet($var, $false);
			}
			return $_SESSION[$var];
		}
		
		public static function readSessionFromPost($var, $false) {
			if (!isset($_SESSION[$var])) {
				if (isset($_POST[$var])) {
					$_SESSION[$var]=self::readPost($var, $false);
				} else {
					$_SESSION[$var]=$false;
				}
			} elseif (isset($_POST[$var])) {
				$_SESSION[$var]=self::readPost($var, $false);
			}
			return $_SESSION[$var];
		}
		
		public static function txtPageTitle($text) {
			return "<h3>".$text."</h3>";
		}
		
		public static function getPageTitle($page, $h3) {
			global $anassa;
			if ($page[0]!="#") {
				$anassa["title"]=$anassa["menu_top"]["item"][$page]["title"];
			} else {
				$anassa["title"]=substr($page, 1, strlen($page)-1);
			}
			if ($h3) {
				return self::txtPageTitle($anassa["title"]);
			} else {
				return $anassa["title"];
			}
		}

		public static function downloadFile($file) {	
			header("Content-Description: File Transfer");
			header("Content-Type: application/octet-stream");
			header("Content-Disposition: attachment; filename=".basename($file));
			header("Content-Transfer-Encoding: binary");
			header("Expires: 0");
			header("Cache-Control: must-revalidate");
			header("Pragma: public");
			header("Content-Length: ".filesize($file));
			$f=fopen($file, "r");
			fpassthru($f);
			fclose($f);
			exit();
		}

		public static function txtLinkBlank($link, $text) {
			return "<a href='".$link."' title='".$text."' target='_blank'>".$text."</a>&nbsp;<img src='img/symbol_target_blank.png' width='12' height='10' alt='Länksymbol'/>";
		}
		
		public static function txtMessage($txt) {
			if ($txt!=="") {
				if ($txt[0]=="-") {
					$s=" class='message error'>";
				} elseif ($txt[0]=="+") {
					$s=" class='message ok'>";
				} else {
					$s=">";
				}
				return "<span".$s.substr($txt, 1, strlen($txt)-1)."</span>";
			} else {
				return "";
			}
		}
		
		public static function setFocus($id) {
			return "
		<script type='text/javascript'>
			setFocus('".$id."');
		</script>";
		}
		
		public static function getNow() {
			return date("Y-m-d H:i:s", $_SERVER["REQUEST_TIME"]);
		}
		
		public static function txtDate($date, $monthLength, $time) {
			if ($date) {
				$dayName=array("Sön", "Mån", "Tis", "Ons", "Tor", "Fre", "Lör");
				$monthName=array("Januari", "Februari", "Mars", "April", "Maj", "Juni", "Juli", "Augusti", "September", "Oktober", "November", "December");
				$date=date_create($date);
				$day=date_format($date, "w");
				$month=$monthName[date_format($date, "m")-1];
				if ($monthLength>0) {
					$month=substr($month, 0, $monthLength);
				}
				if ($time=="min") {
					$time=", ".date_format($date, "H:i");
				} elseif ($time=="full") {
					$time=", ".date_format($date, "H:i:s");
				}
				return $dayName[$day]." ".date_format($date, "d")." ".$month." ".date_format($date, "Y").$time;
			} else {
				return "Okänt";
			}
		}
		
		public static function txtPrice($value, $char) {
			return $value.($char ? " kr" : ":-");
		}

		public static function addTextToId($text, $id, $char) {
			return "<a href='#' onClick='addTextToId(\"".$text."\", \"".$id."\", \"".$char."\");'>".$text."</a>";
		}

		public static function addToSession($var, $value) {
			if (isset($_SESSION[$var])) {
				$_SESSION[$var].=$value;
			} else {
				$_SESSION[$var]=$value;
			}
		}
		
		public static function fileIsImage($file, $validImages=array()) {
			$mime=finfo_open(FILEINFO_MIME_TYPE);
			$info=finfo_file($mime, $file);
			if (substr($info, 0, 5)=="image") {
				$ext=substr($info, 6, strlen($info)-6);
				return in_array($ext, $validImages);
			}
			return false;
		}

	}
	
?>