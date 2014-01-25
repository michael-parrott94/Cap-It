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
    }
    
    function updateScore($db, $scoreIncrement)
    {
        
    }
?>
