<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <div id="payment_form">
            <fieldset>
                <form name="" action="./checkout.php" method="post">
                    <select>
                        <option>Payment method</option>
                        <option>Credit Card</option>
                        <option>Paypal</option>
                        <option>Debit Card</option>
                    </select>
                    <ol style="list-style: none">
                        <legend>Billing Information</legend>
                        <li><lable for="name">Holder's Name:</lable>
                        <input type="text" name="" value=""/>
                        </li>
                        <li><lable for="address1">Address 1:</lable>
                        <input type="text" name="" value=""/>
                        </li>
                        <li><lable for="address2">Address 2(Optional):</lable>
                        <input type="text" name="" value=""/>
                        </li>
                        <li><lable for="name">City:</lable>
                        <input type="text" name="" value=" "/>
                        </li>
                        <li>
                        <lable for="name">State:</lable>
                        <select>
                            <option>District Columbia</option>
                            <option>District Columbia</option>
                            <option>District Columbia</option>
                            <option>District Columbia</option>
                            <option>District Columbia</option>
                        </select>
                        </li>
                        <li>
                        <lable name="">Zipcode</lable>
                        <input type="text" name="zipcode"/>
                        </li>                
                    </ol>

                    <input type="button" value="submit"/>
                </form>
            </fieldset>
        </div>
        <div id="shipping_info">
            <legend>Shipping Information</legend>
            <li><lable for="name">Holder's Name:</lable>
            <input type="text" name="" value=""/>
        </li>
        <li><lable for="address1">Address 1:</lable>
        <input type="text" name="" value=""/>
    </li>
    <li><lable for="address2">Address 2(Optional):</lable>
    <input type="text" name="" value=""/>
</li>
<li><lable for="name">City:</lable>
<input type="text" name="" value=" "/>
</li>
<li>
<lable for="name">State:</lable>
<select>
    <option>District Columbia</option>
    <option>District Columbia</option>
    <option>District Columbia</option>
    <option>District Columbia</option>
    <option>District Columbia</option>
</select>
</li>
<li>
<lable name="">Zipcode</lable>
<input type="text" name="zipcode"/>
</li>                
</div>
<div id="order_summary">
    <?php
    session_start();
    if (!isset($_SESSION['cart']) || $_SESSION['cart'] == null) {
        echo "You don't have item in your cart.";
    } else {
        $totalPrice = 0;
        foreach ($cart as $item => $val) {
            ?>
            <tr>
                <td><input type="hidden" name="item" value="<?php echo $item ?>"/><?php echo $item ?></td>
                <td><input type="text" name="quantity" value="<?php echo $val['quantity'] ?>"/></td>
                <td><?php echo $val['price'] ?></td>
                <td>
                    <input type="button" name="update" value="update" onclick="javascript:update_cart(<?php echo $index ?>);"/>
                    <input type="button" name="delete" value="delete" 
                           onclick='location.href="delete_cart.php?item=<?php echo $item; ?>&url=<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>"'/>
                </td>
            </tr>
            <?php
            $totalPrice += $val['price'];
            $index++;
        }
        echo "<tr><td colspan='4'>Total Price : $totalPrice</td></tr>";
    }
    ?>
</div>
<?php
$dblink = mysql_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());
mysql_select_db('ecommerce') or die('Cannot select database');
?>
</body>
</html>