<?php
include "config.php";
include "Models/dp.php";
include "Models/item.php";

$item = new Item;

// Retrieve form data
$pid = $_POST['PID'];
$title = $_POST['Title'];
$author = $_POST['Author'];
$mrp = $_POST['MRP'];
$price = $_POST['Price'];
$discount = isset($_POST['Discount']) ? $_POST['Discount'] : null;
$available = $_POST['Available'];
$publisher = $_POST['Publisher'];
$edition = $_POST['Edition'];
$category = $_POST['Category'];
$description = $_POST['Description'];
$language = $_POST['Language'];
$page = isset($_POST['Page']) ? $_POST['Page'] : null;
$weight = isset($_POST['Weight']) ? $_POST['Weight'] : null;

// Update item in the database
$item->updateitem($pid, $title, $author, $mrp, $price, $discount, $available, $publisher, $edition, $category, $description, $language, $page, $weight);
if ($item) {
    echo "Item updated successfully!";
} else {
    echo "Failed to update the item.";
}
if(isset($_FILES["fileUpload"])){
    $target_dir = "../admin/img/books/";

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
}
// Redirect back to items page
header('location:items.php');
?>