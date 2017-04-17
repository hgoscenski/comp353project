<html>
<title>
    User Page!
</title>
<body>
<?php
include_once 'db.inc.php';
try{
//    echo $_GET['username']."   ".$_GET['password'];
    $pdo = $GLOBALS['pdo'];

    $sql = 'SELECT PasswordHash,UserID FROM user WHERE EmailAddress = :email';
    $s = $pdo->prepare($sql);
    $s->bindValue(':email', $_GET['username']);
    $s->execute();

    $results = $s->fetch();

    $hashedPassword = $results['PasswordHash'];
    $userid = $results['UserID'];

//    echo $hashedPassword."     ".$userid;

    $providedPassword = $_GET['password'];

//    echo "    ".$providedPassword;

    if(password_verify($providedPassword, $hashedPassword)){

        echo 'first things first';

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
        <form action="viewPuchases.php" method="get">
            <input type="hidden" name="userid" value="<?=$userid?>">
            <input type="submit" value="See Previous Purchases">
        </form>
        <form action="viewRepairs.php" method="get">
            <input type="hidden" name="userid" value="<?=$userid?>">
            <input type="submit" value="See Requested Repairs">
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
<!--/**-->
<!-- * Created by PhpStorm.-->
<!-- * User: hgoscenski-->
<!-- * Date: 4/6/17-->
<!-- * Time: 10:39-->
<!-- */-->
</body>
</html>