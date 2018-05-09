<?php
/////////////////////////////////////////////
/// Check that the user doesn't have another
/// team with the same name, if doesn't have
///	it, then create the team and registered
///	the user like a collaborator of it.
///
/// User POST method, needs the name for the
///	team an take the id of the user from session
///	var.
///
///	Return ok, if the team is created, error
/// for system errors or 'already exists' if
///	the user have another team with that name.
///////////////////////////////////////////////

	require 'connect-db.inc';
	
	session_start();
	$response = new stdClass();

	$db = connect_db();
	$name = $_POST ['name'];
	$manager_id = $_SESSION ['user_id'];

	$stmt = $db->prepare('SELECT COUNT(*) FROM team WHERE name = ? AND manager_id = ?');
	$stmt->bind_param('si', $name, $manager_id);
	$stmt->execute();
	$stmt->bind_result($result);
	$stmt->fetch();

    if ($result == '0')
	{
		$stmt->close ();

		$stmt = $db->prepare('INSERT INTO team VALUES (NULL, ?, ?)');
		$stmt->bind_param('si', $name, $manager_id);

		if (!$stmt->execute())
			$response->status = 'error';
		else
		{
			$stmt->close ();

			$stmt= $db->prepare('SELECT LAST_INSERT_ID()');
	        $stmt->execute();
			$stmt->bind_result($team_id);
			$stmt->fetch();
			$stmt->close();

			$_SESSION ['team_id'] = $team_id;

			$stmt = $db->prepare('INSERT INTO collaborate VALUES (?, ?)');
			$stmt->bind_param('ii', $manager_id, $team_id);
			$stmt->execute();
			$response->status = 'ok';
		}
	}
    else
        $response->status = 'already exist';

	$stmt->close ();
	$db->close ();
	echo json_encode($response);
?>
