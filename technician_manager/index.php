<?php include '../view/header.php'; ?>
<?php
require('../model/database.php');
// require('../model/product_db.php');

$sql = 'SELECT techID, firstName, lastName, email, phone, password from assign3_technicians order by firstName';


if ($db) {
    echo "<p>Notice: Database Connection Successful.</p>";
}
?>

<h3>Technician List</h3>
<table class="table table-bordered">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Password</th>
        <th>&nbsp;</th>
    </tr>
    <?php foreach ($db->query($sql) as $row) { ?>
    <tr>
        <td><?php echo $row['firstName']; ?></td>
        <td><?php echo $row['lastName']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['phone']; ?></td>
        <td><?php echo $row['password']; ?></td>
        <td>
            <a href="<?php echo "index.php?deleteID=" . $row['techID'] ?>">Delete</a>
        </td>
    </tr>
    <?php } ?>

    <?php

    if (isset($_GET['deleteID'])) {
        $deleteCode = $_GET['deleteID'];

    $sql_delete = 'DELETE FROM assign3_technicians WHERE techID = "' . $deleteCode . '"';
    $deleted = $db->exec($sql_delete);
    echo $deleted . ' row deleted.';

    header('Location: ' . $_SERVER['PHP_SELF']);

    }

    ?>

</table>
<a class="btn btn-default home-btn" href="add_technician.php">Add Technician</a>
<?php include '../view/footer.php'; ?>
