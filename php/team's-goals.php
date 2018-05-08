<?php
///////////////////////////////////////////////////////////
/// Receive goal's id and returns an array with the goal's
/// goals. Each array element have:
///
/// id: goal's id
/// name: goal's name
///
/// Verify that goal belongs to the user before to get
/// goals. If goal doesn't, it must an error message.
//////////////////////////////////////////////////////////
	require 'connect-db.inc';
	session_start();

	$db = connect_db();
	$team_id = $_POST ['team_id'];

	$stmt = $db->prepare('SELECT id, name FROM goal WHERE team_id = ?');
	$stmt->bind_param('i', $team_id);
	$stmt->execute();
	$stmt->bind_result($goal_id, $goal_name);

	/// Store them in an array
    $goals = array();
	while ($stmt->fetch())
    {
        $goal = new stdClass();
        $goal>id = $goal_id;
        $->name = $goal_name;
		array_push($goals, $goal);

	}

	$stmt->close ();
	$db->close ();

	echo json_encode($goals);
?>
