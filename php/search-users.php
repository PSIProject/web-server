<?php
////////////////////////////////////////////////
/// Search the nicks that are like the get keyword.
///
/// Use POST method for get the word.
///////////////////////////////////////////////
	require 'connect-db.inc';

	$db = connect_db();
    $keyword = '%'.$_POST ['keyword'].'%';
	$response = new stdClass();

	$stmt = $db->prepare('SELECT id, nick FROM collaborator WHERE nick LIKE ?');
	$stmt->bind_param('s', $keyword);
	$stmt->execute();
	$stmt->bind_result($collaborator_id, $collaborator_nick);

	$users = array();
	while ($stmt->fetch())
		array_push($users, array('id' => $collaborator_id, 'nick' => $collaborator_nick));

	echo json_encode($users);
	$stmt->close();
	$db->close();
?>
