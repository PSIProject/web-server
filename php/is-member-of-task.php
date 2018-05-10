<?php
///////////////////////////////////////////////////
/// Recibes user's id for verify if are member of
/// task.
///
/// Return true if is member and false if not.
///////////////////////////////////////////////////
    require 'connect-db.inc';
    session_start();

    $db = connect_db();
    $response = new stdClass();
    $user_id = $_POST ['user_id'];
    $task_id = $_SESSION ['task_id'];

    $stmt = $db->prepare('SELECT COUNT(*) FROM assigned_to WHERE collaborator_id = ? AND task_id = ?');
	$stmt->bind_param('ii', $user_id, $task_id);
	$stmt->execute();
	$stmt->bind_result($result);
    $stmt->fetch();

    if($result == '1')
        $response->status = 'true';
    else
        $response->status = 'false';

    echo json_encode($response);
    $stmt->close ();
    $db->close ();
?>
