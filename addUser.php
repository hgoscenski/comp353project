<html>
<body>
<?php
include_once 'db.inc.php';

/**
 * Created by PhpStorm.
 * User: hgoscenski
 * Date: 4/5/17
 * Time: 17:44
 */

if (isset($_GET['fname'])) {
    try {
        $sql = 'INSERT INTO user SET
        fName = :fname,
        LName = :lname,
        ShipStreetAddress = :streetaddress,
        ShipCity = :city,
        ShipState = :state,
        ShipZipCode = :zipcode,
        ShipCountry = :country,
        PhoneNumber = :phone,
        EmailAddress = :email';

        $s = $GLOBALS['pdo']->prepare($sql);

        $emailHoldingItem = $_GET['email'];

        $s->bindValue(':fname', $_GET['fname']);
        $s->bindValue(':lname', $_GET['lname']);
        $s->bindValue(':streetaddress', $_GET['streetaddress']);
        $s->bindValue(':city', $_GET['city']);
        $s->bindValue(':state', $_GET['state']);
        $s->bindValue(':zipcode', $_GET['zipcode']);
        $s->bindValue(':country', $_GET['country']);
        $s->bindValue(':phone', $_GET['phone']);
        $s->bindValue(':email', $emailHoldingItem);
        $s->execute();
        ?>

        <h2>Thank you for registering! Please set your password:</h2>

        <?php $emailSQL = $GLOBALS['pdo']->prepare('SELECT UserID FROM fruityco.user WHERE EmailAddress = :email');
            $emailSQL->bindValue(':email', $emailHoldingItem);
            $emailSQL->execute();

            $result = $emailSQL->fetch();
            $userid = $result['UserID'];
            ?>


        <form action="setPasswordUser.php" method="get">
            <div>
                <label for="password">Password<input type="password" name="password" id="password"</label>
                <input type="hidden" name="email" value="<?php echo $emailHoldingItem;?>">
                <input type="hidden" name="userid" value="<?= $userid;?>">
            </div>
        </form>

<?php
    } catch (PDOException $e) {
        $error = 'Error adding submitted department: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }
}
?>
</body>
</html>
