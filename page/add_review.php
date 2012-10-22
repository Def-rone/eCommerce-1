<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
ini_set('display_errors', 'On');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if (!isset($_REQUEST['item_id']) || !isset($_REQUEST['review_text'])) {
            echo "error: null value in the request";
            #TODO : return back to the previous page
        } else {
            $items_id = $_REQUEST['item_id'];
            $review_text = $_REQUEST['review_text'];
            $dblink = mysql_connect('localhost', 'root', '') or die("DB Access denied");
            mysql_select_db("my_db") or die("DB schema not selected");
            if (!isset($_SESSION['username']) || $_SESSION['username'] == null) {
                
                $user_id = "guest";
            } else {
                $user_id = $_SESSION[username];
            }
            $query = "INSERT INTO my_db.comment (commant_id ,username ,comment ,date ,item_id )
                VALUES (NULL , '" .$user_id  . "', '" . $review_text . "', CURRENT_TIMESTAMP , '" . $items_id . "');";
            $result = mysql_query($query) or die("Cannot get the data");
        }
        ?>
    </body>
</html>
