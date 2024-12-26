<?php
include "header.php";
include "sidebar.php";

// Kiểm tra từ khóa tìm kiếm
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
} else {
    $keyword = '';
}

// Lấy trang hiện tại, mặc định là 1
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$count = 5; // Số sản phẩm mỗi trang

// Tính tổng số sản phẩm tìm được
$totalItems = count($item->searchCount($keyword));

// Tính URL cho phân trang
$url = $_SERVER['PHP_SELF'] . "?keyword=" . urlencode($keyword);

// Gọi hàm tìm kiếm
$searchResults = $item->search($keyword, $page, $count);

?>
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <span class="current">Search Results</span>
        </div>
        <h6>Result: found <?php echo $totalItems; ?> item(s) with keyword "<?php echo htmlspecialchars($keyword); ?>"</h6>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><a href="form.html"><i class="icon-plus"></i></a></span>
                        <h5>Products</h5>
                    </div>
                    <div class="widget-content nopadding">
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
                                <?php if (!empty($searchResults)) : ?>
                                    <?php foreach ($searchResults as $product) : ?>
                                        <tr>
                                            <td width="150">
                                            <img src="../img/books/<?php echo htmlspecialchars($product['PID']) . '.jpg'; ?>" alt="Book Image" style="width: 100px; height: auto;">
                                            </td>
                                            <td><?php echo htmlspecialchars($product['Title']); ?></td>
                                            <td><?php echo htmlspecialchars($product['Author']); ?></td>
                                            <td><?php echo number_format($product['MRP'], 2); ?></td>
                                            <td><?php echo number_format($product['Price'], 2); ?></td>
                                            <td><?php echo htmlspecialchars($product['Discount']); ?>%</td>
                                            <td><?php echo htmlspecialchars($product['Available']); ?></td>
                                            <td><?php echo htmlspecialchars($product['Publisher']); ?></td>
                                            <td><?php echo htmlspecialchars($product['Edition']); ?></td>
                                            <td><?php echo htmlspecialchars($product['Category']); ?></td>
                                            <td><?php echo htmlspecialchars($product['Description']); ?></td>
                                            <td><?php echo htmlspecialchars($product['Language']); ?></td>
                                            <td><?php echo htmlspecialchars($product['page']); ?></td>
                                            <td><?php echo htmlspecialchars($product['weight']); ?></td>
                                            <td>
                                                <a href="edit.php?id=<?php echo $product['PID']; ?>" class="btn btn-success btn-mini">Edit</a>
                                                <a href="delete.php?id=<?php echo $product['PID']; ?>" class="btn btn-danger btn-mini" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="9" style="text-align: center;">No results found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="row" style="margin-left: 18px;">
                            <ul class="pagination">
                                <?php echo $item->paginate($url, $totalItems, $count, $page); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
<?php include "footer.php"; ?>
