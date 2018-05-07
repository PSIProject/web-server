<?php
	require 'connect-db.inc';

	$db = connect_db();
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
		echo 'true';
	}
	else
		echo 'wrong data';

	$stmt->close ();
	$db->close ();
?>
