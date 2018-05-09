<?php
////////////////////////////////////////////////
/// Add a user to the team
///
/// Use POST method for get the user id.
///////////////////////////////////////////////
	require 'connect-db.inc';
	session_start ();

	$db = connect_db();
	$response = new stdClass();
    $user_id = $_POST ['user_id'];
	$team_id = $_SESSION ['team_id'];

	$stmt = $db->prepare('SELECT COUNT(*) FROM collaborate WHERE collaborator_id = ? AND team_id = ?');
	$stmt->bind_param('ii', $user_id, $team_id);
	$stmt->execute();
	$stmt->bind_result($result);
	$stmt->fetch ();

	if ($result == '0')
	{
		$stmt->close();

		$stmt = $db->prepare('INSERT INTO collaborate VALUES (?, ?)');
		$stmt->bind_param('ii', $user_id, $team_id);

		if ($stmt->execute())
			$response->status = 'ok';
		else
			$response->status = 'error';
	}
	else
		$response->status = 'already exists';

	echo json_encode($response);
	$stmt->close();
	$db->close();
?>
