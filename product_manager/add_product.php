<?php include '../view/header.php'; ?>
<?php
require('../model/database.php');
// require('../model/product_db.php');



if ($db) {
    echo "<p>Notice: Database Connection Successful.</p>";
}


?>



<?php
$codeErr = $nameErr = $versionErr = $dateErr = "";
$code = $name = $verison = $date = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["productCode"])) {
        $codeErr = "Code is required";
    } else {
        $code = $_POST["productCode"];
    };
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = $_POST["name"];
    };
    if (empty($_POST["version"])) {
        $versionErr = "Version is required";
    } else {
        $verison = $_POST["version"];
    };
    if (empty($_POST["releaseDate"])) {
        $dateErr = "Release date is required";
    } else {
        $date = $_POST["releaseDate"];
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
            $dateErr = "Invalid date format!";
        }
    };
    if (!empty($code) && !empty($name) && !empty($verison) && !empty($date) && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
        $sql_insert = 'INSERT INTO assign3_products VALUES ("' . $code . '","' . $name . '","' . $verison . '","' . $date . '");';
        $inserted = $db->exec($sql_insert);
        echo '<h3 style="color:red">' . $inserted . ' row inserted.</h3>';
    }
}
?>

<h3>Add Product</h3>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <div class="form-group">
        <label for="productCode">Code:</label>
        <input style="max-width: 300px;" class="form-control" name="productCode" placeholder="Product Code">
        <span class="error">* <?php echo $codeErr   ;?></span>
    </div>
    <div class="form-group">
        <label for="name">Name:</label>
        <input style="max-width: 300px;" class="form-control" name="name" placeholder="Name">
        <span class="error">* <?php echo $nameErr;?></span>
    </div>
    <div class="form-group">
        <label for="version">Version:</label>
        <input style="max-width: 300px;" class="form-control" name="version" placeholder="Version">
        <span class="error">* <?php echo $versionErr;?></span>
    </div>
    <div class="form-group">
        <label for="releaseDate">Release Date:</label>
        <input style="max-width: 300px;" class="form-control" name="releaseDate" placeholder="Release Date">
        <span>Use 'yyyy-mm-dd' format</span>
        <span class="error">* <?php echo $dateErr;?></span>
    </div>
    <button style="margin-bottom: 10px;" type="submit" class="btn btn-default">Add Product</button>
</form>

<a href="index.php">View Product List</a>
<?php include '../view/footer.php'; ?>
