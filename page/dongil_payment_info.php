<?php  session_start();
$_SESSION['username'] = 'sss';

$connect = mysql_connect("localhost","root","");
$result = mysql_select_db("my_db",$connect);

$sql1 = mysql_query("SELECT * FROM credit_card WHERE customer_username='$_SESSION[username]';");
$num1 = mysql_num_rows($sql1);
$query1 = mysql_fetch_array($sql1);
$sql4 = mysql_query("SELECT * FROM shipping_address WHERE users_userid='$_SESSION[username]';");
$num4 = mysql_num_rows($sql4);
$query4 = mysql_fetch_array($sql4);
$_SESSION['hasCreditInfo']=false;
if($num1)
{
    $_SESSION['hasCreditInfo']=true;
}
?>

<html>
    <head>
        <script type="text/javascript" src="jscript.js"></script>
        <script>
            function recall_info()
            {
                <?php
                $sql2 = mysql_query("SELECT * FROM credit_card WHERE customer_username='$_SESSION[username]';");
                //$num2 = mysql_num_rows($sql2);
                $query2 = mysql_fetch_array($sql2);               
                ?>
                
                var str = "<?=$query2['credit_card_number']?>";
                
                document.checkout_form.holder_name.value="<?=$query2['holder_name']?>";
                document.checkout_form.card_number1.value=str.substr(0,4);
                document.checkout_form.card_number2.value=str.substr(4,4);
                document.checkout_form.card_number3.value=str.substr(8,4);
                document.checkout_form.card_number4.value=str.substr(12,4);
                document.checkout_form.exp_date.value="<?=$query2['expiration_date']?>";
                document.checkout_form.b_addr1.value="<?=$query2['billing_addr_1']?>";
                document.checkout_form.b_addr2.value="<?=$query2['billing_addr_2']?>";
                document.checkout_form.b_city.value="<?=$query2['billing_city']?>";
                document.checkout_form.b_state.value="<?=$query2['billing_state']?>";
                document.checkout_form.b_zipcode.value="<?=$query2['billing_zipcode']?>";
                
                <?php
                $sql3 = mysql_query("SELECT * FROM shipping_address WHERE users_userid='$_SESSION[username]';");
                //$num3 = mysql_num_rows($sql3);
                $query3 = mysql_fetch_array($sql3);           
                ?>
                document.checkout_form.s_addr1.value="<?=$query3['address1']?>";
                document.checkout_form.s_addr2.value="<?=$query3['address2']?>";
                document.checkout_form.s_city.value="<?=$query3['city']?>";
                document.checkout_form.s_state.value="<?=$query3['state']?>";
                document.checkout_form.s_zipcode.value="<?=$query3['zipcode']?>";
                document.checkout_form.s_descript.value="<?=$query3['description']?>";

                
                    
                }
       </script>
    </head>
    <body>
        <?php
