<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include(dirname(__DIR__)."/DBconnect/db.php");
$db =new DB();
$db->connectDB();

class Admin
{
    public function browseInventory()
    {
        // prepare select SQL
        $sql = sprintf("SELECT * FROM items");

        // execute query
        if(($result = mysql_query($sql))&& mysql_num_rows($result))
        {
            
            while($row = mysql_fetch_array($result))
            {
                $array[] = $row; 
            }
        }
        
        return $array;
        
    }
    
    public function deleteInventory($item_id)
    {
        //prepare delete SQL
        $sql = sprintf("DELETE FROM items where item_id ='%d'", $item_id);
      
        //execute delete
        if(($result = mysql_query($sql)))
        {
            return TRUE;
        }else
            return FALSE;
         
    }
    
    public function addItem($array)
    {
        $item_name = stripslashes($array["item_name"]); 
        $description = stripslashes($array['description']);
        $category = stripslashes($array['category']);
        $brand = stripslashes($array['brand']);
        $gender = stripslashes($array['gender']);
        $compared_price = stripslashes($array['compared_price']);
        
        //Make the fields safe
        $item_name = mysql_escape_string($item_name);
        $description = mysql_escape_string($description);
        $category = mysql_escape_string($category);
        $brand = mysql_escape_string($brand);
        $gender = mysql_escape_string($gender);
        $compared_price = mysql_escape_string($compared_price);
        
        
        //execute INSERT SQL
        $sql = "INSERT INTO items (item_name,description,date_added,category,brand,gender,compared_price) VALUES ('$item_name','$description',NOW(),'$category','$brand','$gender','$compared_price')";
     
        if(($result = mysql_query($sql))&& mysql_num_rows($result))
        {
            return TRUE;
        }else
            return FALSE;
    }
    
    public function browseOne($item_id)
    {
        //prepare select SQL
        $sql = sprintf("SELECT item_name,description,date_added,category,brand,gender,compared_price FROM items where item_id ='%d'", $item_id);
        
        //execute delete
        if(($result = mysql_query($sql))&& mysql_num_rows($result))
        {
            $row = mysql_fetch_array($result);
          
            return $row;
        }
    }
    
    public function updateInventory($array)
    {
        $item_id = stripslashes($array["item_id"]); 
        $item_name = stripslashes($array["item_name"]); 
        $description = stripslashes($array['description']);
        $date_added = stripslashes($array['date_added']);
        $category = stripslashes($array['category']);
        $brand = stripslashes($array['brand']);
        $gender = stripslashes($array['gender']);
        $compared_price = stripslashes($array['compared_price']);
        
        //Make the fields safe
        $item_id = mysql_escape_string($item_id);
        $item_name = mysql_escape_string($item_name);
        $description = mysql_escape_string($description);
        $date_added = mysql_escape_string($date_added);
        $category = mysql_escape_string($category);
        $brand = mysql_escape_string($brand);
        $gender = mysql_escape_string($gender);
        $compared_price = mysql_escape_string($compared_price);
        
        
        //execute INSERT SQL
        $sql = "UPDATE items SET item_name='$item_name',description='$description',date_added='$date_added',category='$category',brand='$brand',gender='$gender',compared_price='$compared_price' WHERE item_id='$item_id'";
     
        if(($result = mysql_query($sql))&& mysql_num_rows($result))
        {
            return TRUE;
        }else
            return FALSE;
    }
    
    public function addInventory($array)
    {
        $price = stripslashes($array["price"]); 
        $quantity = stripslashes($array['quantity']);
        $size = stripslashes($array['size']);
        $color = stripslashes($array['color']);
        $item_id = stripslashes($array['item_id']);
        $width = stripslashes($array['width']);
        $compared_price = stripslashes($array['compared_price']);
        
        //Make the fields safe
        $price = mysql_escape_string($price);
        $quantity = mysql_escape_string($quantity);
        $size = mysql_escape_string($size);
        $color = mysql_escape_string($color);
        $item_id = mysql_escape_string($item_id);
        $width = mysql_escape_string($width);
        $compared_price = mysql_escape_string($compared_price);
        
        
        //execute INSERT SQL
        $sql = "INSERT INTO inventory (price,quantity,size,color,items_id,width,compared_price) VALUES ('$price','$quantity','$size','$color','$item_id','$width','$compared_price')";
     
        if(($result = mysql_query($sql))&& mysql_num_rows($result))
        {
            return TRUE;
        }else
            return FALSE;
    }
    
    
}
?>
