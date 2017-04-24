<?php
include_once 'db.inc.php';
$pdo = $GLOBALS['pdo'];
$productId = $_GET['productId'];
if(isset($_POST['prodid'])){
    $productId = $_POST['prodid'];
}

// var_dump($_POST);
date_default_timezone_set("UTC");
echo date('Y/m/d')."<br>";

if(isset($_POST['quantity'])){
    try{
        $pdo->beginTransaction();
    // var_dump($_POST);
    // echo "<br> Testing <br>";

    $sql = "INSERT INTO fruityco.order SET
        PayID = :payid,
        UserID = :userid,
        order.Date = :datedate";
    $s = $pdo->prepare($sql);
    $s->bindValue(':payid', $_POST['paymentid']);
    $s->bindValue(':userid', $_POST['userid']);
    $s->bindValue(':datedate', date('Y/m/d'));
    $s->execute();

    // echo "<br>Order Created<br>";

    $sql = "SELECT OrderID FROM fruityco.order WHERE
        PayID = :payid AND
        UserID = :userid AND
        order.Date = :datedate";
    $s = $pdo->prepare($sql);
    $s->bindValue(':payid', $_POST['paymentid']);
    $s->bindValue(':userid', $_POST['userid']);
    $s->bindValue(':datedate', date('Y/m/d'));
    $s->execute();

    $orderid = $s->fetch();
    $orderid = $orderid[0];

    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO orderline SET 
    ProductID = :prodid,
    OrderID = :orderid,
    Quantity = :quantity";
    // echo $sql;
    $s = $pdo->prepare($sql);
    $s->bindValue(':prodid', $productId);
    $s->bindValue(':orderid', $orderid);
    $s->bindValue(':quantity', $quantity);
    $s->execute();
    $pdo->commit();
    } catch (PDOException $e){
        $pdo->rollBack();
        die($e->getMessage()."<br>The transaction failed to commit and has been rolled back!");
    }

    echo "Product Purchased!";
    include "index.php";
    quit();

}


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
    // echo $productId."<br>";
    // echo $userid."<br>";
    // echo $paymentid['PayID']."<br>";
    // echo $paymentid['CreditCardNum']."<br>";

    ?>

    <!--<label for="paymentid">Payment Method: Card ending in
    <select name="<?= substr($paymentid['CreditCardNum'],-4)?>">
        <option value="<?= $paymentid['CreditCardNum']?>"><?= substr($paymentid['CreditCardNum'],-4)?></option>
    </select>-->


    <?php
    echo "<br>";
    $sql = ("SELECT * FROM product WHERE ProductID = :productid");
    $s = $pdo->prepare($sql);
    $s->bindValue(':productid', $productId);
    $s->execute();
    $productInfo = $s->fetch();


    // need ot create orderid here and insert into order table

    echo "1 ".$productInfo['ProductDesc'].", costing $".number_format($productInfo['Price'],2)."<br>";
    echo $productId;
    ?>

        <form action="purchase.php" method="post">
            <label for="paymentid">Payment Method: Card ending in
            <select name="paymentid">
                <option value="<?= $paymentid['PayID']?>"><?= substr($paymentid['CreditCardNum'],-4)?></option>
            </select></label>
            <input type='hidden' name='prodid' value="<?=$productId?>">
            <input type='hidden' name='userid' value="<?=$userid?>">
            <input type='hidden' name='quantity' value= 1 >
            <input type="submit" value="Purchase Product!">
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