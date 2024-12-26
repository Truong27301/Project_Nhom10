<?php
include "header.php";
include "sidebar.php";

if (isset($_GET['PID'])):
    $id = $_GET['PID'];
    $getItemById = $item->getItemById($id);

    if (!$getItemById) {
        echo "<p>Item not found!</p>";
        exit;
    }

    $itemData = $getItemById[0]; // Assuming getItemById returns an array
?>

    <!-- BEGIN CONTENT -->
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> 
                <a href="#" title="Go to Home" class="tip-bottom current">
                    <i class="icon-home"></i> Home
                </a>
            </div>
            <h1>Update Items</h1>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> 
                            <span class="icon"><i class="icon-align-justify"></i></span>
                            <h5>Item Info</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <!-- BEGIN FORM -->
                            <form action="update.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="control-group">
                                    <label class="control-label">Product ID (PID)</label>
                                    <div class="controls">
                                        <input type="text" name="PID" id="PID" value="<?php echo htmlspecialchars($itemData['PID']); ?>" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Title</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="Title" value="<?php echo htmlspecialchars($itemData['Title']); ?>" required />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Author</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="Author" value="<?php echo htmlspecialchars($itemData['Author']); ?>" required />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">MRP</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="MRP" value="<?php echo htmlspecialchars($itemData['MRP']); ?>" required />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Price</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="Price" value="<?php echo htmlspecialchars($itemData['Price']); ?>" required />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Choose an image</label>
                                    <div class="controls">
                                        <input type="file" name="fileUpload" id="fileUpload">
                                        <?php if (!empty($itemData['image'])): ?>
                                            <p>Current Image: <img src="../admin/img/books/<?php echo htmlspecialchars($itemData['image']); ?>" alt="Image" width="100"></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea class="span11" name="Description"><?php echo htmlspecialchars($itemData['Description']); ?></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Discount</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="Discount" value="<?php echo htmlspecialchars($itemData['Discount']); ?>" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Available</label>
                                    <div class="controls">
                                        <input type="number" class="span11" name="Available" value="<?php echo htmlspecialchars($itemData['Available']); ?>" required />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Publisher</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="Publisher" value="<?php echo htmlspecialchars($itemData['Publisher']); ?>" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Edition</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="Edition" value="<?php echo htmlspecialchars($itemData['Edition']); ?>" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Choose a category</label>
                                    <div class="controls">
                                        <select name="Category" id="Category">
                                            <?php
                                            $getAllCates = $item->getAllCategories();
                                            foreach ($getAllCates as $value) : ?>
                                                <option value="<?php echo htmlspecialchars($value['category']); ?>" 
                                                    <?php echo ($value['category'] == $itemData['Category']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($value['category']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Language</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="Language" value="<?php echo htmlspecialchars($itemData['Language']); ?>" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Page</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="Page" value="<?php echo htmlspecialchars($itemData['page']); ?>" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Weight</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="Weight" value="<?php echo htmlspecialchars($itemData['weight']); ?>" />
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                            <!-- END FORM -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif;
include "footer.php";
?>
