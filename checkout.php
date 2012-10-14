<?php
# checkout.php
# Takes in items, payment, and shipping information, and create order table.
# is it coming from session ?

    $$_REQUEST[''];
    
    
    $dblink = mysql_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());
mysql_select_db('ecommerce') or die('Could not select database');

    $query = "";
    $result = mysql_query($query) or die('Search Failed.  Return to <a href="/test/items.php">Back</a>.  ');


?>