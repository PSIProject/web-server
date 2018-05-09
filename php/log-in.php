<?php
	require 'connect-db.inc';

	$db = connect_db();
	$response = new stdClass();
	$email = $_POST ['email'];
	$password = $_POST ['password'];

	$stmt = $db->prepare('SELECT id FROM collaborator WHERE email = ? AND password = SHA2(?, 256)');
	$stmt->bind_param('ss', $email, $password);
	$stmt->execute();
	$stmt->bind_result($id);

	if ($stmt->fetch())
	{
		session_start();
		$_SESSION ['user_id'] = $id;
		$response->status = 'ok';
	}
	else
		$response->status = 'error';

	echo json_encode($response);
	$stmt->close ();
	$db->close ();
?>
