<?php
	require 'connect-db.inc';
	session_start();

	$user_id = $_SESSION ['user_id'];

	$db = connect_db();
	$stmt = $db->prepare('SELECT task.id, task.name FROM task
						  JOIN assigned_to ON assigned_to.task_id = task.id
						  WHERE assigned_to.collaborator_id = ? LIMIT 5');
	$stmt->bind_param('i', $user_id);
	$stmt->execute();
	$stmt->bind_result($task_id, $task_name);

	$upcoming_tasks = [];
	while ($stmt->fetch())
		array_push($upcoming_tasks, ['id' => $task_id, 'name' => $task_name]);

	$stmt->close();
	$db->close();
	echo json_encode($upcoming_tasks);
?>
