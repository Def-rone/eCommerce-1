<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script type="text/javascript" src="payment.js"></script>
        <link rel="stylesheet" href="./ecommerce.css" type="text/css"/>
        <link rel="stylesheet" href="./payment_form.css" type="text/css"/>
    </head>
    <body>
        <div id="body_div">
            <!-- form name="order_form" action="checkout.php" method="post" -->
            <div id="head">
                <a href="items.php"><img src="logo.jpg" /></a>
            </div>
            <div id="main">
                <form id="order" name="order" method="POST" action="checkout.php">
                <div id="payment_form">
                    <fieldset>
                        <legend>Payment Information</legend>
                            <select id="payment_select" name="payment_select">
                            </select>
                        <div id="payTargetForm"></div>
                    </fieldset>
                </div>
                <div id="shipping_info">
                    <fieldset>
                        <legend>Shipping Information</legend>
                        <select id="shipment_select" name="shipment_select">
                        </select>
                        <div id="shipTargetForm"></div>
                    </feldset>
                </div>
                <div id="order_summary">
                    <fieldset>
                        <legend>Order Summary</legend>
                        <table>
                            <?php
                            session_start();
                            if (!isset($_SESSION['cart']) || $_SESSION['cart'] == null) {
                                echo "<tr><td>You don't have item in your cart.</td></tr>";
                            } else {
                                $cart = $_SESSION['cart'];
                                $totalPrice = 0;
                                echo "<tr>
                    <td>Item Id</td>
                    <td>Item Name</td>
                    <td>Quantity</td>
                    <td>Price</td>
                    </tr>";
                                foreach ($cart as $item => $val) {
                                    ?>
                                    <tr>
                                        <td><input type="hidden" name="item" value="<?php echo $item ?>"/><?php echo $item ?></td>
                                        <td><input type="hidden" name="item_name" value="<?php echo $val['item_name'] ?>"/><?php echo $val['item_name'] ?></td>
                                        <td><input type="text" name="quantity" value="<?php echo $val['quantity'] ?>"
                                                   style="outline:none"/></td>
                                        <td><?php echo $val['price'] ?></td>
                                    </tr>
                                    <?php
                                    $totalPrice += $val['price'];
                                    $index++;
                                }
                                echo "<tr><td colspan='5'>Total Price : $totalPrice</td></tr>";
                            }
                            ?>
                        </table>
                    </fieldset>
                    <span class='but'><a href='javascript:order(document.getElementById("order"));return false;'>Place Order</a></span>
                </div>
                </form>
            </div> 
            <!--/form -->
        </div>
    </body>
</html>i