<html>

<head>
    <title>
        Employee Login
    </title>
</head>
<?php
include_once 'db.inc.php';
$pdo = $GLOBALS['pdo'];

try {

    if(isset($_POST['password'])){
        $enteredPass = $_POST['password'];
        $empid = $_POST['username'];

        $sql = "SELECT EmployeeID, SaltedPassword, Fname, Lname FROM employee WHERE EmployeeID = :empid";
        $s = $pdo->prepare($sql);
        $s->bindValue(':empid', $empid);
        $s->execute();

        $results = $s->fetch();

        $fname = $results['Fname'];
        $saltedpassword = $results['SaltedPassword'];

        // echo $fname."   ".$saltedpassword."    ".$enteredPass."<br>";
        echo "<br>";
        if(password_verify($enteredPass, $saltedpassword)){
            echo "Welcome ".$fname."!";
            include "employeepage.php";
            quit();
        }

    }
    ?>

<form action="emplogin.php" method="post">
    <div>
        <label for="username">Username <input type="text" name="username" id="username" required></label>
    </div>
    <div>
        <label for="password">Password <input type="password" name="password" id="password" required></label>
    </div>
    <div><input type="submit" value="Submit"></div>
</form>

    <?php

} catch(PDOException $e){
    $error = 'Error creating password.' . $e->getMessage();
        include 'error.html.php';
        exit();
}
?>

</html>