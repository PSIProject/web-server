<?php
////////////////////////////////////////////
/// Store task's id in $_SESSION. It's sent
/// by client using POST method.
////////////////////////////////////////////
    require 'connect-db.inc';

    session_start();
    $response = new stdClass();

    $db = connect_db();
    $response = new stdClass();
    $task_id = $_POST ['task_id'];
    $goal_id = $_SESSION ['goal_id'];

    $stmt = $db->prepare('SELECT COUNT(*) FROM task WHERE id = ? AND goal_id = ?');
    $stmt->bind_param('ii', $task_id, $goal_id);
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch ();

    if ($result == '1')
    {
        $_SESSION ['task_id'] = $task_id;
        $response->status = 'ok';
    }
    else
        $response->status = 'error';

    $stmt->close ();
    $db->close ();
    echo json_encode($response);
?>
