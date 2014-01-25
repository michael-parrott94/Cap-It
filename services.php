<?php
    include 'functions.php';
    // Load database since we'll probably use it for every service
    $dbconn = loadHerokuDB();
    
    if(!$dbconn)
    {
        die("error in connection: " . pg_last_error());
    }
    
    // Set the texts that the user submitted
    if(isset($_POST['user_caption']) && isset($_POST['fb_id']))
    {
        var_dump($_POST);
        $setTextsQuery = "UPDATE users SET caption_text = '$1' WHERE user_fb_id = $2";
        var_dump($setTextsQuery);
        $textResults = pg_query_params($dbconn, $setTextsQuery, array($_POST['user_caption'], $_POST['fb_id']));
        var_dump($textResults);
        $err = pg_last_error();
        var_dump($err);
    }
    
    // Caption actions
    if(isset($_POST['caption']) && is_string($_POST['caption']))
    {
        // Get the user
        $userID = intval($_POST['user_id']);
        
        if($_POST['caption'] == 'set')
        {
            // Get the caption text that the user wants to write and
            // save it on the server
            $captionText = $_POST['caption_text'];
            
            $updateCaptionQuery = 'UPDATE users COLUMN caption_text SET $1';
            $prepareUpdateQuery = pg_prepare($dbconn, 'update_caption', $updateCaptionQuery);
            $updateResult = pg_execute($dbconn, 'update_caption', array($captionText));
            
        }
        else if($_POST['caption'] == 'get')
        {
            $getCaptionQuery = 'SELECT caption_text FROM users WHERE user_id = $1';
            $getCaptionResult = pg_query_params($dbconn, $getCaptionQuery, array($userID));
            $row = pg_fetch_array($getCaptionResult);
            echo $row['caption_text'];
            
            
            
        }
    }
    
    // Group actions
    if(isset($_POST['group']) && is_string($_POST['group']))
    {
        $groupAction = $_POST['group'];
        
        // create a group
        if($groupAction == 'create')
        {
            // When creating a group, send the FB id of the user who created the group and add them automatically.
            $creatorID = $_POST['user'];
            
            // Add the group
            $groupAddQuery = 'INSERT INTO groups (group_id, user_id_1, user_id_2, user_id_3, user_id_4, picture_link) VALUES (DEFAULT, DEFAULT, $1, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT)';
            $prepareAddQuery = pg_prepare($dbconn, 'add_group', $groupAddQuery);
            $groupAddResult = pg_query($dbconn, "add_group", array($creatorID));
            
            //Get the group ID of what we just inserted
            $groupIDQuery = "SELECT currval('group_id_seq')";
            $groupIDResult = pg_query($dbconn, $groupIDQuery);
            $groupID = pg_fetch_array($groupIDResult);
            $groupID = $groupID[0];
            
            // Add the group and creator ID to our many-to-many table
            $groupUserQuery = 'INSERT INTO users_groups (group_id, user_id_1, user_id_2, user_id_3, user_id_4, picture_link) VALUES ($1, $2, DEFAULT, DEFAULT, DEFAULT, DEFAULT)';
            $prepareGroupUser = pg_prepare($dbconn, "group_user", $groupUserQuery);
            $groupUserResult = pg_execute($dbconn, "group_user", array($groupID, $creatorID));
            
            echo $groupID;
            
        }
        // Add a user
        else if($groupAction == 'add')
        {
            $userID = $_POST['user_add_id']; // Person being added
            $groupID = $_POST['user_adding_id']; // Person doing the adding
            
            $getGroupIdQuery = 'SELECT group_id FROM users where user_id = $1';
            $prepareGroupIDQuery = pg_prepare($dbconn, 'get_group_id', $getGroupIdQuery);
            $groupIDResult = pg_execute($dbconn, 'get_group_id', $prepareGroupIDQuery);
            
            
            
            $groupInfoQuery = 'SELECT * FROM groups WHERE group_id = $1';
            $prepareGroupInfoQuery = pg_prepare($dbconn, 'get_group_info', $groupInfoQuery);
            $groupInfoResults = pg_execute($dbconn, 'get_group_info', array($groupID));
            
            $row = pg_fetch_array($groupInfoResults);
            // user_id_(1-4) is location in indices 1-4
            for($i = 2; $i <= 4; $i++)
            {
                if($row[$i] != -1)
                {
                    //Found an empty slot, add the user here
                    $addUserQuery = 'UPDATE groups SET user_id_' . $i . ' WHERE group_id = $1';
                    $prepareAddUserQuery = pg_prepare($dbconn, 'add_user_group', $addUserQuery);
                    $addUserResults = pg_execute($dbconn, 'add_user_group', array($groupID));
                    
                    break;
                }
            }
            
            $groupAddQuery = 'INSERT INTO groups (group_id, picture_id) VALUES (DEFAULT, DEFAULT)';
        }
        // Set the group photo
        else if($groupAction == 'photo')
        {
            $photoLink = $_POST['photo_link'];
            
            // Store this photo in the database
            $groupUserQuery = 'INSERT INTO users_groups (group_id, user_id) VALUES ($1, $2)';
            $prepareGroupUser = pg_prepare($dbconn, "group_user", $groupUserQuery);
            $groupUserResult = pg_execute($dbconn, "group_user", array($groupID, $creatorID));
            $photoAddQuery = 'UPDATE groups SET picture_id = $1 WHERE group_id =';
        }
    }
    
    //User actions
    if(isset($_POST['user']))
    {
        // When logging into Facebook, automatically add user to our database
        // If they aren't already there.
        if($_POST['user'] == 'add')
        {
            $userFBID = $_POST['fb_id'];
            $userName = $_POST['fb_name'];
            $userPP = $_POST['fb_pp'];
            
            //Check if this user exists already.
            $checkUserQuery = 'SELECT COUNT(*) FROM users WHERE user_fb_id = $1';
            $prepareUserQuery = pg_prepare($dbconn, "user_add", $checkUserQuery);
            $checkUserResult = pg_execute($dbconn, "user_add", array($userFBID));
            
            $num = pg_fetch_array($checkUserResult);
            if(intval($num[0]) <= 0)
            {
                $addUserQuery = 'INSERT INTO users (user_id, user_fb_id, caption_text, group_id, name, fb_pp) VALUES (DEFAULT, $1, DEFAULT, DEFAULT, $2, $3)';
                $prepareAddUser = pg_prepare($dbconn, 'user_add_', $addUserQuery);
                $addUserResult = pg_execute($dbconn, 'user_add_', array($userFBID, $userName, $userPP));
                
                if($addUserResult == False)
                {
                    echo 'user addition failed';
                }
                else
                {
                    echo 'user added';
                }
            }
            else
            {
                echo 'user exists';
            }
        }
        else if($_POST['user'] == 'all')
        {  
            $results = getUsersData($dbconn);
            echo json_encode($results);
        }
    }
    
    // Close the connection
    closeHerokuDB($dbconn);
?>
