<?php
session_start();

$dblink = mysql_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());
mysql_select_db('ecommerce') or die('Could not select database');

$query = "insert into shopping_cart  (asdfasdfasd,asdf,as,) values ()";
    $result = mysql_query($query) or die('Search Failed.  Return to <a href="/test/items.php">Back</a>.  ');



?>