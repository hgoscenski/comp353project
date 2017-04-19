<?php
include_once 'db.inc.php';
$pdo = $GLOBALS['pdo'];

if(isset($_POST['quantity'])){
    $prodid = $_POST['prodid'];
    $orderid = $_POST['orderid'];
    $quanity = $_POST['quantity'];

    $sql = "INSERT INTO orderlines SET 
    ProductID = :prodid,
    OrderID = :orderid,
    Quantity = :quantity";
    $s = $pdo->prepare($sql);
    $s->bindValue(':prodid', $prodid);
    $s->bindValue(':orderid', $orderid);
    $s->bindValue(':quantity', $quanity);
    $s->execute();

    echo "Truth!!";

}

$productId = $_GET['productId'];
$pdo = $GLOBALS['pdo'];

if(isset($_GET['userid'])){
    $userid = $_GET['userid'];
} else{
    include 'userLogin.php';
}

try {
    $sql = "SELECT PayID,CreditCardNum FROM payment WHERE UserID = :userid";
    $s = $pdo->prepare($sql);
    $s->bindValue(':userid',$userid);
    $s->execute();
    $paymentid = $s->fetch();

    if($s->rowcount() ==0){
        echo "You need to set up your payment method first.";
        include 'setPayment.php';
        exit();
    }

    

//    $sql = "SELECT * FROM product WHERE ProductDesc=".$productdesc;
//    $productInfo = $pdo->query($sql);
//    $productId = $productInfo[0]['ProductId'];
    echo $productId."<br>";
    echo $userid."<br>";
    echo $paymentid['PayID']."<br>";
    echo $paymentid['CreditCardNum']."<br>";
    date_default_timezone_set("UTC");
    echo date('m/d/Y')."<br>";
    ?>

    <label for="paymentid">Payment Method: Card ending in
    <select name="<?= substr($paymentid['CreditCardNum'],-4)?>">
        <option value="<?= substr($paymentid['CreditCardNum'],-4)?>"><?= substr($paymentid['CreditCardNum'],-4)?></option>
    </select>


    <?php
    echo "<br><br>";
    $sql = ("SELECT * FROM product WHERE ProductID = :productid");
    $s = $pdo->prepare($sql);
    $s->bindValue(':productid', $productId);
    $s->execute();
    $productInfo = $s->fetch();


    // need ot create orderid here and insert into order table

    echo $productInfo['ProductDesc'].", costing ".$productInfo['Price']."<br>";
    ?>
    <form>
        <form action="purchase.php" method="post">
            <input type='hidden' name="orderid" value="<?= $orderid ?>">
            <input type='hidden' name='prodid' value="<?= $productId ?>">
            <input type='hidden' name='quantity' value=1 >
            <input type="submit" value="Purchase Product!">
        </form>
    </form>
    <?php
?>

<?php
    } catch (PDOException $e) {
    $error = 'Error creating password.' . $e->getMessage();
    include 'error.html.php';
    exit();
}
?>