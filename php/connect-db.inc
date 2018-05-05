<?php
	function connect_db()
	{
		$db = new mysqli ('localhost', '', '', '');

		if ($db->connect_error)
	    	echo 'Connection failed: '.$db->connect_error;

		return $db;
	}
?>
