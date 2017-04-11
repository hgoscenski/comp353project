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

    $sql = 'SELECT SaltedPassword,UserID FROM loginuser WHERE EmailAddress = :email';
    $s = $pdo->prepare($sql);
    $s->bindValue(':email', $_GET['username']);
    $s->execute();

    $results = $s->fetch();

    $hashedPassword = $results['SaltedPassword'];
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