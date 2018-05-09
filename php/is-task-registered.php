<?php
/////////////////////////////////////////////
/// Check that the goal doesn't have another
/// task with the same name.
///
/// User POST method, needs the name for the
///	task.
///
///	Return true, if the name is not use or
///	false if the team have another
/// task with that name.
///////////////////////////////////////////////
	require 'connect-db.inc';

	session_start();
	$response = new stdClass();

	$db = connect_db();
	$task_name = $_POST ['task_name'];
	$task_name = $_SESSION ['goal_id'];

    $stmt = $db->prepare('SELECT COUNT(*) FROM task WHERE name = ? AND goal_id = ?');
    $stmt->bind_param('si', $task_name, $goal_id);
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch ();

	if ($result == '0')
			$response->status = 'true';
	else
		$response->status = 'false';

	echo json_encode($response);
	$stmt->close ();
	$db->close ();
?>
