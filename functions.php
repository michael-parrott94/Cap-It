<?php
    function load_heroku_db()
    {
        return pg_connect("host=ec2-54-197-241-91.compute-1.amazonaws.com port=5432 dbname=d65t2it35j2n1v user=qbvtfhdthkmlmu password=8kv-mljjzibMSa3fL9KcHDDAcB");
    }
    
    function get_users_data()
    {
        $getUsersQuery = 'SELECT * FROM users';
        $usersResult = pg_query($dbconn, $getUsersQuery);
        $results = array();
        while($row = pg_fetch_array($usersResult))
        {
            $results[] = $row;
        }
    }
?>
