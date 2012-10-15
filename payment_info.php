<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script type="text/javascript">
            function getShippingInfo(shippingId){
                
            }
            
        </script>
    </head>
    <body>
        <div style="">
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
                        <input type="text" name="name" value=""/>
                        </li>
                        <li><lable for="address1">Address 1:</lable>
                        <input type="text" name="address1" value=""/>
                        </li>
                        <li><lable for="address2">Address 2(Optional):</lable>
                        <input type="text" name="address2" value=""/>
                        </li>
                        <li><lable for="name">City:</lable>
                        <input type="text" name="city" value=" "/>
                        </li>
                        <li>
                        <lable for="state">State:</lable>
                        <select name="state">
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
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
            <ol style="list-style: none">
                <li><lable for="name">Recipient Name:</lable>
                <input type="text" name="" value=""/>
                </li>
                <li><lable for="address1">Address 1:</lable>
                <input type="text" name="" value=""/>
                </li>
                <li><lable for="address2">Address 2(Optional):</lable>
                <input type="text" name="" value=""/>
                </li>
                <li><lable for="name">City:</lable>
                <input type="text" name="" value=""/>
                </li>
                <li>
                <lable for="name">State:</lable>
                <select name="state">
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>
                </li>
                <li>
                <lable name="">Zipcode</lable>
                <input type="text" name="zipcode"/>
                </li>                
            </ol>
        </div>
        <div id="order_summary">
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
                        <td><input type="hidden" name="item" value="<?php echo $item ?>"/><?php echo $item ?></td>
                        <td><input type="text" name="quantity" value="<?php echo $val['quantity'] ?>"/></td>
                        <td><?php echo $val['price'] ?></td>
                    </tr>
                    <?php
                    $totalPrice += $val['price'];
                    $index++;
                }
                echo "<tr><td colspan='3'>Total Price : $totalPrice</td></tr>";
                echo "<tr><td colspan='3'><a href='javascript:order();'>Place Order</a></td></tr>";
            }
            ?>
            </table>
        </div>
        </div>
    </body>
</html>