<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class DB {
    
    public function connectDB() {
        
        $username = "root";
        $password="";
        $hostname= "localhost";
        
        //connection to the database
        if(($connection = mysql_connect($hostname, $username, $password)) === FALSE)
        {
            die ("Couldn't connect to database.");
        }

        // select database
        if (mysql_select_db("my_db", $connection) === FALSE)
        {
            die("Could not select database");
        }else 
            return  TRUE; 
    }
}
?>

