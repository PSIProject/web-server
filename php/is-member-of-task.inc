<?php
    /// Verify if the current user is member of the task
    function isMemberOfTask($db, $user_id, $task_id)
    {
        $stmt = $db->prepare('SELECT COUNT(*) FROM assigned_to WHERE collaborator_id = ? AND task_id = ?');
    	$stmt->bind_param('ii', $user_id, $task_id);
    	$stmt->execute();
    	$stmt->bind_result($result);
        $stmt->fetch();

        if ($result == '1')
            return true;
        else
            return false;
    }
?>
