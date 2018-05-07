<?php
///////////////////////////////////////////////////
/// Return an array of objects with the following
/// structure:
/// id: team's id
/// name: team's name
/// members: number of team's member
///////////////////////////////////////////////////
	require 'connect-db.inc';
	session_start();

	$db = connect_db();
	$user_id = $_SESSION ['user_id'];

	$stmt = $db->prepare('SELECT id, name FROM team WHERE manager_id = ?');
	$stmt->bind_param('i', $user_id);
	$stmt->execute();
	$stmt->bind_result($team_id, $team_name);

	/// Store them in an array
    $teams = array();
	while ($stmt->fetch())
    {
        $team = new stdClass();
        $team->id = $team_id;
        $team->name = $team_name;
		array_push($teams, $team);

	}
	$stmt->close ();
	$stmt = $db->prepare('SELECT COUNT(*) FROM collaborate WHERE team_id = ?');
	foreach ($teams as $team )
	{
		$stmt->bind_param('i', $team->id);
		$stmt->execute();
		$stmt->bind_result($team_members);
		$stmt->fetch();
		$team->members = $team_members;
	}

	$stmt->close ();
	$db->close ();

	echo json_encode($teams);
?>
