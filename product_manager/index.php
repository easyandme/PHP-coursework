<?php include '../view/header.php'; ?>
<?php
require('../model/database.php');
// require('../model/product_db.php');

$sql = 'SELECT productCode, name, version, releaseDate from assign3_products order by productCode';


if ($db) {
    echo "<p>Notice: Database Connection Successful.</p>";
}

?>

<h3>Product List</h3>
<table class="table table-bordered">
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Version</th>
        <th>Release Date</th>
        <th>&nbsp;</th>
    </tr>
    <?php foreach ($db->query($sql) as $row) { ?>
    <tr>
        <td><?php echo $row['productCode']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['version']; ?></td>
        <td><?php echo $row['releaseDate']; ?></td>
        <td>
            <a href="<?php echo "index.php?deleteCode=" . $row['productCode'] ?>">Delete</a>
        </td>
    </tr>
    <?php } ?>

    <?php

    if (isset($_GET['deleteCode'])) {
        $deleteCode = $_GET['deleteCode'];

    $sql_delete = 'DELETE FROM assign3_products WHERE productCode = "' . $deleteCode . '"';
    $deleted = $db->exec($sql_delete);
    echo $deleted . ' row deleted.';

    header('Location: ' . $_SERVER['PHP_SELF']);

    }

    ?>

</table>
<a class="btn btn-default home-btn" href="add_product.php">Add Product</a>
<?php include '../view/footer.php'; ?>
