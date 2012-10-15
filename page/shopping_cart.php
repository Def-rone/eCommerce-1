<?php 
session_start(); 
ini_set('display_errors', 'On');

?>
<html>
    <head>
        <script type="text/javascript">
            function update_cart(obj){
                var item = document.getElementsByName("item")[obj].value;
                var quantity = document.getElementsByName("quantity")[obj].value;
                var inventory_id = document.getElementsByName("inventory_id")[obj].value;
                url = "update_cart.php?item=" + item + "&inventory_id=" + inventory_id +"&quantity=" + quantity + "&url=<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>";
                location.href=url;
            }
            
            function deleteItem(){
                
            }
            function goBack(){
                location.href="items.php";
            }
            function goPayment(){
                var item_id = document.getElementsByName("item");
                if(item_id.length >= 1){
                    location.href='payment_info.php';
                } 
                    
            }
        </script>
        <style type="text/css">
            #body_div{
                margin-left: auto;
                margin-right: auto;
                width: 800px;

            }
            #main{
                margin-left: auto;
                margin-right: auto;
                width: 800px;
                
            }
            #cart_table{
                width: 800px;
                text-align: center;

            }
            #cart_table th{
                background-color: background;
                color: white;
            }
            #cart_table tr:hover {
               background-color: bisque;
               color: midnightblue;
            }
            .but{
                text-decoration: none;
                float:right;
                padding:0px;
                margin-left: 10px;
                margin-top: 10px;
               
            }
            .but a{
                text-decoration: none;
                background-color: lightgoldenrodyellow;
                width: 120px;
                height: 40px;
                padding: 8px 15px 8px 15px;
                text-align: center;
                border-right: 2px solid black;
                border-bottom: 2px solid black;
                
            }
            .but a:hover{
                background-color: khaki;
                color:activecaption;
            }
        </style>
    </head>
    <body>
        <div id="body_div">
        <div id="head">
            <a href="items.php"><img src="logo.jpg" ></a>
        </div>
        <div id="main">
                <?php 
                if(!isset($_SESSION['username'])){
                    echo "<a href='login.php'>Sign Up</a>";
                }else{
                    echo "<span style='font-style:italic;font-weight: bold;margin:5px;'>".$_SESSION['username']."'s</span> Shopping Cart";
                }
                ?>
                <span style>
        <table id="cart_table">
            <tr>
                <th>Item Id</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th></th>
            </tr>
            <?php
            if (!isset($_SESSION['cart']) || $_SESSION['cart'] == null) {
                ?>
                <tr>
                    <td colspan="5">No item in the shopping cart.</td>
                </tr>
                <form action="update_cart.php" method="post">
                    <?php
                        } else {
                            $dblink = mysql_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());
                            mysql_select_db('my_db') or die('Could not select database');

                            $cart = $_SESSION['cart'];
                            $index = 0;
                            $query = "select a.item_name item_name, b.price price from items a, inventory b where a.item_id = b.items_id and b.inventory_id ='";
                            $query1 = "select 'hello' as item, '100' as price from dual;";
                            foreach ($cart as $inventory_id => $val) {
                                $item = $val['item'];
                                $result = mysql_query($query.$inventory_id."';") or die("<span style='color:red;font-weight:bold'>Cannot access database</span>");
                                $row = mysql_fetch_array($result);
                                
                    ?>
                        <tr>
                            <td><input type="hidden" name="item" value="<?php echo $item ?>"/>
                                <input type="hidden" name="inventory_id" value="<?php echo $inventory_id ?>"/>
                                <?php echo $item ?></td>
                            <td><a href="item_detail.php?items_id=<?php echo $item ?>" style="text-decoration: none"><?php echo $row['item_name'] ?></a></td>
                            <td><input type="text" name="quantity" value="<?php echo $val['quantity'] ?>" maxlength="3"/></td>
                            <td><?php echo $row['price'] ?></td>
                            <td>
                                <input type="button" name="update" value="update" onclick="javascript:update_cart(<?php echo $index ?>);"/>
                                <input type="button" name="delete" value="delete" 
                                       onclick='location.href="delete_cart.php?item=<?php echo $item; ?>&inventory_id=<?php echo $inventory_id ?>&url=<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>"'/>
                            </td>
                        </tr>
                    <?php
                                $index++;
                                
                            }
                            mysql_close($dblink);
   
                        }
                    ?>
            </form>
        </table>
        <span class="but"><a href="javascript:goBack();">Back to Shop</a></span>
        <span class="but"><a href="javascript:goPayment();" style="text-decoration: none">Check Out</a></span>

        </div>
      </div>
    </body>
</html>