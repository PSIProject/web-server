<?php
///////////////////////////////////////////////////////////
/// Take the team id from $_SESSION and return an array with
///  the members of that team. Array elements must have:
///
/// id: member's id
/// nick: member's nick
///
/// Before to get team's members, verify that team belongs
/// to the user.
//////////////////////////////////////////////////////////
	require 'connect-db.inc';
	require 'is-member-of-team.inc';
	session_start();

	$db = connect_db();
	$team_id = $_SESSION ['team_id'];
	$user_id = $_SESSION ['user_id'];

	if (isMemberOfTeam($db, $user_id, $team_id))
	{
		$stmt = $db->prepare('SELECT collaborate.collaborator_id, collaborator.nick FROM collaborate
								JOIN collaborator ON collaborate.collaborator_id = collaborator.id  WHERE team_id = ?');
		$stmt->bind_param('i', $team_id);
		$stmt->execute();
		$stmt->bind_result($collaborator_id, $collaborator_nick);

		/// Store them in an array
		$members = array();
		while ($stmt->fetch())
			array_push($members, array('id' => $collaborator_id, 'name' => $collaborator_nick));

		echo json_encode($members);
		$stmt->close ();
	}
	else
		echo 'error';
	$db->close ();
?>
