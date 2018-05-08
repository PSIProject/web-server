////////////////////////////////////////////
/// Store team's id in $_SESSION. It's sent
/// by client using POST method.
////////////////////////////////////////////

<?php
    session_start();
    $_SESSION ['team_id'] = $_POST ['team_id'];
?>
