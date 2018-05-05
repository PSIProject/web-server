<?php
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
		echo 'success';

	$stmt->close();
	$db->close();

?>
