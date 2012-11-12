<?php session_start();

$connect = mysql_connect("localhost","root","");
$result = mysql_select_db("my_db",$connect);

if(!$result){
	echo("<script> window.alert('This username does not exist. Please register.'); history.go(-1); </script>");
	}
else
{
	$sql = mysql_query("SELECT * FROM customer WHERE username='$_POST[id]' AND password='$_POST[pw]';");
	$num = mysql_num_rows($sql);
	$query = mysql_fetch_array($sql);
	
	
	if($num)
	{
		echo("<script> window.alert('Welcome.'); </script>");
                $_SESSION['username'] = $query['username'];
                $_SESSION['role'] = $query['role'];
                
                
#begin load shopping cart                
    $dblink = mysql_connect('localhost', 'root', '') or die("Cannot connect mysql");
    mysql_select_db('my_db');
    $query = "select a.inventory_id as inventory_id, a.quantity as quantity, b.items_id as item
                from shopping_cart a, inventory b
                    where a.inventory_id = b.inventory_id
                      and customer_username=\"${_SESSION["username"]}\"";
                     
                      
                      echo $query;
    $result = mysql_query($query);
    
    while($row =  mysql_fetch_array($result)){    
        echo "foreach";
        $inventory_id = $row['inventory_id'];
        $item_record = array('inventory_id' => $row['inventory_id'],
            'quantity' => $row['quantity'],
            'item'=>$row['item']);

        if(!isset($_SESSION['cart'])){ //if shopping cart does not exist, create array and assign to 'cart' variable.
            $_SESSION['cart'] = array($inventory_id => $item_record);
        }else{
            //echo "add to session";
        #TODO: need to add logic to check if there's same item in the shopping cart. If so increase the quantity.
            $_SESSION['cart'][$inventory_id] = $item_record;
        }
    }

    $query1 = "delete from shopping_cart where customer_username=\"${_SESSION['username']}\"";
#end load shopping cart 
                
                
	}
	else
	{
		echo("<script> window.alert('Username or password is incorrect.'); history.go(-1); </script>");
		return;
	}
	

        
	if($query['role']=="admin")
	{
		echo("<script> location.href='adminIndex.php'; </script>");
		
	}

	//$sess_username = $query[username];
	//$sess_role = $query[role];
	//session_register($sess_username);
	//session_register($sess_role);
	
	
	
	//Just for test
	//var_dump($_SESSION);
        
        echo("<script> location.href='items.php'; </script>");

}
	
mysql_close($connect);

?>
