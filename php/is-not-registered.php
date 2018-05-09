<?php
///////////////////////////////////////////////////
/// Recibes the nick or email for verify if are
/// register for other user, becuse have tu be unique
///
/// Return true if is not register and false if is
/// register by other user.
///////////////////////////////////////////////////
	require 'connect-db.inc';

	$db = connect_db();
	$response = new stdClass();

	if (isset($_POST ['email']))
	{
		$email = $_POST ['email'];
		$stmt = $db->prepare('SELECT COUNT(*) FROM collaborator WHERE email = ?');
		$stmt->bind_param('s', $email);
	}

	if (isset($_POST ['nick']))
	{
		$nick = $_POST ['nick'];
		$stmt = $db->prepare('SELECT COUNT(*) FROM collaborator WHERE nick = ?');
		$stmt->bind_param('s', $nick);
	}

	$stmt->execute();
	$stmt->bind_result($result);
	$stmt->fetch();

	if ($result == '0')
		$response->status = 'true';
	else
		$response->status = 'false';

	echo json_encode($response);
	$stmt->close ();
	$db->close ();
?>
