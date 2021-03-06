<?php
	///////////////////////////////////
	/// Test if the given credentials are
	/// of a signed up user. If they are,
	/// returns 'ok' in $status, else
	/// returns 'error'.
	///
	/// Stores nick and id of the user in
	/// $_SESSION.
	///////////////////////////////////
	require 'connect-db.inc';

	$db = connect_db();
	$response = new stdClass();
	$email = $_POST ['email'];
	$password = $_POST ['password'];

	$stmt = $db->prepare('SELECT id, nick FROM collaborator WHERE email = ? AND password = SHA2(?, 256)');
	$stmt->bind_param('ss', $email, $password);
	$stmt->execute();
	$stmt->bind_result($id, $nick);

	if ($stmt->fetch())
	{
		session_start();
		$_SESSION ['user_id'] = $id;
		$_SESSION ['user_nick'] = $nick;
		$response->status = 'ok';
	}
	else
		$response->status = 'error';

	echo json_encode($response);
	$stmt->close ();
	$db->close ();
?>
