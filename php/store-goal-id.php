<?php
////////////////////////////////////////////
/// Store goal's id in $_SESSION. It's sent
/// by client using POST method.
////////////////////////////////////////////
    require 'connect-db.inc';
    require 'is-member-of-team.inc';
    session_start();

    $db = connect_db();
    $response = new stdClass();
    $goal_id = $_POST ['goal_id'];
    $team_id = $_SESSION ['team_id'];

    $stmt = $db->prepare('SELECT COUNT(*) FROM goal WHERE id = ? AND team_id = ?');
    $stmt->bind_param('ii', $goal_id, $team_id);
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch ();

    if ($result == '1')
    {
        $_SESSION ['goal_id'] = $goal_id;
        $response->status = 'ok';
    }
    else
        $response->status = 'error';

    $db->close ();
    echo json_encode($response);
?>
