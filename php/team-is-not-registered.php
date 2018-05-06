<?php
	require 'connect-db.inc';

	$db = connect_db();
	$name = $_POST ['name'];

	$stmt = $db->prepare('SELECT COUNT(*) FROM team WHERE name = ?');
	$stmt->bind_param('s', $name);
	$stmt->execute();
	$stmt->bind_result($result)

    if ($stmt->fetch())
    {
        if ($result == 0)
            echo 'true';
        else
            echo 'already exist';
    }
    else
        echo 'false';

	$stmt->close ();
	$db->close ();
?>
