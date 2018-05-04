<?php
	function connect_db()
	{
		$db = new mysqli ('localhost', 'root', '', 'rafael_pina_gonzalez');

		if ($db->connect_error)
	    	echo 'Connection failed: '.$db->connect_error;

		return $db;
	}
?>
