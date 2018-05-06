<?php
	/////////////////////////////////////////
	/// Gets the information of a team
	/////////////////////////////////////////
	require 'connect-db.inc';

	session_start();
	$db = connect_db();
	$team_data = new stdClass();
	$user_id = $_SESSION ['user_id'];

	$stmt = $db->prepare('SELECT team_id FROM collaborate WHERE collaborator_id = ?');
	$stmt->bind_param('i', $user_id);
	$stmt->execute();
	$stmt->bind_result($team_id);
	$stmt->close();

    for ($i = 0; $stmt->fetch(); $i++)
    {
		$stmt = $db->prepare('SELECT name FROM team WHERE id = ?');
		$stmt->bind_param('i', $user_id);
		$stmt->execute();
		$stmt->bind_result($team_id);
	}

	echo json_encode($user_info);
	$db->close();
?>
