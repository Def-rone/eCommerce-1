<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include(dirname(__DIR__)."/DBconnect/db.php");
$db =new DB();
$db->connectDB();

class OrderFileGenerator {
    
    public function createOderFile($order_id, $array){
       // echo "createOrderFile iinvoked";
        $file_directory = dirname(__DIR__)."/orders/".$order_id.'.rtf';
        $ourFileHandle = fopen($file_directory,'w+') or die("can't open file");
        $file = file_get_contents($file_directory,true);
        $arr = array("Customer Identifying Number"=>$array['users_userid'],
            "Order Identifying Number"=>$array['order_id'],
            "Credit Card Number"=>$array['credit_card_num'],
            "Amount"=>$array['total_price'],
            "Order Date"=>$array['order_date']
            );
        foreach($arr as $key => $value){
            $file.="$key: $value.\n";
        }
        
        file_put_contents($file_directory, $file);
        fclose($ourFileHandle);
    }
    
    public function getFileContents($order_id){
        
        $sql = sprintf("SELECT users_userid,order_id,credit_card_num,total_price,order_date FROM orders where order_id ='%d'", $order_id);
       
        //execute delete
        if(($result = mysql_query($sql))&& mysql_num_rows($result))
        {
            $row = mysql_fetch_array($result);
        
            return $row;
        }
    }
    


}
?>
