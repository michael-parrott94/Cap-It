<?php
    function loadHerokuDB()
    {
        return pg_connect("host=ec2-54-197-241-91.compute-1.amazonaws.com port=5432 dbname=d65t2it35j2n1v user=qbvtfhdthkmlmu password=8kv-mljjzibMSa3fL9KcHDDAcB");
    }
    
    function closeHerokuDB($db)
    {
        pg_close($db);
    }
    
    function getUsersData($db)
    {
        $getUsersQuery = 'SELECT * FROM users';
        $usersResult = pg_query($db, $getUsersQuery);
        $results = array();
        while($row = pg_fetch_array($usersResult))
        {
            $results[] = $row;
        }
        return $results;
    }
    
    function updateScore($db, $fb_id, $scoreIncrement)
    {
        // Get the old score
        $getScoreQuery = 'SELECT scores FROM users WHERE user_fb_id = $1';
        $getScoreResult = pg_query_params($db, $getScoreQuery, array($fb_id));
        $score = pg_fetch_array($getScoreResult);
        $score = $score[0];
        
        // Update the new score.
        $score += $scoreIncrement;
        $updateScoreQuery = 'UPDATE users SET scores = $1 WHERE user_fb_id = $2';
        $updateScoreResult = pg_query_params($db, $updateScoreQuery, array($score, $fb_id));
    }
    
    function getUserIDByFBID($db, $FBID)
    {
        //Check if this user exists already.
        $checkUserQuery = 'SELECT user_id FROM users WHERE user_fb_id = $1';
        $checkUserResult = pg_query_params($db, $checkUserQuery, array($userFBID));
        
        $num = pg_fetch_array($checkUserResult);
        if(intval($num[0]) <= 0)
        {
            
        }
    }
?>
