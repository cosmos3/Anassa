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
	spl_autoload_register('autoLoader');

	function dump($dump) {
		ob_start();
		var_dump($dump);
		$dump=ob_get_clean();
		return strip_tags($dump);
	}

?>