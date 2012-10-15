<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include(dirname(__DIR__)."/model/admin.php");
$admin = new Admin();
$item_id = $_GET['id'];
$arr = $admin ->browseOne($item_id);

?>

<html>

<form method="post" action="update.php">

<table align="center">
    <caption><h2>Change an Existing Item Information</h2></caption>
    <tr height="50">
        <td>Item ID</td>
        <td><input type="text" name="item_id" id="item_id" size="30" value="<?=$item_id ?>" readonly></td>
    </tr>
    <tr height="50">
        <td>Item Name</td>
        <td><input type="text" name="item_name" id="item_name" size="30" value="<?=$arr['item_name'] ?>"></td>
    </tr>
    <tr height="50">
        <td>Description</td>
        <td><textarea name="description" id="description" rows="5" cols="30"><?=$arr['description'] ?></textarea></td>
    </tr>
    <tr height="50">
        <td>Date Added</td>
        <td><input type="text" name="date_added" id="date_added" size="30" value="<?=$arr['date_added'] ?>"></td>
    </tr>
    <tr height="50">
        <td>Category</td>
        <td>
            <select name="category">
                <option value ="Boots" <?php if($arr['category']=='Boots'){ ?> selected="selected" <? } ?>>Boots</option>
                <option value ="Sandals" <?php if($arr['category']=='Sandals'){ ?> selected="selected" <? } ?>>Sandals</option>
                <option value="Flats" <?php if($arr['category']=='Flats'){ ?> selected="selected" <? } ?>>Flats</option>
                <option value="Casual" <?php if($arr['category']=='Casual'){ ?> selected="selected" <? } ?>>Casual</option>
                <option value="Sport Casual" <?php if($arr['category']=='Sport Casual'){ ?> selected="selected" <? } ?>>Sport Casual</option>
                <option value="Comfort" <?php if($arr['category']=='Comfort'){ ?> selected="selected" <? } ?>>Comfort</option>
                <option value="Sneakers" <?php if($arr['category']=='Sneakers'){ ?> selected="selected" <? } ?>>Sneakers</option>
                <option value="Athletic" <?php if($arr['category']=='Athletic'){ ?> selected="selected" <? } ?>>Athletic</option>
                <option value="Work and Safety" <?php if($arr['category']=='Work and Safety'){ ?> selected="selected" <? } ?>>Work and Safety</option>
                <option value="Slippers" <?php if($arr['category']=='Slippers'){ ?> selected="selected" <? } ?>>Slippers</option>
            </select>
        </td>
    </tr>
    <tr height="50">
        <td>Brand</td>
        <td><input type="text" name="brand" id="brand" size="30" value="<?=$arr['brand'] ?>"></td>
    </tr>
    <tr height="50">
        <td>Gender</td>
        <td><input type="radio" name="gender" value="Male" <?php if($arr['gender']=='MALE'){ ?> checked <? } ?>> Male<br>
            <input type="radio" name="gender" value="Female" <?php if($arr['gender']=='FEMALE'){ ?> checked <? } ?>> Female<br>
        </td>
    </tr>
    <tr height="50">
        <td>Compared Price</td>
        <td><input type="text" name="compared_price" id="compared_price" size="30" value="<?=$arr['compared_price'] ?>"></td>
    </tr>
    <tr align="center" height="50">
        <td colspan ="2"><button type="submit"><h3>Update</h3></button></td>
    </tr>

</table>

</form>
</html>