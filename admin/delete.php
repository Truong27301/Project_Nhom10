<?php
include "config.php";
include "Models/dp.php";
include "Models/item.php";
include "Models/user.php";
$item = new Item;
$users = new Users;
// Delete item by PID
if (isset($_GET['PID'])) {
    $PID = $_GET['PID'];
    $item->delete($PID);
    header('location:items.php');
}
if (isset($_GET['UserName'])) {
    $UserName = $_GET['UserName'];
    $users->delete($UserName);
    header('location:users.php');
}
?>