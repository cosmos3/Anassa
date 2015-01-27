<?php

	function exceptionHandler($exception) {
		echo "Anassa: Uncaught exception: <p>".$exception->getMessage()."</p><pre>".$exception->getTraceAsString()."</pre>";
	}
	set_exception_handler('exceptionHandler');
	
	function autoLoader($class) {
		$path=ANASSA_INSTALL_PATH."/src/".$class."/".$class.".php";
		if (is_file($path)) {
			include($path);
		} else {
			throw new Exception("Classfile '".$class."' does not exists.");
		}
	}
	spl_autoload_register("autoLoader");
	
	function dump($dump) {
		ob_start();
		var_dump($dump);
		$dump=ob_get_clean();
		$dump=str_replace('"', "'", $dump);
		$dump=explode("'", $dump);
		$txt="Borttaget av ANASSA";
		$i=0;
		$txtDump="";
		foreach ($dump as $var) {
			$i--;
			if ($var=="_acronym" || $var=="_password" || $var=="username" || $var=="password" || $var=="dsn") {
				$i=6; // Windows
				//$i=2; // Unix/Linux
			}
			if ($i==0) {
				$var=$txt;
			}
			$txtDump.=$var;
		}
		$txtDump="OS: ".PHP_OS."<br/>".$txtDump;
		return strip_tags($txtDump);
	}

?>