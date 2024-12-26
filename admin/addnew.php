<?php
include "config.php";
include "Models/dp.php";
include "Models/item.php";
$item = new Item;
$PID = $_POST['PID'];
$Title = $_POST['Title'];
$Author = $_POST['Author'];
$MRP = $_POST['MRP'];
$Price = $_POST['Price'];
$Discount = $_POST['Discount'];
$Available = $_POST['Available'];
$Publisher = $_POST['Publisher'];
$Edition = $_POST['Edition'];
$Category = $_POST['cate'];
$Description = $_POST['Description'];
$Language = $_POST['Language'];
$Page = $_POST['Page'];
$Weight = $_POST['Weight'];

$item->addItem($PID, $Title, $Author, $MRP, $Price, $Discount, $Available, $Publisher, $Edition, $Category, $Description, $Language, $Page, $Weight);

$target_dir = "../img/books/";

// Get the file extension of the uploaded file
$file_extension = pathinfo($_FILES["fileUpload"]["name"], PATHINFO_EXTENSION);

// Set the target file name using only the PID
$target_file = $target_dir . $PID . ".". $file_extension;

// Move the uploaded file to the target directory with the desired file name
if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
    echo "The file has been uploaded successfully.";
} else {
    echo "Sorry, there was an error uploading your file.";
}
header('Location: items.php');

