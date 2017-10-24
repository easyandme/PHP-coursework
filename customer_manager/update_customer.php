<?php include '../view/header.php'; ?>
<?php
require('../model/database.php');
// require('../model/product_db.php');

$sql = "";
$sql_country = "SELECT countryCode, countryName from assign3_countries";

if ($db) {
    echo "<p>Notice: Database Connection Successful.</p>";
}
if (isset($_GET['selectID'])) {
    $selectID = $_GET['selectID'];
    $sql = "SELECT customerID, firstName, lastName, address, city, state, postalCode, countryCode, phone, email, password from assign3_customers where customerID = '" . $selectID . "'";
}

$firstErr = $lastErr = $emailErr = $phoneErr = $passwordErr = "";
$first = $last = $email = $phone = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address = $_POST["address"];
    $state = $_POST["state"];
    $city = $_POST["city"];
    $postal = $_POST["zip"];
    $country = $_POST["country"];
    $customerID = $_POST["customerID"];
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
        $sql_update = "Update assign3_customers SET firstName = '" . $first . "', lastName = '" . $last . "', address = '" . $address .
            "', city = '" . $city . "', state = '" . $state . "', postalCode = '" . $postal . "', countryCode = '" . $country .
            "', phone = '" . $phone . "', email = '" . $email . "', password = '" . $password . "' WHERE customerID = '" . $customerID . "'";
        $updated = $db->exec($sql_update);
        echo '<h3 style="color:red">' . $updated . ' row updated.</h3>';
    }
}
?>

<h3>View / Update Customer</h3>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <?php foreach ((object) $db->query($sql) as $row) { ?>
        <input style="max-width: 300px;display:none;"  class="form-control" name="customerID" value="<?php echo $row['customerID']; ?>">
    <div class="form-group">
        <label for="firstName">First Name:</label>
        <input style="max-width: 300px;" class="form-control" name="firstName" value="<?php echo $row['firstName']; ?>">
        <span class="error">* <?php echo $firstErr;?></span>
    </div>
    <div class="form-group">
        <label for="lastName">Last Name:</label>
        <input style="max-width: 300px;" class="form-control" name="lastName" value="<?php echo $row['lastName']; ?>">
        <span class="error">* <?php echo $lastErr;?></span>
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <input style="max-width: 300px;" class="form-control" name="address" value="<?php echo $row['address']; ?>">
    </div>
    <div class="form-group">
        <label for="city">City:</label>
        <input style="max-width: 300px;" class="form-control" name="city" value="<?php echo $row['city']; ?>">
    </div>
    <div class="form-group">
        <label for="state">State:</label>
        <input style="max-width: 300px;" class="form-control" name="state" value="<?php echo $row['state']; ?>">
    </div>
    <div class="form-group">
        <label for="zip">Postal Code:</label>
        <input style="max-width: 300px;" class="form-control" name="zip" value="<?php echo $row['postalCode']; ?>">
    </div>
    <div class="form-group">
        <label for="country">Country Code:</label>
        <select style="max-width: 300px;" class="form-control" name="country">
        <?php foreach ((object) $db->query($sql_country) as $countries) { ?>
            <option <?php if ($row['countryCode'] == $countries['countryCode']) { echo "selected"; }  ?>  value="<?php echo $countries['countryCode']; ?>"><?php echo $countries['countryName']; ?></option>
        <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="phone">Phone:</label>
        <input style="max-width: 300px;" class="form-control" name="phone" value="<?php echo $row['phone']; ?>">
        <span class="error">* <?php echo $phoneErr;?></span>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input style="max-width: 300px;" class="form-control" name="email" value="<?php echo $row['email']; ?>">
        <span class="error">* <?php echo $emailErr;?></span>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input style="max-width: 300px;" class="form-control" name="password" value="<?php echo $row['password']; ?>">
        <span class="error">* <?php echo $passwordErr;?></span>
    </div>
    <button style="margin-bottom: 20px;" type="submit" class="btn btn-default">Update Customer</button>
    <?php } ?>
</form>

<a href="index.php">Search Customer</a>
<?php include '../view/footer.php'; ?>
