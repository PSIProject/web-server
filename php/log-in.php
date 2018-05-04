<?php
	require 'connect-db.inc';

	$db = connect_db();
	$rfc = $_POST ['email'];
	$password = $_POST ['password'];

	$stmt = $db->prepare('SELECT COUNT(*) FROM user WHERE email = ? AND password = SHA2(?, 256)');
	$stmt->bind_param('ss', $email, $password);
	$stmt->execute();
	$stmt->bind_result($id)

	if ($stmt->fetch())
		echo 'true';
	else
		echo 'wrong data';

	$stmt->close ();
	$db->close ();
?>
