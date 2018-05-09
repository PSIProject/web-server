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
	$task = json_decode($_POST ['task_data']);

    $stmt = $db->prepare('SELECT COUNT(*) FROM task WHERE name = ?');
    $stmt->bind_param('s', $task->name);
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
