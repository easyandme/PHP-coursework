<?php include '../view/header.php'; ?>
<?php
require('../model/database.php');
// require('../model/product_db.php');

$sql ="";

if ($db) {
    echo "<p>Notice: Database Connection Successful.</p>";
}
?>

<h3>Customer Search</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Last Name: <input type="text" name="lastName" />
    <input class="btn btn-default" type="submit" value="Search" />
</form>
<br/>

<?php

if (isset($_POST['lastName'])) {
    $lastName = $_POST['lastName'];
    $sql = 'SELECT customerID, firstName, lastName, city, email from assign3_customers where lastName like "%' . $lastName . '%" order by firstName';
}

?>

<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <th>Email Address</th>
        <th>City</th>
        <th>&nbsp;</th>
    </tr>
    <?php if (isset($lastName)) { foreach ((object) $db->query($sql) as $row) { ?>
    <tr>
        <td><?php echo $row['firstName']; ?></td>
        <td><?php echo $row['lastName']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td>
            <a href="<?php echo "update_customer.php?selectID=" . $row['customerID'] ?>">Select</a>
        </td>
    </tr>
    <?php } } ?>
</table>
<?php include '../view/footer.php'; ?>
