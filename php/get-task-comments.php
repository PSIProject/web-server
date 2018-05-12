<?php
////////////////////////////////////////////////////////////////////////
/// Take task's id from $_SESSION and returns an array with
/// the comments of the task. Each array element have:
///
/// collaborator_nid: id of the collaborator who posted the comment
/// collaborator_name: name of the collaborator who posted the comment
/// publication_date: date of the publication of the comment
///
/// Will be sorted by date.
////////////////////////////////////////////////////////////////////////
	require 'connect-db.inc';
	session_start();

	$db = connect_db();
	$task_id =  $_SESSION ['task_id'];

	$stmt = $db->prepare('SELECT comment.publicate_date, comment.message, collaborator.name FROM comment
							JOIN collaborator ON assigned_to.collaborator_id = collaborator.id  WHERE task_id = ?
							ORDER BY publicate_date');
	$stmt->bind_param('i', $task_id);
	$stmt->execute();
	$stmt->bind_result($publication_date, $message, $collaborator_name);

	/// Store them in an array
	$comments = array();
	while ($stmt->fetch())
		array_push($comments, array('collaborator_name' => $collaborator_name, 'publicate_date' => $publication_date,
									'message' => $message));

	echo json_encode($comments);
	$stmt->close ();
	$db->close ();
?>
