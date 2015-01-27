<?php
	function anassaDB() {
		return array(
			'dsn'=>"mysql:host=blu-ray.student.bth.se;dbname=gohe14;",
			'username'=>"gohe14",
			'password'=>'4\AZ1O(m',
			'driver_options'=>array(
					PDO::ATTR_EMULATE_PREPARES=>false,
					PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"
					),
				);
	}
?>