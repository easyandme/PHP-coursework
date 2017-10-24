<?php include '../view/header.php'; ?>
<?php
require('../model/database.php');
// require('../model/product_db.php');
if ($db) {
    echo "<p>Notice: Database Connection Successful.</p>";
}

$email = "";
if (isset($_POST['email'])) {
    $email = $_POST['email'];
}

$sql = "SELECT customerID, firstName, lastName, email FROM assign3_customers WHERE email = '" . $email . "'";
$sql_products = "SELECT productCode, name FROM assign3_products";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["productCode"])) {
    $productCode = $_POST["productCode"];
    $customer = $_POST["customer"];
    $sql_insert = "INSERT INTO assign3_registrations VALUES ('" . $customer . "', '" . $productCode . "', '" . date('Y-m-d') . "')";
    $inserted = $db->exec($sql_insert);
    echo '<h4 style="color:red"> Product (' . $productCode . ') was registered successfully.</h4>';
    }
}
?>

<h3>Register Product</h3>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <?php foreach ((object) $db->query($sql) as $row) { ?>
        <div class="form-group">
            <label for="customer">Customer:</label>
            <input type="text" style="display:none;" name="customer" value="<?= $row['customerID'] ?>"><span style="color:green"><b><?php echo $row['firstName'] . ' ' . $row['lastName']; ?></b></span></input>
        </div>
        <div class="form-group">
            <label for="product">Product:</label>
            <select style="max-width: 300px;" class="form-control" name="productCode">
            <?php foreach ((object) $db->query($sql_products) as $products) { ?>
                <option value="<?php echo $products['productCode']; ?>"><?php echo $products['name']; ?></option>
            <?php } ?>
            </select>
        </div>
        <button style="margin-bottom: 20px;" type="submit" class="btn btn-default">Register Product</button>
    <?php } ?>
</form>

<?php include '../view/footer.php'; ?>
