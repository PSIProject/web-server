<?php
	require 'connect-db.inc';
	session_start();

	$task_id = $_GET ['task_id'];
	$user_id = $_SESSION ['user_id'];
	$response = new stdClass();
	$db = connect_db();

	/// Verify that user has the task assigned
	$stmt = $db->prepare('SELECT COUNT(*) FROM assigned_to WHERE collaborator_id = ? AND task_id = ?');
	$stmt->bind_param('ii', $user_id, $task_id);
	$stmt->execute();
	$stmt->bind_result($has_assigned);
	$stmt->fetch();
	$stmt->close();

	if ($has_assigned == '0')
	{
		$response->status = 'error';
		$db->close();
		echo json_encode($response);
		return;
	}

	/// Get goal id
	$stmt = $db->prepare('SELECT goal_id FROM task WHERE id = ?');
	$stmt->bind_param('i', $task_id);
	$stmt->execute();
	$stmt->bind_result($goal_id);
	$stmt->fetch();
	$stmt->close();

	/// Get goal info
	$stmt = $db->prepare('SELECT name, team_id FROM goal WHERE id = ?');
	$stmt->bind_param('i', $goal_id);
	$stmt->execute();
	$stmt->bind_result($goal_name, $team_id);
	$stmt->fetch();
	$stmt->close();

	/// Get task info
	$stmt = $db->prepare('SELECT name FROM team WHERE id = ?');
	$stmt->bind_param('i', $team_id);
	$stmt->execute();
	$stmt->bind_result($team_name);
	$stmt->fetch();
	$stmt->close();

	$db->close();

	/// Store task, goal and teams id in $_SESSION
	$_SESSION ['task_id'] = $task_id;
	$_SESSION ['goal_id'] = $goal_id;
	$_SESSION ['team_id'] = $team_id;

	/// Prepare response
	$response->status = 'ok';
	$response->goalName = $goal_name;
	$response->teamName = $team_name;

	echo json_encode($response);
?>
