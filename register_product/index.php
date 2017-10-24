<?php include '../view/header.php'; ?>
<?php
require('../model/database.php');
// require('../model/product_db.php');

$sql ="";

if ($db) {
    echo "<p>Notice: Database Connection Successful.</p>";
}
?>

<h3>Customer Login</h3>
<p>You must login before you can register products.</p>
<form action="resigter_product.php" method="post">
    Email: <input type="text" name="email" />
    <input class="btn btn-default" type="submit" value="Login" />
</form>
<br/>


<?php include '../view/footer.php'; ?>