if($num1) //&&$num2
{
    $_SESSION['hasCreditInfo']=true;

    echo("<div id='prev_info'><table><tr><td align='center' colspan='12'><b>-- Saved Billing and Shipping Information --</b></td></tr>");
    echo("<tr><td align='center'><table border='1'><tr><td  align='center' colspan='6'><b>Saved Billing Information</b></td></tr><tr>");
    echo("<td width=110><b>Card Number</b></td><td colspan=5>".$query1['credit_card_number']."</td></tr><tr>");
    echo("<td><b>Holder's Name</b></td><td colspan='3'>".$query1['holder_name']."</td><td><b>Exp. Date</b></td><td>".$query1['expiration_date']."</td></tr>");
    echo("<tr><td><b>Address(1)</b></td><td colspan='5'>".$query1['billing_addr_1']."</td></tr><tr><td><b>Address(2)</b></td><td colspan='5'>".$query1['billing_addr_2']."</td>");
    echo("</tr><tr><td><b>City</b></td><td>".$query1['billing_city']."</td><td><b>State</b></td><td>".$query1['billing_state']."</td><td><b>Zipcode</b></td><td>".$query1['billing_zipcode']."</td></tr>");
    echo("</table></td><td width='15'></td><td valign='top'><table border='1'><tr><td  align='center'  colspan='6'><b>Saved Shipping Information</b></td></tr><tr>");
    echo("<td width='110'><b>Address(1)</b></td><td colspan='5'>".$query4['address1']."</td></tr><tr><td><b>Address(2)</b></td><td colspan='5'>".$query4['address2']."</td></tr>");
    echo("<tr><td><b>City</b></td><td>".$query4['city']."</td><td><b>State</b></td><td>".$query4['state']."</td><td><b>Zipcode</b></td><td>".$query4['zipcode']."</td></tr>");
    echo("<tr><td><b>Description</b></td><td colspan='5'>".$query4['description']."</td></tr></table></td></tr></table></div>");

}
else
{
    echo("<div id=member align=center style=margin-top:70px>");
    echo("</br>");
    echo("</div>");
}   
?>        

        <div id="checkout_info">
            <form id="checkout_form" name="checkout_form" method="post" action="save_info.php">
                <table>
                    <tr>
                        <td align="center">
                            <table>
                            <tr><td  align="center" colspan="6"><b>Billing Information</b></td></tr>
                            <tr>
                            <td width="110">Card Number</td><td colspan="5">
                            <input type="text" name="card_number1" size="4" maxlength="4"/>&nbsp;-
                            <input type="text" name="card_number2" size="4" maxlength="4"/>&nbsp;-
                            <input type="text" name="card_number3" size="4" maxlength="4"/>&nbsp;-
                            <input type="text" name="card_number4" size="4" maxlength="4"/></td>
                            </tr>
                            <tr>
                            <td>Holder's Name</td><td colspan="3"><input type="text" name="holder_name" size="27"/></td>
                            <td>Exp. Date</td><td><input type="text" name="exp_date" size="5"/></td>
                            </tr>
                            <tr>
                            <td>Address(1)</td><td colspan="5"><input type="text" name="b_addr1" size="30"/></td>
                            </tr>
                            <tr>
                            <td>Address(2)</td><td colspan="5"><input type="text" name="b_addr2" size="30"/>(*optional)</td>
                            </tr>
                            <tr><td>City</td><td><input type="text" name="b_city" size="10"/></td><td>State</td>
                            <td>                <select name="b_state" maxlength="2">
                                                <option value="AL">AL</option>
                                                <option value="AK">AK</option>
                                                <option value="AZ">AZ</option>
                                                <option value="AR">AR</option>
                                                <option value="CA">CA</option>
                                                <option value="CO">CO</option>
                                                <option value="CT">CT</option>
                                                <option value="DE">DE</option>
                                                <option value="FL">FL</option>
                                                <option value="GA">GA</option>
                                                <option value="HI">HI</option>
                                                <option value="ID">ID</option>
                                                <option value="IL">IL</option>
                                                <option value="IN">IN</option>
                                                <option value="IA">IA</option>
                                                <option value="KS">KS</option>
                                                <option value="KY">KY</option>
                                                <option value="LA">LA</option>
                                                <option value="ME">ME</option>
                                                <option value="MD">MD</option>
                                                <option value="MA">MA</option>
                                                <option value="MI">MI</option>
                                                <option value="MN">MN</option>
                                                <option value="MS">MS</option>
                                                <option value="MO">MO</option>
                                                <option value="MT">MT</option>
                                                <option value="NE">NE</option>
                                                <option value="NV">NV</option>
                                                <option value="NH">NH</option>
                                                <option value="NJ">NJ</option>
                                                <option value="NM">NM</option>
                                                <option value="NY">NY</option>
                                                <option value="NC">NC</option>
                                                <option value="ND">ND</option>
                                                <option value="OH">OH</option>
                                                <option value="OK">OK</option>
                                                <option value="OR">OR</option>
                                                <option value="PA">PA</option>
                                                <option value="RI">RI"</option>
                                                <option value="SC">SC</option>
                                                <option value="SD">SD</option>
                                                <option value="TN">TN</option>
                                                <option value="TX">TX</option>
                                                <option value="UT">UT</option>
                                                <option value="VT">VT</option>
                                                <option value="VA">VA</option>
                                                <option value="WA">WA</option>
                                                <option value="WV">WV</option>
                                                <option value="WI">WI</option>
                                                <option value="WY">WY</option>
                                            </select></td>
                            <td>Zipcode</td><td><input type="text" name="b_zipcode" maxlength="5" size="5" /></td>
                            </tr>
                            </table>
                        </td>
                        <td width="15"></td>
                        <td valign="top">
                            <table>
                                <tr><td  align="center"  colspan="6"><b>Shipping Information</b></td></tr>
                                <tr>
                                <td width="110">Address(1)</td><td colspan="5"><input type="text" name="s_addr1" size="30"/></td>
                                </tr>
                                <tr>
                                <td>Address(2)</td><td colspan="5"><input type="text" name="s_addr2" size="30"/>(*optional)</td>
                                </tr>
                                <tr><td>City</td><td><input type="text" name="s_city" size="10"/></td><td>State</td>
                                <td>                <select name="s_state" maxlength="2">
                                                    <option value="AL">AL</option>
                                                    <option value="AK">AK</option>
                                                    <option value="AZ">AZ</option>
                                                    <option value="AR">AR</option>
                                                    <option value="CA">CA</option>
                                                    <option value="CO">CO</option>
                                                    <option value="CT">CT</option>
                                                    <option value="DE">DE</option>
                                                    <option value="FL">FL</option>
                                                    <option value="GA">GA</option>
                                                    <option value="HI">HI</option>
                                                    <option value="ID">ID</option>
                                                    <option value="IL">IL</option>
                                                    <option value="IN">IN</option>
                                                    <option value="IA">IA</option>
                                                    <option value="KS">KS</option>
                                                    <option value="KY">KY</option>
                                                    <option value="LA">LA</option>
                                                    <option value="ME">ME</option>
                                                    <option value="MD">MD</option>
                                                    <option value="MA">MA</option>
                                                    <option value="MI">MI</option>
                                                    <option value="MN">MN</option>
                                                    <option value="MS">MS</option>
                                                    <option value="MO">MO</option>
                                                    <option value="MT">MT</option>
                                                    <option value="NE">NE</option>
                                                    <option value="NV">NV</option>
                                                    <option value="NH">NH</option>
                                                    <option value="NJ">NJ</option>
                                                    <option value="NM">NM</option>
                                                    <option value="NY">NY</option>
                                                    <option value="NC">NC</option>
                                                    <option value="ND">ND</option>
                                                    <option value="OH">Ohio</option>
                                                    <option value="OK">OK</option>
                                                    <option value="OR">OR</option>
                                                    <option value="PA">PA</option>
                                                    <option value="RI">RI"</option>
                                                    <option value="SC">SC</option>
                                                    <option value="SD">SD</option>
                                                    <option value="TN">TN</option>
                                                    <option value="TX">TX</option>
                                                    <option value="UT">UT</option>
                                                    <option value="VT">VT</option>
                                                    <option value="VA">VA</option>
                                                    <option value="WA">WA</option>
                                                    <option value="WV">WV</option>
                                                    <option value="WI">WI</option>
                                                    <option value="WY">WY</option>
                                                </select></td>
                                <td>Zipcode</td><td><input type="text" name="s_zipcode" maxlength="5" size="5" /></td>
                                </tr>
                                <tr>
                                <td width="110">Description</td><td colspan="5"><input type="text" name="s_descript" size="30"/></td>
                                </tr>
                            </table>
                         </td>
                    </tr>
                    <tr><td height="30"></td></tr>
                    <tr><td align="center" colspan="12">
            <?php 
            if($num1) 
            {
                echo("<input type='button' value='Recall Saved Info' onClick='recall_info()'/>");
            }
		  ?>
                    
                    <input type="button" value="Save Current Info" onClick="save_info()"/>
                    </td></tr>
                    <tr><td align="center" colspan="12">
                    <input type="button" value="Submit" onClick=""/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>