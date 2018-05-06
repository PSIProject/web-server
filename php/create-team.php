<?php
	require 'connect-db.inc';

	$db = connect_db();
	$name = $_POST ['name'];
	$manager_id = $_SESSION ['user_id'];

	$stmt = $db->prepare('SELECT COUNT(*) FROM team WHERE name = ? AND manager_id = ?');
	$stmt->bind_param('si', $name, $manager_id);
	$stmt->execute();
	$stmt->bind_result($result);

    if ($result == 0)
	{
		$stmt->close ();

		$stmt = $db->prepare('INSERT INTO team VALUES (NULL, ?, ?)');
		$stmt->bind_param('si', $name, $manager_id);

		if (!$stmt->execute())
			echo $db->error;
		else
			echo 'true';
	}
    else
        echo 'already exist';

	if (!$stmt->fetch())
    	echo 'false';

	$stmt->close ();
	$db->close ();
?>
