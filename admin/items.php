<?php
include "header.php";
include "sidebar.php";
// Database connection
$connection = mysqli_connect('localhost', 'root', '', 'bookstore'); // Adjust with your credentials

// Define the number of items per page
$itemsPerPage = 10;

// Get the current page from the URL, default to page 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;

// Get all items from the database (without pagination)
$getAllItemsQuery = "SELECT * FROM products"; // Remove LIMIT for now
$getAllItemsResult = mysqli_query($connection, $getAllItemsQuery);

// Fetch all items into an array
$getAllitem = mysqli_fetch_all($getAllItemsResult, MYSQLI_ASSOC);

// Reverse the order of items in PHP (to display from bottom to top)
$getAllitem = array_reverse($getAllitem);

// Get the total number of items to calculate the total pages
$totalItems = count($getAllitem); // Use the count of the reversed array
$totalPages = ceil($totalItems / $itemsPerPage);

// Slice the array for the current page
$currentPageItems = array_slice($getAllitem, $offset, $itemsPerPage);
?>
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="index.html" title="Go to Home" class="tip-bottom current">
                <i class="icon-home"></i> Home
            </a>
        </div>
        <h1>Manage Items</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <a href="form_add_item.php">
                                <i class="icon-plus"></i>
                            </a>
                        </span>
                        <h5>Items</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>MRP</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Available</th>
                                        <th>Publisher</th>
                                        <th>Edition</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Language</th>
                                        <th>Page</th>
                                        <th>Weight</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($currentPageItems as $value) : ?>
                                    <tr>
                                        <td>
                                            <img src="../img/books/<?php echo $value['PID'] . ".jpg" ?>" alt="Book Image">
                                        </td>
                                        <td><?php echo htmlspecialchars($value['Title']); ?></td>
                                        <td><?php echo htmlspecialchars($value['Author']); ?></td>
                                        <td><?php echo htmlspecialchars($value['MRP']); ?></td>
                                        <td><?php echo htmlspecialchars($value['Price']); ?></td>
                                        <td><?php echo htmlspecialchars($value['Discount']); ?></td>
                                        <td><?php echo htmlspecialchars($value['Available']); ?></td>
                                        <td><?php echo htmlspecialchars($value['Publisher']); ?></td>
                                        <td><?php echo htmlspecialchars($value['Edition']); ?></td>
                                        <td><?php echo htmlspecialchars($value['Category']); ?></td>
                                        <td><?php echo htmlspecialchars(substr($value['Description'], 0, 100)) . '...'; ?></td>
                                        <td><?php echo htmlspecialchars($value['Language']); ?></td>
                                        <td><?php echo htmlspecialchars($value['page']); ?></td>
                                        <td><?php echo htmlspecialchars($value['weight']); ?></td>
                                        <td>
                                            <a href="form_update_item.php?PID=<?php echo $value['PID']; ?>" class="btn btn-success btn-mini">Edit</a>
                                            <a href="delete.php?PID=<?php echo $value['PID']; ?>" class="btn btn-danger btn-mini" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row" style="margin-left: 18px;">
                            <ul class="pagination">
                                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                    <li class="<?php echo $i == $page ? 'active' : ''; ?>">
                                        <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
<?php include "footer.php" ?>
