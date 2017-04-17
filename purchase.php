<?php
include_once 'db.inc.php';

$productId = $_GET['productId'];
$pdo = $GLOBALS['pdo'];

if(isset($_GET['userid'])){
    $userid = $_GET['userid'];
} else{
    include 'userLogin.php';
}

try {
    $sql = "SELECT PayID FROM payment WHERE UserID=:userid";
    $s = $pdo->prepare($sql);
    $s->bindValue(':userid',$userid);
    $s->execute();
    $paymentid = $s->fetch();
//    $sql = "SELECT * FROM product WHERE ProductDesc=".$productdesc;
//    $productInfo = $pdo->query($sql);
//    $productId = $productInfo[0]['ProductId'];
    echo $productId."<br>";
    echo $userid."<br>";
    echo $paymentid."<br>";
    ?>

    <label for="paymentid">Payment Method
    <select name="<?= $paymentid?>">
        <option value="<?= $paymentid?>"><?= $paymentid?></option>
    </select>

    <?php


?>

<?php
    } catch (PDOException $e) {
    $error = 'Error creating password.' . $e->getMessage();
    include 'error.html.php';
    exit();
}
?>