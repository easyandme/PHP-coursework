<?php include '../view/header.php'; ?>
<?php
require('../model/database.php');
// require('../model/product_db.php');



if ($db) {
    echo "<p>Notice: Database Connection Successful.</p>";
}
$sql_lastID = "SELECT techID FROM assign3_technicians ORDER BY techID DESC LIMIT 1";
foreach ($db->query($sql_lastID) as $row) {
    $lastID = $row['techID'];
}
$lastID++;
?>



<?php
$firstErr = $lastErr = $emailErr = $phoneErr = $passwordErr = "";
$first = $last = $email = $phone = $password = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["firstName"])) {
        $firstErr = "First Name is required";
    } else {
        $first = $_POST["firstName"];
    };
    if (empty($_POST["lastName"])) {
        $lastErr = "Last name is required";
    } else {
        $last = $_POST["lastName"];
    };
    if (empty($_POST["email"])) {
        $emailErr = "Email address is required";
    } else {
        $email = $_POST["email"];
    };
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone is required";
    } else {
        $phone = $_POST["phone"];
    };
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = $_POST["password"];
    };
    if (!empty($first) && !empty($last) && !empty($email) && !empty($phone) && !empty($password)) {
        $sql_insert = 'INSERT INTO assign3_technicians VALUES ("' . $lastID . '","' . $first . '","' . $last . '","' . $email  . '","' . $phone  . '","' . $password. '");';
        $inserted = $db->exec($sql_insert);
        echo '<h3 style="color:red">' . $inserted . ' row inserted.</h3>';
    }
}
?>

<h3>Add Product</h3>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <div class="form-group">
        <label for="firstName">First Name:</label>
        <input style="max-width: 300px;" class="form-control" name="firstName" placeholder="First Name">
        <span class="error">* <?php echo $firstErr;?></span>
    </div>
    <div class="form-group">
        <label for="lastName">Last Name:</label>
        <input style="max-width: 300px;" class="form-control" name="lastName" placeholder="Last Name">
        <span class="error">* <?php echo $lastErr;?></span>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input style="max-width: 300px;" class="form-control" name="email" placeholder="Email:">
        <span class="error">* <?php echo $emailErr;?></span>
    </div>
    <div class="form-group">
        <label for="phone">Phone:</label>
        <input style="max-width: 300px;" class="form-control" name="phone" placeholder="Phone">
        <span class="error">* <?php echo $phoneErr;?></span>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input style="max-width: 300px;" class="form-control" name="password" placeholder="Password">
        <span class="error">* <?php echo $passwordErr;?></span>
    </div>
    <button style="margin-bottom: 10px;" type="submit" class="btn btn-default">Add Technician</button>
</form>

<a href="index.php">View Product List</a>
<?php include '../view/footer.php'; ?>
