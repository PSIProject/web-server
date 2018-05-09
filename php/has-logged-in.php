<?php
	session_start();
	$response = new stdClass();

	if (isset($_SESSION ['user_id']))
		$response->status = 'true';
	else
		$response->status = 'false';

	echo json_encode($response);
?>
