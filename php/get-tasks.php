<?php
///////////////////////////////////////////////////////////
/// Take goal's id from $_SESSION and returns an array with
/// the goal's tasks. Each array element have:
///
///	id: task's id
/// name: task's name
//////////////////////////////////////////////////////////
	require 'connect-db.inc';
	session_start();

	$db = connect_db();
	$goal_id =  $_SESSION ['goal_id'];

	$stmt = $db->prepare('SELECT id, name FROM task WHERE goal_id = ?');
	$stmt->bind_param('i', $goal_id);
	$stmt->execute();
	$stmt->bind_result($task_id, $task_name);

	/// Store them in an array
	$tasks = array();
	while ($stmt->fetch())
		array_push($tasks, array('id' => $task_id, 'name' => $task_name));

	echo json_encode($tasks);
	$stmt->close ();
	$db->close ();
?>
