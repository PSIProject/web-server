<?php
///////////////////////////////////////////////////////////
/// Take the task id from $_SESSION and return an array with
///  the members of that task. Array elements must have:
///
/// id: member's id
/// nick: member's nick
//////////////////////////////////////////////////////////
	require 'connect-db.inc';
	session_start();

	$db = connect_db();
	$task_id = $_SESSION ['task_id'];

	$stmt = $db->prepare('SELECT assigned_to.collaborator_id, collaborator.nick FROM assigned_to
						JOIN collaborator ON assigned_to.collaborator_id = collaborator.id  WHERE task_id = ?');
	$stmt->bind_param('i', $task_id);
	$stmt->execute();
	$stmt->bind_result($collaborator_id, $collaborator_nick);

	$collaborators = array();
	while ($stmt->fetch())
		array_push($collaborators, array('id' => $collaborator_id, 'name' => $collaborator_nick));

	echo json_encode($collaborators);
	$stmt->close ();
	$db->close ();
?>
