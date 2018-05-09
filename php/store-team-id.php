<?php
////////////////////////////////////////////
/// Store team's id in $_SESSION. It's sent
/// by client using POST method.
////////////////////////////////////////////
    require 'connect-db.inc';
    require 'is-member-of-team.inc';

    session_start();
    $response = new stdClass();

    $db = connect_db();
    $team_id = $_POST ['team_id'];
    $user_id = $_SESSION ['user_id'];

    if (isMemberOfTeam($db, $user_id, $team_id))
    {
        $_SESSION ['team_id'] = $team_id;
        $response->status = 'ok';
    }
    else
        $response->status = 'error';

    $db->close ();
    echo json_encode($response);
?>
