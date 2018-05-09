<?php
///////////////////////////////////////////////
/// Sign up a user on the collobarator table
/// is a POST scriipt.
///
/// If the register was succesfull return ok.
///////////////////////////////////////////////
	require 'connect-db.inc';

	$db = connect_db();
	$response = new stdClass();
	$collaborator = json_decode($_POST ['collaborator_data']);

	/// Register collaborator
	$stmt = $db->prepare('INSERT INTO collaborator VALUES (NULL, ?, ?, ?, ?, SHA2(?, 256))');
	$stmt->bind_param('sssss', $collaborator->nick,  $collaborator->email, $collaborator->name, $collaborator->lastName,
				                    $collaborator->password);

	if (!$stmt->execute())
		$response->status = 'error';
	else
		$response->status = 'ok';

	echo json_encode($response);
	$stmt->close();
	$db->close();
?>
