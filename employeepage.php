<html>
<head>
    <title>
        Employee Page
    </title>
</head>

<?php

include "db.inc.php";
$pdo = $GLOBALS['pdo'];

if(isset($_POST['newpass']) and isset($_POST['empid'])){
    $newpass = $_POST['newpass'];
    $newpass = password_hash($newpass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO employee SET SaltedPassword = :newpassword";
    $s = $pdo->prepare($sql);
    $s->bindValue(':newpassword', $newpass);
    echo "Employee ".$_POST['empid']."'s password has been updated.";
}

?>

<body>

<h1>
Hello World!
</h1>

    <form action="employeepage.php" method="post">
        <label for="empid">Employee ID<input type="text" name="empid"></label><br>
        <label for="newpass">New Password<input type="text" name="newpass"></label><br>
        <input type="submit" value="Change employee password"><br>
    </form>
    
</body>

</html>