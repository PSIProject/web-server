<?php
/////////////////////////////////////////////
/// Check that the user doesn't have another
/// goal with the same name, if doesn't have
///	it, then create them and registered.
///
/// Use POST method, needs the name for the
///	goal an take the id of the user from session
///	var.
///
///	Return ok, if the goal is created, error
/// for system errors or 'already exists' if
///	the user have another goal with that name.
///////////////////////////////////////////////
	require 'connect-db.inc';
	session_start();
	$response = new stdClass();

	$db = connect_db();
	$name = $_POST ['name'];
	$team_id = $_SESSION ['team_id'];


	$stmt = $db->prepare('SELECT COUNT(*) FROM goal WHERE name = ? AND team_id = ?');
	$stmt->bind_param('si', $name, $team_id);
	$stmt->execute();
	$stmt->bind_result($result);
	$stmt->fetch();

	if ($result == '0')
	{
		$stmt->close ();

		$stmt = $db->prepare('INSERT INTO goal VALUES (NULL, ?, ?)');
		$stmt->bind_param('si', $name, $team_id);

		if (!$stmt->execute())
			$response->status = 'error';
		else
		{
			$response->status = 'ok';
			$_SESSION ['goal_id'] = $goal_id;
		}
	}
	else
		$response->status = 'already exists';

	$stmt->close ();
    $db->close ();
	echo json_encode($response);
?>
