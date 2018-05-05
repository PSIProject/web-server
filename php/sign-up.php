<?php
///////////////////////////////////////////////
/// Sign up a user on the collobarator table
/// is a POST scriipt.
///
/// If the register was succesfull return true.
///////////////////////////////////////////////
	require 'connect-db.inc';

	$db = connect_db();
	$collaborator = json_decode($_POST ['collaborator_data']);

	/// Register collaborator
	$stmt = $db->prepare('INSERT INTO collaborator VALUES (NULL, ?, ?, ?, ?, SHA2(?, 256))');
	$stmt->bind_param('sssss', $collaborator->nick,  $collaborator->email, $collaborator->name, $collaborator->last_name,
				                    $collaborator->password);

	if (!$stmt->execute())
		echo $db->error;
	else
		echo 'ok';

	$stmt->close();
	$db->close();
?>
