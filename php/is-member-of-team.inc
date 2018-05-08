<?php
    /// Verify if the current user is member of the team
    function isMemberOfTeam($db, $user_id, $team_id)
    {
        $stmt = $db->prepare('SELECT COUNT(*) FROM collaborate WHERE collaborator_id = ? AND team_id = ?');
    	$stmt->bind_param('ii', $user_id, $team_id);
    	$stmt->execute();
    	$stmt->bind_result($result);
        $stmt->fetch()

        if($result == '1')
            return true;
        else
            return false;
    }
?>
