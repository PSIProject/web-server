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

	$stmt = $db->prepare('SELECT collaborate.team_id, team.name FROM collaborate JOIN team
							ON collaborate.team_id = team.id WHERE collaborator_id = ?');
	$stmt->bind_param('i', $user_id);
	$stmt->execute();
	$stmt->bind_result($team_id, $team_name);

	/// Store them in an array
    $teams = array();
    for ($i = 0; $stmt->fetch(); $i++)
    {
        $teams [$i] = new stdClass();
        $teams [$i]->id = $team_id;
        $teams [$i]->name = $team_name;

		$stmt->close ();

		$stmt = $db->prepare('SELECT COUNT(*) FROM collaborate WHERE team_id = ?');
		$stmt->bind_param('i', $team_id);
		$stmt->execute();
		$stmt->bind_result($team_members);
		$stmt->fetch();

		$teams [$i]->members = $team_members;
    }

	$stmt->close ();
	$db->close ();

	echo json_encode($teams);
?>
