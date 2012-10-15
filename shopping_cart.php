<?php session_start(); ?>
<html>
    <head>
        <script type="text/javascript">
            function update_cart(obj){
                var item = document.getElementsByName("item")[obj].value;
                var quantity = document.getElementsByName("quantity")[obj].value;
                url = "update_cart.php?item=" + item + "&quantity=" + quantity + "&url=<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>";
                location.href=url;
            }
            
            function deleteItem(){
                
            }
            function goBack(){
                window.history.back();
            }
            function goPayment(){
                var item_id = getElementsByName("item_id");
                if(item_id[].length > 1){
                    
                    
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
                    $dbLink = mysql_connect();
                    mysql_select_db("ecommerce");
                    
                } else {

                    $cart = $_SESSION['cart'];
                    $index = 0;
                    $query = "SELECT A.ITEM NAME ITEM_NAME, B.PRICE PRICE FROM ITEM A, INVENTORY B 
                        WHERE A.ITEM_ID = B.ITEM_ID AND B.INVENTORY_ID = ";
                    foreach ($cart as $item => $val) {
                        $result = mysql_query($query. $val['inventory_id']);
                        ?>
                        <tr>
                            <td><input type="hidden" name="item" value="<?php echo $item ?>"/><?php echo $item ?></td>
                            <td><a href="item_detail.php?item_id=<?php echo $item_id ?>" style="text-decoration: none"><?php echo $result['item_name'] ?></a></td>
                            <td><input type="text" name="quantity" value="<?php echo $val['quantity'] ?>"/></td>
                            <td><?php echo $result['price'] ?></td>
                            <td>
                                <input type="button" name="update" value="update" onclick="javascript:update_cart(<?php echo $index ?>);"/>
                                <input type="button" name="delete" value="delete" 
                                       onclick='location.href="delete_cart.php?item=<?php echo $item; ?>&url=<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>"'/>
                            </td>
                        </tr>
        <?php
        $index++;
    }
}
?>

            </form>
        </table>
           
        <span class="but"><a href="javascript.goBack();">Back to Shop</a></span>
        <span class="but"><a href="javascript:goPayment();" style="text-decoration: none">Check Out</a></span>

        </div>
      </div>
    </body>
</html>