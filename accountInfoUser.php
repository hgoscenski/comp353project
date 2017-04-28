
<html>
<title>
    User Page!
</title>
<body>
<?php
$pdo = $GLOBALS['pdo'];
var_dump($_POST);

if(isset($_POST['username'])){
    $userName = $_POST['username'];
}

include_once 'db.inc.php';
try{

    // if(isset($_POST['seePurchases'])){
    //     $sql = "SELECT OrderID FROM order WHERE UserID = :userid";
    //     $s = $pdo->prepare($sql);
    //     $s->bindValue(':userid', $_POST['userid']);
    //     $s->execute();
    //     $results = $s->fetchAll();
    //     var_dump($results);
    // }
//    echo $_GET['username']."   ".$_GET['password'];
    $sql = 'SELECT PasswordHash,UserID FROM user WHERE EmailAddress = :email';
    $s = $pdo->prepare($sql);
    $s->bindValue(':email', $_POST['username']);
    $s->execute();

    $results = $s->fetch();

    $hashedPassword = $results['PasswordHash'];
    $userid = $results['UserID'];

//    echo $hashedPassword."     ".$userid;

    $providedPassword = $_POST['password'];
    // echo $providedPassword;

//    echo "    ".$providedPassword;

    if(password_verify($providedPassword, $hashedPassword)){

        if(isset($_GET['userid']) && isset($_GET['magic'])){
            $userid=$_GET['userid'];
        }

        // echo 'first things first';

        $query = $pdo->query('SELECT fName FROM user WHERE UserID='.$userid);
        $userInfo = $query->fetchAll();


        echo "<pre>"; print_r($userInfo[0]); echo "</pre>";

        $userName = $userInfo[0]['fName'];


        echo "Welcome ".$userName."!";

        ?>
        <form action="index.php" method="get">
            <input type='hidden' name="userid" value="<?= $userid?>">
            <input type="submit" value="Purchase Items!">
        </form>
        <form action="accountInfoUser.php" method="post">
            <input type="hidden" name="userid" value="<?=$userid?>">
            <input type="hidden" name="seePurchases" value="true">
            <input type="submit" value="See Previous Purchases">
        </form>
        <form action="accountInfoUser.php" method="post">
            <input type="hidden" name="userid" value="<?=$userid?>">
            <input type="hidden" name="seeRepairs" value="true">
            <input type="submit" value="Request Repairs/Track Repairs">
        </form>
        <form action="setPayment.php" method="get">
            <input type="hidden" name="userid" value="<?=$userid?>">
            <input type="submit" value="Set/Change Payment Method">
        </form>

        <?php

    } else {
        echo "failure";
    }
} catch(PDOException $e){

}
?>

</body>
</html>
