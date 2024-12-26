<?php
session_start();
if(!isset($_SESSION['user']))
       header("location: index.php?Message=Login To Continue");
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Books">
    <meta name="author" content="Shivangi Gupta">
    <title>Online Bookstore</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">

    <style>
   
    #books {margin-bottom:50px;}

     @media only screen and (width: 767px) { body{margin-top:150px;}}
        #books .row{margin-top:20px;margin-bottom:10px;font-weight:800;}
        @media only screen and (max-width: 760px) { #books .row{margin-top:10px;}}
    </style>

</head>
<body>

    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img alt="Brand" src="img/logo.jpg" style="width: 118px;margin-top: -7px;margin-left: -10px;"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
              <?php
                  if(isset($_SESSION['user']))
                    {
                      echo'
                    <li><a href="cart.php" class="btn btn-md"><span class="glyphicon glyphicon-shopping-cart">Cart</span></a></li>
                    <li><a href="destroy.php" class="btn btn-md"> <span class="glyphicon glyphicon-log-out">LogOut</span></a></li>
                         ';
                    }
               ?>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <div id="top" >
        <div id="searchbox" class="container-fluid" style="width:112%;margin-left:-6%;margin-right:-6%;">
            <div>
                <form role="search" action="Result.php" method="post">
                    <input type="text" name="keyword" class="form-control" placeholder="Search for a Book , Author Or Category" style="width:80%;margin:20px 10% 20px 10%;">
                </form>
            </div>
        </div>

    <?php
include "models/dbconnect.php";

// Set up pagination variables
$products_per_page = 4; // số sản phẩm mỗi trang
if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1; // Mặc định là trang 1
}

$start_from = ($page - 1) * $products_per_page; // Tính offset

if(isset($_GET['value'])) {  
    $_SESSION['category'] = $_GET['value'];
}
$category = $_SESSION['category'];

// Query sản phẩm với phân trang
if(isset($_POST['sort'])) {
    $sort_by = $_POST['sort'];
    switch($sort_by) {
        case "price":
            $query = "SELECT * FROM products WHERE Category='$category' ORDER BY Price LIMIT $start_from, $products_per_page";
            break;
        case "priceh":
            $query = "SELECT * FROM products WHERE Category='$category' ORDER BY Price DESC LIMIT $start_from, $products_per_page";
            break;
        case "discount":
            $query = "SELECT * FROM products WHERE Category='$category' ORDER BY Discount DESC LIMIT $start_from, $products_per_page";
            break;
        case "discountl":
            $query = "SELECT * FROM products WHERE Category='$category' ORDER BY Discount LIMIT $start_from, $products_per_page";
            break;
        default:
            $query = "SELECT * FROM products WHERE Category='$category' LIMIT $start_from, $products_per_page";
    }
} else {
    $query = "SELECT * FROM products WHERE Category='$category' LIMIT $start_from, $products_per_page";
}

$result = mysqli_query($con, $query) or die(mysqli_error($con));

// Display products
echo '<div class="container-fluid" id="books">
        <div class="row">
            <div class="col-xs-12 text-center" id="heading">
                <h2 style="color:rgb(228, 55, 25);text-transform:uppercase;margin-bottom:0px;"> '. $category .' STORE </h2>
            </div>
        </div>
        <div class="container fluid">
            <div class="row">
                <div class="col-sm-5 col-sm-offset-6 col-md-5 col-md-offset-7 col-lg-4 col-lg-offset-8">
                    <form action="';echo $_SERVER['PHP_SELF'];echo'" method="post" class="pull-right">
                        <label for="sort">Sort by &nbsp: &nbsp</label>
                        <select name="sort" id="select" onchange="form.submit()">
                            <option value="default" selected="selected">Select</option>
                            <option value="price">Low To High Price </option>
                            <option value="priceh">Highest To Lowest Price </option>
                            <option value="discountl">Low To High Discount </option>
                            <option value="discount">Highest To Lowest Discount</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>';

if(mysqli_num_rows($result) > 0) {
    $i = 0;
    while($row = mysqli_fetch_assoc($result)) {
        $path = "img/books/" . $row['PID'] . ".jpg";
        $description = "description.php?ID=" . $row["PID"];
        if($i % 4 == 0) echo '<div class="row">';
        echo '
            <a href="' . $description . '">
                <div class="col-sm-6 col-md-3 col-lg-3 text-center">
                    <div class="book-block" style="border: 3px solid #DEEAEE;">
                        <img class="book block-center img-responsive" src="' . $path . '">
                        <hr>
                        ' . $row["Title"] . '<br>
                        ' . $row["Price"] . ' &nbsp;
                        <span style="text-decoration:line-through;color:#828282;"> ' . $row["MRP"] . ' </span>
                        <span class="label label-warning">' . $row["Discount"] . '%</span>
                    </div>
                </div>
            </a>';
        $i++;
        if($i % 4 == 0) echo '</div>';
    }
}

echo '</div>';

// Pagination
// Query to get total number of products
$query_total = "SELECT COUNT(*) AS total FROM products WHERE Category='$category'";
$result_total = mysqli_query($con, $query_total);
$row_total = mysqli_fetch_assoc($result_total);
$total_products = $row_total['total'];
$total_pages = ceil($total_products / $products_per_page);

echo '<div class="text-center">';
for($i = 1; $i <= $total_pages; $i++) {
    echo '<a href="product.php?page=' . $i . '" class="btn btn-default">' . $i . '</a> ';
}
echo '</div>';

?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>	

