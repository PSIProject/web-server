<?php
	///////////////////////////////////
	/// Gets current user's nick. It's
	/// stored in $_SESSION ['user_nick']
	/// by log-in.php
	///////////////////////////////////
	session_start();
	$response = new stdClass();
	$response->nick = $_SESSION ['user_nick'];
	echo json_encode($response);
?>
