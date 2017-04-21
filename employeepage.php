<html>
<head>
    <title>
        Employee Page
    </title>
</head>

<?php

include "db.inc.php";
$pdo = $GLOBALS['pdo'];
try{
if(isset($_POST['newpass']) and isset($_POST['empid'])){
    $newpass = $_POST['newpass'];
    $newpass = password_hash($newpass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO employee SET SaltedPassword = :newpassword";
    $s = $pdo->prepare($sql);
    $s->bindValue(':newpassword', $newpass);
    echo "Employee ".$_POST['empid']."'s password has been updated.";
}

$employeeArray = $pdo->query("SELECT EmployeeID FROM employee");
$employeeArray = $employeeArray->fetchAll();
foreach($employeeArray as $indarray){
    $employeeIdList[] = $indarray[0];
}


?>

<body>

<h1>
Hello World!
</h1>

<h2>Change Employee Passwords</h2>
    <form action="employeepage.php" method="post">
        <!--<label for="empid">Employee ID<input type="text" name="empid"></label><br>-->
        <label for="empid">Employee ID<select name="empid">
                <?php foreach($employeeIdList as $emp){ ?>
                    <option value="<?=$emp?>"> <?=$emp?> </option>
                <?php } ?>
            </select>
        </label><br>
        <label for="newpass">New Password<input type="text" name="newpass"></label><br>
        <input type="submit" value="Change employee password"><br>
    </form>

<h2>View Sales by month</h2>
    <form action="employeepage.php" method="post">
        <label for="month">Month<select name="month">
            <option value="January"> January </option>
            <option value="February"> February </option>
            <option value="March"> March> </option>
            <option value="April">April </option>
            <option value="May"> May </option>
            <option value="June"> June </option>
            <option value="July"> July </option>
            <option value="August"> August </option>
            <option value="September"> September </option>
            <option value="October"> October </option>
            <option value="November"> November </option>
            <option value="December">December </option>
            </select>
            </label><br>
        <label for="year">Year<select name="year">
            <option value="2017"> 2017 </option>
            <option value="2016"> 2016 </option>
            <option value="2015"> 2015 </option>
            <option value="2014"> 2014 </option>
            <option value="2013"> 2013 </option>
    </form>
    
</body>

<?php
} catch(PDOException $e){
    $error = 'Error creating password.' . $e->getMessage();
    include 'error.html.php';
    exit();
}
?>

</html>