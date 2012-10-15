<?php session_start();?>



<html>
    <body>
            <?php
            if(!isset($_SESSION['username'])||$_SESSION['username']==null)
            {
               echo("<script> window.alert('Illegal Access.');</script>");
               echo("<script> location.href='items.php'; </script>");
            }
            else
            {
                echo ("<a href='logout.php'>LOGOUT</a>");
            }
            ?>
<form method="post" action="add.php">

<table align="center">
    <caption><h2>Add a New Item</h2></caption>
    <tr height="50">
        <td>Item Name</td>
        <td><input type="text" name="item_name" id="item_name" size="30" ></td>
    </tr>
    <tr height="50">
        <td>Description</td>
        <td><textarea name="description" id="description" rows="5" cols="30"></textarea></td>
    </tr>
    <tr height="50">
        <td>Category</td>
        <td>
            <select name="category">
                <option value ="Boots">Boots</option>
                <option value ="Sandals">Sandals</option>
                <option value="Flats">Flats</option>
                <option value="Casual">Casual</option>
                <option value="Sport Casual">Sport Casual</option>
                <option value="Comfort">Comfort</option>
                <option value="Sneakers">Sneakers</option>
                <option value="Athletic">Athletic</option>
                <option value="Work and Safety">Work and Safety</option>
                <option value="Slippers">Slippers</option>
            </select>
        </td>
    </tr>
    <tr height="50">
        <td>Brand</td>
        <td><input type="text" name="brand" id="brand" size="30" ></td>
    </tr>
    <tr height="50">
        <td>Gender</td>
        <td><input type="radio" name="gender" value="Male"> Male<br>
            <input type="radio" name="gender" value="Female" checked> Female<br>
        </td>
    </tr>
    <tr height="50">
        <td>Compared Price</td>
        <td><input type="text" name="compared_price" id="compared_price" size="30" ></td>
    </tr>
    <tr align="center" height="50">
        <td colspan ="2"><button type="submit"><h3>Add</h3></button></td>
    </tr>

</table>

</form>
    </body>
</html>

