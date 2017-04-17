<?php
include_once 'db.inc.php';
/**
 * Created by PhpStorm.
 * User: hgoscenski
 * Date: 4/17/17
 * Time: 12:07
 */
$userid = $_GET['userid'];
$pdo = $GLOBALS['pdo'];

if(isset($_get['what']) and $_GET['what']=='delete'){
    $pdo->query('DELETE FROM payment WHERE UserID='.$userid);
    echo 'Card deleted. <br>';
    include 'userLogin.php';
}

if(isset($_GET['bname']) || isset($_GET['what'])){
    try {
        $pdo->query('DELETE FROM payment WHERE UserID='.$userid);

        $sql = 'INSERT INTO payment SET
        UserID = :userid,
        BillingName = :bname,
        BillingStreetAddress = :streetaddress,
        BillingCity = :city,
        BillingState = :state,
        BillingZipCode = :zipcode,
        CreditCardNum = :crednum,
        CreditCardExpiryDate = :credexpiry,
        CreditCardSecurityCode = :seccode,
        BillingCountry="USA"';

        $s = $pdo->prepare($sql);
        $s->bindValue(':userid', $userid);
        $s->bindValue(':bname', $_GET['bname']);
        $s->bindValue(':streetaddress', $_GET['streetaddress']);
        $s->bindValue(':city', $_GET['bcity']);
        $s->bindValue(':state', $_GET['bstate']);
        $s->bindValue(':zipcode', $_GET['bzip']);
        $s->bindValue(':crednum', $_GET['cardnum']);
        $s->bindValue(':credexpiry', $_GET['cardexpiry']);
        $s->bindValue(':seccode', $_GET['cardcode']);

        $s->execute();
    } catch (PDOException $e) {
        echo "Error!".$e;
        exit();
    }
    echo "Card has been updated/added.<br>";

}

try{
    $sql = "SELECT * FROM payment WHERE UserId=:userid";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(':userid', $userid);
    $ps->execute();
    $userPaymentMethod = $ps->fetchAll();

    if($ps->rowcount() > 0) {


        $last4ofCreditCard = $userPaymentMethod[0]['CreditCardNum'];

//    echo "<pre>"; print_r($userPaymentMethod); echo "</pre>";

        $last4ofCreditCard = (string)$last4ofCreditCard;
        $last4ofCreditCard = substr($last4ofCreditCard, -4);

        echo "This is the last 4 digits of your current payment method." . "<br>";
        echo $last4ofCreditCard . "<br>";
        echo "To change to new card or delete this one select the appropriate option from below! <br>";
        ?>

        <form action="setPayment.php" method="get">
            <input type='hidden' name="userid" value="<?= $userid ?>">
            <input type='hidden' name="what" value="delete">
            <input type="submit" value="Delete Payment Method!">
        </form>
        <form action="setPayment.php" method="get">
            <input type='hidden' name="userid" value="<?= $userid ?>">
            <input type='hidden' name="what" value="newpay">
            <input type="submit" value="Add New Payment Method">
        </form>
        <?php
    } else {
        ?>
        Add new payment method here.
        <form action="setPayment.php" method="get">
            <input type='hidden' name="userid" value="<?= $userid ?>">
            <div>
                <label for="bname">Billing Name
                    <input type="text" name="bname" id="bname"></label>
            </div>
            <div>
                <label for="streetaddress">Street Address
                    <input type="text" name="streetaddress" id="streetaddress"></label>
            </div>
            <div><label for="bcity">City
                    <input type="text" name="bcity" id="bcity"></label>
            </div>
            <div><label for="bstate">State
                    <input type="text" name="bstate" id="bstate"</label>
            </div>
            <div><label for="bzip">Zip Code
                    <input type="text" name="bzip" id="bzip"></label>
            </div>
            <div><label for="cardnum">Card Number
                    <input type="text" name="cardnum" id="cardnum"></label>
            </div>
            <div><label for="cardexpiry">Expiration Date
                    <input type="text" name="cardexpiry" id="cardexpiry"></label>
            </div>
            <div><label for="cardcode">Security Code
                    <input type="text" name="cardcode" id="cardcode"</label>
            </div>
            <input type="submit" value="Add New Payment Method">
        </form>
        <?php
    }

} catch (PDOException $e) {
    $error = 'Error. The data are broken. Come back later. They might be less broken then.' . $e->getMessage();
    include 'error.html.php';
    exit();
}

