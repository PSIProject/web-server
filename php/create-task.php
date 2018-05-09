<?php
/////////////////////////////////////////////
/// Create a new task.
///
/// User POST method, needs the name for the
///	task an take the id of the user and the
///	goal from session var.
///
///	Return ok, if the task is created, error
/// for system errors or 'already exists' if
///	the team have another task with that name.
///////////////////////////////////////////////
	require 'connect-db.inc';

	session_start();
	$response = new stdClass();

	$db = connect_db();
	$goal_id = $_SESSION ['goal_id'];
	$collaborator_id = $_SESSION ['user_id'];
	$task = json_decode($_POST ['task_data']);


	$stmt = $db->prepare('INSERT INTO task VALUES (NULL, ?, ?, ?, ?, 1, ?, ?, NULL)');
	$stmt->bind_param('ssssis', $task->name,  $task->description, $task->init_date, $task->finish_date,
								$task->goal_id, $task->delivery_description);

	if (!$stmt->execute())
		$response->status = 'error';
	else
		$response->status = 'ok';

	echo json_encode($response);
	$stmt->close ();
	$db->close ();
?>
