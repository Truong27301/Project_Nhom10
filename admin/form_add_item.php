<?php
include "header.php";
include "sidebar.php";

?>
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i>
                Home</a></div>
        <h1>Add New Items</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Item info</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <!-- BEGIN FORM -->
                        <form action="addnew.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label">Product ID (PID)</label>
                                <div class="controls">
                                    <input type="text" name="PID" id="PID" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Title </label>
                                <div class="controls">
                                    <input type="text" class="span11" name="Title" /> *
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Author</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="Author" /> *
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">MRP</label>
                                <div class="controls">
                                    <input class="span11" name="MRP"></input>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Price</label>
                                <div class="controls">
                                    <input class="span11" name="Price"></input>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Choose
                                    an image</label>
                                <div class="controls">
                                    <input type="file" name="fileUpload" id="fileUpload">

                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">Description</label>
                                <div class="controls">
                                    <textarea class="span11" name="Description"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Discount
                                </label>
                                <div class="controls">
                                    <input class="span11" name="Discount"></input>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Available
                                </label>
                                <div class="controls">
                                    <input type="number" class="span11" name="Available" /> *
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Publisher</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="Publisher" /> *
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Edition</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="Edition" /> *
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Choose a category</label>
                                <div class="controls">
                                    <select name="cate" id="cate">
                                        <?php
                                        $getAllCates = $item->getAllCategories();
                                        foreach ($getAllCates as $value) : ?>
                                            <option value="<?php echo htmlspecialchars($value['category']); ?>">
                                                <?php echo htmlspecialchars($value['category']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select> *
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Language</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="Language" /> *
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Page</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="Page" /> *
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Weight</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="Weight" /> *
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END FORM -->
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
<?php include "footer.php" ?>