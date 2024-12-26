<?php
class Item extends Db
{
    public function getAllItems()
    {
        $sql = self::$connection->prepare("SELECT * FROM `products` 
        ORDER BY `MRP` DESC");

        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function getAllCategories()
    {
        $sql = self::$connection->prepare("SELECT DISTINCT `category` FROM `products` WHERE `category` IS NOT NULL");
        $sql->execute();
        $categories = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $categories;
    }
    public function getCatNameById($category)
    {
        $sql = self::$connection->prepare("SELECT categories.name FROM items,categories 
        WHERE items.category = categories.id
        AND category = ?");
        $sql->bind_param("i", $category);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }

    public function search($keyword, $page, $count)
    {
        $start = ($page - 1) * $count;
        $sql = self::$connection->prepare("SELECT * FROM `products` 
        WHERE `Title` LIKE ?
        LIMIT ?,?");
        $keyword = "%$keyword%";
        $sql->bind_param("sii", $keyword, $start, $count);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function searchCount($keyword)
    {
        $sql = self::$connection->prepare("SELECT * FROM `products` 
        WHERE `Title` LIKE ?");
        $keyword = "%$keyword%";
        $sql->bind_param("s", $keyword);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    function paginate($url, $total, $count, $page)
{
    $totalLinks = ceil($total / $count);
    $pagination = "<ul class='pagination'>";

    // Previous Link
    if ($page > 1) {
        $pagination .= "<li><a href='$url&page=" . ($page - 1) . "'>Previous</a></li>";
    } else {
        $pagination .= "<li class='disabled'><span>Previous</span></li>";
    }

    // Page Links
    for ($j = 1; $j <= $totalLinks; $j++) {
        if ($page == $j) {
            $pagination .= "<li class='active'><a href='$url&page=$j'>$j</a></li>";
        } else {
            $pagination .= "<li><a href='$url&page=$j'>$j</a></li>";
        }
    }

    // Next Link
    if ($page < $totalLinks) {
        $pagination .= "<li><a href='$url&page=" . ($page + 1) . "'>Next</a></li>";
    } else {
        $pagination .= "<li class='disabled'><span>Next</span></li>";
    }

    $pagination .= "</ul>";
    return $pagination;
}
    public function delete($PID)
    {
        $sql = self::$connection->prepare("DELETE FROM `products` WHERE `PID` = ?");
        $sql->bind_param("s", $PID);
        return $sql->execute();
    }

    public function addItem($PID, $Title, $Author, $MRP, $Price, $Discount, $Available, $Publisher, $Edition, $Category, $Description, $Language, $Page, $Weight)
    {
        $sql = self::$connection->prepare(
            "INSERT INTO `products` 
        (`PID`, `Title`, `Author`, `MRP`, `Price`, `Discount`, `Available`, `Publisher`, `Edition`, `Category`, `Description`, `Language`, `Page`, `Weight`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        if (!$sql) {
            die("SQL preparation failed: " . self::$connection->error);
        }

        $sql->bind_param(
            "sssdidisssssis",
            $PID,
            $Title,
            $Author,
            $MRP,
            $Price,
            $Discount,
            $Available,
            $Publisher,
            $Edition,
            $Category,
            $Description,
            $Language,
            $Page,
            $Weight
        );

        return $sql->execute();
    }
    public function getItemById($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE PID = ?");
        $sql->bind_param("s", $id);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function updateitem($pid, $title, $author, $mrp, $price, $discount, $available, $publisher, $edition, $category, $description, $language, $page, $weight)
    {
        // Prepare the SQL query
        $sql = self::$connection->prepare(" UPDATE `products` 
            SET 
                `Title` = ?, 
                `Author` = ?, 
                `MRP` = ?, 
                `Price` = ?, 
                `Discount` = ?, 
                `Available` = ?, 
                `Publisher` = ?, 
                `Edition` = ?, 
                `Category` = ?, 
                `Description` = ?, 
                `Language` = ?, 
                `page` = ?, 
                `weight` = ?
            WHERE `PID` = ?
        ");
    
        // Bind parameters to the query
        $sql->bind_param(
            "sssdidisssssis", 
            $title, 
            $author, 
            $mrp, 
            $price, 
            $discount, 
            $available, 
            $publisher, 
            $edition, 
            $category, 
            $description, 
            $language, 
            $page, 
            $weight, 
            $pid // `PID` as the last parameter
        );
    
        // Execute the query
        return $sql->execute();
    }
}