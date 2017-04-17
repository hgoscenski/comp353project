<?php
include_once 'db.inc.php';

$productdesc = $_GET['productdesc'];
if(isset($_GET['userid'])){
    $userid = $_GET['userid'];
} else{
    include 'userLogin.php';
}

try {


?>

<?php
    } catch (PDOException $e) {
    $error = 'Error creating password.' . $e->getMessage();
    include 'error.html.php';
    exit();
}
?>