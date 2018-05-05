<?php
	require 'connect-db.inc';

	$db = connect_db();
	$email = $_POST ['email'];
	$password = $_POST ['password'];

	$stmt = $db->prepare('SELECT COUNT(*) FROM collaborator WHERE email = ? AND password = SHA2(?, 256)');
	$stmt->bind_param('ss', $email, $password);
	$stmt->execute();
	$stmt->bind_result($result)

	if ($stmt->fetch())
		echo 'true';
	else
		echo 'wrong data';

	$stmt->close ();
	$db->close ();
?>
