<?php
	function anassaDB() {
		return array(
			'dsn'=>"mysql:host=localhost;dbname=bth;",
			'username'=>"root",
			'password'=>"",
			'driver_options'=>array(
					PDO::ATTR_EMULATE_PREPARES=>false,
					PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"
					),
				);
	}
?>