<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script type="text/javascript">
            
            
            function getShippingInfo(shippingId){
                
            }
            function updatePayment(){
                
            }
            
            function test(obj){
                var o = document.getElementById("payment_form");
                o['style']['background'] = "black";
            }
            
            function checkPaymentForm(obj){
                
            }
            
            function displayPaymentInfo(val){
                if(val == null || val) {
                    //if the value is not set, display an empty form to fill up.
                    return;
                }
                
                //from here fill up the form.
            }
        </script>
        <script type="text/javascript" src="payment.js"></script>
        <link rel="stylesheet" href="./ecommerce.css" type="text/css"/>
        <link rel="stylesheet" href="./payment_form.css" type="text/css"/>
    </head>
    <body>
        <div id="body_div">
            <div id="head">
                <a href="items.php"><img src="logo.jpg" /></a>
            </div>
            <div id="main">
                <div id="payment_form">
                    <fieldset>
                        <legend>Payment Information</legend>
                            <select id="payment_select" name="payment_select">
                                <option selected>== Choose Saved Payment Info == </option>
                                <option value="">******5284</option>
                                <option value="">******3948</option>
                                <option onselect="javascript:">Insert</option>
                            </select>
                        <div id="payTargetForm"></div>
                    </fieldset>
                </div>
                <div id="shipping_info">

                    <fieldset>
                        <legend>Shipping Information</legend>
                        <select name="payment">
                            <option selected>== Choose Saved Shipping Info == </option>
                            <option value="">******5284</option>
                            <option value="">******3948</option>
                            <option onselect="javascript:">Insert</option>
                        </select>

                        <ol style="list-style: none">
                            <li><label for="name">Recipient Name:</label>
                                <input type="text" name="" value=""/>
                            </li>
                            <li><label for="address1">Address 1:</label>
                                <input type="text" name="" value=""/>
                            </li>
                            <li><label for="address2">Address 2(Optional):</label>
                                <input type="text" name="" value=""/>
                            </li>
                            <li><label for="name">City:</label>
                                <input type="text" name="" value=""/>
                            </li>
                            <li>
                                <label for="name">State:</label>
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
                                <label name="">Zipcode</label>
                                <input type="text" name="zipcode"/>
                            </li>                
                        </ol>
                    </fieldset>
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
                                        <td><input type="hidden" name="item" value="<?php echo $item ?>"/><?php echo $item ?></td>
                                        <td><input type="text" name="quantity" value="<?php echo $val['quantity'] ?>"/></td>
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
                    <span class='but'><a href='javascript:order();'>Place Order</a></span>

                </div>
            </div> 
        </div>
    </body>
</html>