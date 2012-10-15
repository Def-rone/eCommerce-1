<?php  session_start();
$dblink = mysql_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());
mysql_select_db('my_db') or die('Could not select database');

if($_GET['sort']=="ltoh")
{
    $sort='ASC';
}
else
{
    $sort='DESC';
}
$cate = $_GET['cate'];

$query = "SELECT * FROM items as a, (SELECT items_id, min(price) as price FROM inventory GROUP BY items_id) as b 
    WHERE a.item_id = b.items_id &&
    item_name like '%".$_GET['Searchcontent']."%' &&
        category like '%".$_GET['cate']."%'
    ORDER BY price ".$sort.";";
$result = mysql_query($query) or die('Search Failed.  Return to <a href="/test/items.php">Back</a>.  ');

// some code
mysql_close($dblink);
?>

<html>
    <head>
        <title>Shoes Outlet</title>
    </head>

    <body >
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
            <input type="text" name ="Searchcontent" value=<?=$_GET['Searchcontent']?>>

            sort by price:
            <select name='sort'>
                <option value="ltoh"<?php if ($sort=='ASC') echo 'selected="selected"'?>>Low to high </option>
                <option value="htol"<?php if ($sort=='DESC') echo 'selected="selected"'?>>High to low </option>
            </select>
            Category:
            <select name="cate">
                <option value =""<?php if ($cate=='') echo 'selected="selected"'?>>All</option>
                <option value ="Boots"<?php if ($cate=='Boots') echo 'selected="selected"'?>>Boots</option>
                <option value ="Sandals"<?php if ($cate=='Sandals') echo 'selected="selected"'?>>Sandals</option>
                <option value="Flats"<?php if ($cate=='Flats') echo 'selected="selected"'?>>Flats</option>
                <option value="Casual"<?php if ($cate=='Casual') echo 'selected="selected"'?>>Casual</option>
                <option value="Sport"<?php if ($cate=='Sport') echo 'selected="selected"'?>>Sport Casual</option>
                <option value="Comfort"<?php if ($cate=='Comfort') echo 'selected="selected"'?>>Comfort</option>
                <option value="Sneakers"<?php if ($cate=='Sneakers') echo 'selected="selected"'?>>Sneakers</option>
                <option value="Athletic"<?php if ($cate=='Athletic') echo 'selected="selected"'?>>Athletic</option>
                <option value="Work"<?php if ($cate=='Work') echo 'selected="selected"'?>>Work and Safety</option>
                <option value="Slippers"<?php if ($cate=='Slippers') echo 'selected="selected"'?>>Slippers</option>
            </select>
            <input type="submit" value ="Search" >
        </form>

        <table border='1'>
            <tr>
                <th>Item Name</th>
                <th>Category</th>
                <th>brand</th>
                <th>gender</th>
                <th>price</th>
                <th>Compared Price</th>
                <th>description</th>
                <th>date_added</th>
            </tr>


        <?php
        while ($row = mysql_fetch_array($result)) {
            echo "<tr>";
            echo "<td><a href= \"item_detail.php?items_id=".$row['item_id']."\">" . $row['item_name'] . "</a></td>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td>" . $row['brand'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['compared_price'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['date_added'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
        </table>
    </body>
</html>
