<?php
    // Load database since we'll probably use it for every service
    $dbconn = pg_connect("host=ec2-54-197-241-91.compute-1.amazonaws.com port=5432 dbname=d65t2it35j2n1v user=qbvtfhdthkmlmu password=8kv-mljjzibMSa3fL9KcHDDAcB");
    
    if(!$dbconn)
    {
        die("error in connection: " . pg_last_error());
    }
    
    // Caption actions
    if(isset($_POST['caption']) && is_string($_POST['caption']))
    {
    }
    
    // Group actions
    if(isset($_POST['group'] && is_string($_POST['group']))
    {
        $groupAction = $_POST['group'];
        
        // create a group
        if($groupAction == 'create')
        {
            // When creating a group, send the FB id of the user who created the group and add them automatically.
            $creatorID = $_POST['user'];
            
            // Add the group
            $groupAddQuery = 'INSERT INTO groups (group_id, picture_id) VALUES (DEFAULT, DEFAULT)';
            $groupAddResult = pg_query($dbconn, $groupAddQuery);
            
            //Get the group ID of what we just inserted
            $groupIDQuery = "SELECT currval('group_id_seq')"
            $groupIDResult = pg_query($dbconn, $groupIDQuery);
            $groupID = $groupIDResult[0][0];
            
            // Add the group and creator ID to our many-to-many table
            $groupUserQuery = 'INSERT INTO users_groups (group_id, user_id) VALUES ($1, $2)');
            $prepareGroupUser = pg_prepare($dbconn, "group_user", $groupUserQuery);
            $groupUserResult = pg_execute($dbconn, "group_user", array($groupID, $creatorID);
            
        }
        // Add a uesr
        else if($groupAction == 'add')
        {
            $userID = $_POST['user'];
            $groupID = $_POST['id'];
            
            
        }
        else if($groupAction == 'delete')
        {
        }
    }
    
    if(isset($_POST[''])
    {
    }
    
    // Close the connection
    pg_close($dbconn);
?>
