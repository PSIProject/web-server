<?php
////////////////////////////////////////////////
/// Add a user to the current task.
///
/// Use POST method for get the user id.
///////////////////////////////////////////////
	require 'connect-db.inc';
	require 'is-member-of-task.inc';
	session_start ();

	$db = connect_db();
	$response = new stdClass();
    $user_id = $_POST ['user_id'];
	$team_id = $_SESSION ['team_id'];
	$task_id = $_SESSION ['task_id'];

	if (isMemberOfTeam($db, $user_id, $team_id) && !isMemberOfTask($db, $user_id, $task_id))
	{
		$stmt = $db->prepare('INSERT INTO assigned_to VALUES (?, ?)');
		$stmt->bind_param('ii', $user_id, $task_id);

		if ($stmt->execute())
			$response->status = 'ok';
		else
			$response->status = 'error';

		$stmt->close();
	}
	else
		$response->status = 'error';

	echo json_encode($response);
	$db->close();
?>
