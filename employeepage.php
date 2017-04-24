<html>
<head>
    <title>
        Employee Page
    </title>
</head>

<?php

include "db.inc.php";
$pdo = $GLOBALS['pdo'];
setlocale(LC_MONETARY, 'en_US');
try{
if(isset($_POST['newpass']) and isset($_POST['empid'])){
    $newpass = $_POST['newpass'];
    $newpass = password_hash($newpass, PASSWORD_DEFAULT);
    $sql = "UPDATE employee SET SaltedPassword = :newpassword WHERE EmployeeID =".$_POST['empid'];
    $s = $pdo->prepare($sql);
    $s->bindValue(':newpassword', $newpass);
    // $s->bindValue(':empid', $_POST['empid']);
    $s->execute();
    echo "Employee ".$_POST['empid']."'s password has been updated.";
}

if(isset($_POST['fname']) and isset($_POST['ssn'])){
    $sql = "INSERT INTO employee SET 
    DepartmentID = :dept,
    Fname = :fname,
    Lname = :lname,
    Compansation = :comp,
    DOB = :dob,
    SSN = :ssn,
    EmployeeStatus = :empStatus,
    SupID = :supid,
    SaltedPassword = :pass";
    $s = $pdo->prepare($sql);
    $s->bindValue(':dept', $_POST['dept']);
    $s->bindValue(':fname', $_POST['fname']);
    $s->bindValue(':lname', $_POST['lname']);
    $s->bindValue(':comp', $_POST['compensation']);
    $s->bindValue(':dob',$_POST['dob']);
    $s->bindValue(':ssn', $_POST['ssn']);
    $s->bindValue(':empStatus', $_POST['status']);
    $s->bindValue(':supid', $_POST['supid']);
    $s->bindValue(':pass', password_hash($_POST['pass'], PASSWORD_DEFAULT));
    $s->execute();

    $empID = $pdo->query("SELECT EmployeeID FROM employee WHERE SSN = ".$_POST['ssn']);
    $empID = $empID->fetch();

    echo "User ".var_dump($empID)." added.";

}

if(isset($_POST['viewaboveavgsalary'])){
    // display those with above average salaries per department
}

if(isset($_POST['viewcustwithoutorder'])){
    // 
    $noOrders = $pdo->query("SELECT LName,fName FROM user WHERE NOT EXISTS(SELECT UserID FROM fruityco.order WHERE user.UserID = fruityco.order.UserID)");
    $noOrders = $noOrders->fetchAll();
    var_dump($noOrders);
    // Need to make this return a table
    // This is a subquery though!
}

if(isset($_POST['year']) and isset($_POST['month'])){
    // display sales by year/month
}

if(isset($_POST['productsalesview'])){
    $sql = "SELECT COUNT(*) FROM orderline O JOIN product P ON P.ProductID = O.ProductID WHERE P.ProductDesc = :proddesc";
    $s = $pdo->prepare($sql);
    $s->bindValue(':proddesc', $_POST['productsalesview']);
    $s->execute();
    $results = $s->fetch();
    
    var_dump($results);

    // will need to format nicely

}

if(isset($_POST['deleteuser'])){
    $sql = ("DELETE FROM user WHERE UserID = :userid");
    $s = $pdo->prepare($sql);
    $s->bindValue(':userid', $_POST['deleteuser']);
    $s->execute();
    echo "User " . $_POST['deleteuser'] . " has been deleted.";
}

$employeeArray = $pdo->query("SELECT EmployeeID FROM employee");
$employeeArray = $employeeArray->fetchAll();
foreach($employeeArray as $indarray){
    $employeeIdList[] = $indarray[0];
}
$empcopylist = $employeeIdList;

$userarray = $pdo->query("SELECT UserID FROM user");
$userarray = $userarray->fetchAll();
foreach($userarray as $indarray){
    $userlist[] = $indarray[0];
}

$productarray = $pdo->query("SELECT ProductDesc FROM product");
$productarray = $productarray->fetchAll();
foreach($productarray as $indarray){
    $productlist[] = $indarray[0];
}

$deptarray = $pdo->query("SELECT DepartmentID,DepartmentDesc FROM department");
$deptarray = $deptarray->fetchAll();
foreach($deptarray as $indarray){
    $deptlist[] = $indarray[1];
}

$numOrderMonth = $pdo->query("SELECT count(*) FROM fruityco.order WHERE MONTH(Date) = MONTH(now())");
$numOrderMonth = $numOrderMonth->fetch();
$numOrderMonth = $numOrderMonth[0];

$totalRevPerMonth = $pdo->query("SELECT SUM(Price) FROM product P JOIN orderline O ON P.ProductID = O.ProductID WHERE EXISTS (SELECT * FROM fruityco.order WHERE MONTH(Date) = MONTH(now()))");
$totalRevPerMonth = $totalRevPerMonth->fetch();
$totalRevPerMonth = $totalRevPerMonth[0];

$avgRevPerOrderMonth = $totalRevPerMonth / $numOrderMonth;
?>

<body>

<h1>
Good Day!
</h1>
<h2>
Orders this month: <?=$numOrderMonth?> <br>
Total Sales This Month: <?="$ ".number_format($totalRevPerMonth,2)?> <br>
Average Revenue per Order current Month: <?="$ ".number_format($avgRevPerOrderMonth ,2)?>
</h2>
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
            </select><br>
        <input type="submit" value="View Sales"><br>
    </form>

<h2>Delete Customers</h2>
    <form action="employeepage.php" method="post">
        <label for="deleteuser">User<select name="deleteuser">
        <?php foreach($userlist as $user){ ?>
                <option value="<?=$user?>"> <?=$user?> </option>
            <?php } ?>
        </select><br>
        <input type="submit" value="Delete User"><br>
    </form>

<h2>View All Time Sales by Product</h2>
    <form action="employeepage.php" method="post">
        <label for="productsalesview">Product Name<select name="productsalesview">
        <?php foreach($productlist as $prod){ ?>
                <option value="<?=$prod?>"> <?=$prod?> </option>
            <?php } ?>
        </select><br>
        <input type="submit" value="View Sales">
    </form>

<h2>View Employee Salaries Above Average For Department</h2>
    <form action="employeepage.php" method="post">
        <input type="hidden" name="viewaboveavgsalary" value="true">
        <input type="submit" value="View Results">
    </form>

<h2>View Customers without Orders</h2>
    <form action="employeepage.php" method="post">
        <input type="hidden" name="viewcustwithoutorder" value="true">
        <input type="submit" value="View Customers without Orders">
    </form>

<h2>Add New Employee</h2>
    <form action="employeepage.php" action="post">
    <div><label for="fname">First Name:
        <input type="text" name="fname" id="fname"></label>
    </div>

    <div><label for="lname">Last Name:
        <input type="text" name="lname" id="lname"></label>
    </div>

    <div><label for="compensation">Compensation:
        <input type="text" name="compensation" id="compensation"></label>
    </div>

    <div><label for="dob">Date of Birth (MM/DD/YYYY):
        <input type="text" name="dob" id="dob"></label>
    </div>

    <div><label for="ssn">Social Security Number:
        <input type="text" name="ssn" id="ssn"></label>
    </div>

    <div><label for="supid">Supervisor's ID<select name="supid"
        <?php foreach($empcopylist as $emp){ ?>
                <option value="<?=$emp?>"> <?=$emp?> </option>
            <?php } ?>
        </select><br>
    </div>

    <div><label for="dept">Department<select name="dept"
        <?php foreach($deptlist as $dept){ ?>
                <option value="<?=$dept?>"> <?=$dept?> </option>
            <?php } ?>
        </select><br>
    </div>
    <div><label for="pass">Last Name:
        <input type="text" name="pass" id="pass"></label>
    </div>

    <input type="hidden" name="status" value="ACT">
    <input type="submit" value="Add Employee">
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