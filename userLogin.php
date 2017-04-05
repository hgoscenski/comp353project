<html>
<head>
    <title>
        New User!
    </title>
</head>
<?php
/**
 * Created by PhpStorm.
 * User: hgoscenski
 * Date: 4/5/17
 * Time: 17:45
 */
?>

<body>
<h1>If you already have an account, login:</h1>
<form action="?userLoginPhpProcessing" method="post">
    <div>
        <label for="username">Username <input type="text" name="username" id="username"></label>
    </div>
    <div>
        <label for="password">Password <input type="password" name="password" id="password"</label>
    </div>
    <div><input type="submit" value="Submit"></div>
</form>

<form action="?addUser" method="post">
    <div><label for="dname">Department Name:
            <input type="text" name="dname" id="dname"></label>
    </div>
    <div><label for="dnum">Department Number:
            <input type="text" name="dnum" id="dnum"></label>
    </div>
    <div><label for="mgr_ssn">Department Manager's SSN:
            <input type="text" name="mgr_ssn" id="mgr_ssn"></label>
    </div>


    <div><input type="submit" value="Add"></div>
</form>
</body>

</html>