<?php
    $dbconn = pg_connect("host=ec2-54-197-241-91.compute-1.amazonaws.com port=5432 dbname=d65t2it35j2n1v user=qbvtfhdthkmlmu password=8kv-mljjzibMSa3fL9KcHDDAcB") or die('connection failure')

    // Prepare a query for execution
    $result = pg_prepare($dbconn, "my_query", 'SELECT * FROM test2');

    // Execute the prepared query.  Note that it is not necessary to escape
    // the string "Joe's Widgets" in any way
    $result = pg_execute($dbconn, "my_query", array());
    
    var_dump($result);
?>

<h1>WOO</h1>
