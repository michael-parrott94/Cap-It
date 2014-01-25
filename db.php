<h1>top</h1>
<?php
    $dbconn = pg_connect("host=ec2-54-197-241-91.compute-1.amazonaws.com port=5432 dbname=d65t2it35j2n1v user=qbvtfhdthkmlmu password=8kv-mljjzibMSa3fL9KcHDDAcB");
    
    if(!$dbconn)
    {
        die("error in connection: " . pg_last_error());
    }
    
    $query_test = 'SELECT * FROM captions';
    
    $result = pg_query($dbconn, $query_test);
    
    while($row = pg_fetch_array($result))
    {
        echo 'ID: ' . $row[0] . '</br>';
        echo 'Text: ' . $row[1] . '</br>';
    }
    
    pg_free_result($result);
    
    pg_close($dbconn);
?>

<h1>WOO</h1>
