////////////////////////////////////////////
/// Store team's id in $_SESSION. It's sent
/// by client using POST method.
////////////////////////////////////////////

<?php
    require 'connect-db.inc';
    session_start();

    $db = connect_db();
    $team_id = $_POST ['team_id'];
    $user_id = $_SESSION ['user_id'];

    if (isMemberOfTeam($db, $user_id, $team_id)
    {
        $_SESSION ['team_id'] = $_team_id;
        echo 'ok';
    }
    else
        echo 'error';
    $db->close ();
?>
