<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php session_start();
$dblink = mysql_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());
mysql_select_db('my_db') or die('Could not select database');

//$query="select * from inventory where items_id = ".$_GET[items_id].";";
//$result = mysql_query($query) or die('Search Failed.  Return to <a href="/test/items.php">Back</a>.  ');
// some code
//mysql_close($dblink);
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript">
function add_cart(obj){
	var item = document.getElementsByName("item")[obj].value;
        var inventory_id = document.getElementsByName("inventory_id")[obj].value;
	var quantity = document.getElementsByName("quantity")[obj].value;
        var price = document.getElementsByName("price")[obj].value;
	//url = "update_cart.php?item=" + item + "&quantity=" + quantity + "&url=<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>";
        url = "add_cart.php?item=" +item+ "&quantity=" + quantity + "&price=" + price + "&inventory_id="+ inventory_id +"&url=<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>";

location.href=url;
}
</script>
        <title></title>
    </head>
    <body>
        <a href="items.php"><img src="logo.jpg" ></a>
        <?php
            if(!isset($_SESSION['username'])||$_SESSION['username']==null)
            {
               echo ("<a href='login.php'>LOGIN</a>");
            }
            else
            {
                echo ("<a href='logout.php'>LOGOUT</a>");
            }
        ?>
        <form action="items.php" method="get">
            Search:
            <input type="text" name ="Searchcontent" value=<?= $_GET["Searchcontent"] ?> >

            sort by price:
            <select name="sort">
                <option value="ltoh"<?php if ($sort == ASC) echo 'selected="selected"' ?>>Low to high </option>
                <option value="htol"<?php if ($sort == DESC) echo 'selected="selected"' ?>>High to low </option>
            </select>
            Category:
            <select name="cate">
                <option value =""<?php if ($cate == '') echo 'selected="selected"' ?>>All</option>
                <option value ="Boots"<?php if ($cate == Boots) echo 'selected="selected"' ?>>Boots</option>
                <option value ="Sandals"<?php if ($cate == Sandals) echo 'selected="selected"' ?>>Sandals</option>
                <option value="Flats"<?php if ($cate == Flats) echo 'selected="selected"' ?>>Flats</option>
                <option value="Casual"<?php if ($cate == Casual) echo 'selected="selected"' ?>>Casual</option>
                <option value="Sport"<?php if ($cate == Sport) echo 'selected="selected"' ?>>Sport Casual</option>
                <option value="Comfort"<?php if ($cate == Comfort) echo 'selected="selected"' ?>>Comfort</option>
                <option value="Sneakers"<?php if ($cate == Sneakers) echo 'selected="selected"' ?>>Sneakers</option>
                <option value="Athletic"<?php if ($cate == Athletic) echo 'selected="selected"' ?>>Athletic</option>
                <option value="Work"<?php if ($cate == Work) echo 'selected="selected"' ?>>Work and Safety</option>
                <option value="Slippers"<?php if ($cate == Slippers) echo 'selected="selected"' ?>>Slippers</option>
            </select>
            <input type="submit" value ="Search" >
        </form>
                <a href="shopping_cart.php">Shopping Cart</a>
        <img src="product.jpg" with ="100" hight="100">
        <?php
        
        $query1 = "select * from items where item_id = " . $_GET[items_id] . ";";
        $result1 = mysql_query($query1) or die('Search Failed.  Return to <a href="/test/items.php">Back</a>.  ');
        $row = mysql_fetch_array($result1);

        echo "<h1>" . $row['item_name'] . "</h1>";
        echo "<h3>Category:</h3>";
        echo "<p>" . $row['category'] . "</p>";
        echo "<h3>Description:</h3>";
        echo "<p>" . $row['description'] . "</p>";
        ?>

        <table border='1'>
            <tr>
                <th>Color</th>
                <th>Size</th>
                <th>Width</th>
                <th>Price</th>
                <th>Compared price</th>
                <th>In stock</th>
                <th>Quantity</th>
                <th>Add to chart</th>
            </tr>

            <?php
            $index = 0;
            $query2 = "select * from inventory where items_id = " . $_GET[items_id] . ";";
            $result2 = mysql_query($query2) or die('Search Failed.  Return to <a href="/test/items.php">Back</a>.  ');
            while ($row = mysql_fetch_array($result2)) {
                echo "<tr>";
                echo "<td>" . $row['color'] . "</td>";
                echo "<td>" . $row['size'] . "</td>";
                echo "<td>" . $row['width'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['compared_price'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>
                    <select name = 'quantity'>";
                for($i=1;$i<=$row['quantity'];$i++){
                    echo "<option value = \"".$i."\">".$i."</option>";
                }
                echo "</select>";
                echo "<td><input type='button' name='update' value='Add' onclick='javascript:add_cart(".$index.");'/>
                    <input type='hidden' name='item' value='".$row['items_id']."'/>
                    <input type='hidden' name='price' value='".$row['price']."'/>
                    <input type='hidden' name='inventory_id' value='".$row['inventory_id']."'/></td>";
                //echo "<td><input type='hidden' name='price' value='".$row['price']."'/></td>";
                echo "</tr>";
                $index++;
            }
//            put your code here
            ?>
    </body>
</html>
<?php
mysql_close($dblink);
?>
