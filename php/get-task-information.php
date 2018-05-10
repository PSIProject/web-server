<?php
///////////////////////////////////////////////////////////
/// Take task's id from $_SESSION and returns an array with
/// the task's information. Each array element have:
///
/// name: task's name
/// description: task's description
/// delivery_description: information about the delivery
/// finish_date: Limit date for end the task
//////////////////////////////////////////////////////////
	require 'connect-db.inc';
	session_start();

	$db = connect_db();
	$task_id =  $_SESSION ['task_id'];

	$stmt = $db->prepare('SELECT name, description, delivery_description, finish_date FROM task WHERE id = ?');
	$stmt->bind_param('i', $task_id);
	$stmt->execute();
	$stmt->bind_result($task_name, $task_description, $task_delivery_description, $task_finish_date);

	/// Store them in an array
	if ($stmt->fetch())
	{
		$task = new stdClass();
		$task->name = $task_name;
		$task->description = $task_description;
		$task->delivery_description = $task_delivery_description;
		$task->finish_date = $task_finish_date;
	}

	echo json_encode($task);
	$stmt->close ();
	$db->close ();
?>
