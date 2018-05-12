<?php
////////////////////////////////////////////////
/// Add a comment to the current task.
///
/// Use POST method for get the message.
///////////////////////////////////////////////
	require 'connect-db.inc';
	session_start ();

	$db = connect_db();
	$response = new stdClass();
    $user_id = $_POST ['message'];
	$task_id = $_SESSION ['task_id'];
	$collaborator_id = $_SESSION ['user_id'];

	$stmt = $db->prepare('INSERT INTO comment VALUES (NULL, NOW(), ?, ?)');
	$stmt->bind_param('ii', $user_id, $task_id);

	if ($stmt->execute())
		$response->status = 'ok';
	else
		$response->status = 'error';

		echo json_encode($response);
	$stmt->close();
	$db->close();
?>
