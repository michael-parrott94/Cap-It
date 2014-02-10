<?php
    function loadHerokuDB()
    {
        // Load Heroku config variables if they exist; otherwise, load from db.txt
        $DB_HOST = getenv('PROD_DB_HOST');
        $DB_NAME = getenv('PROD_DB_NAME');
        $DB_PASSWORD = getenv('PROD_DB_PASSWORD');
        $DB_PORT = getenv('PROD_DB_PORT');
        $DB_USER = getenv('PROD_DB_USER');
        
        // If any one of the config vars is false, then load up db.txt (assuming the file exists)
        if((!$DB_HOST || !$DB_NAME || !$DB_PASSWORD || !$DB_PORT || !$DB_USER) && file_exists('db.txt'))
        {
            $tempVars = file('db.txt');
            // Split the file up by line, since each var has its own line
            $dbVars = array();
            for($i = 0; $i < count($tempVars); $i++)
            {
                // Split the line up by =, to get the key name and value
                $tempArr = explode('=', $tempVars[$i]);
                $dbVars[$tempArr[0]] = trim($tempArr[1]);
            }
            $DB_HOST = $dbVars['PROD_DB_HOST'];
            $DB_NAME = $dbVars['PROD_DB_NAME'];
            $DB_PASSWORD = $dbVars['PROD_DB_PASSWORD'];
            $DB_PORT = $dbVars['PROD_DB_PORT'];
            $DB_USER = $dbVars['PROD_DB_USER'];
        }

        return pg_connect("host=".$DB_HOST." port=".$DB_PORT." dbname=".$DB_NAME." user=".$DB_USER." password=".$DB_PASSWORD);
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
