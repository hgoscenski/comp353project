<!DOCTYPE html>
<link rel="stylesheet" href="css/table.css" type="text/css">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fruity Co. Store</title>
</head>
<body>
<?php
include_once 'db.inc.php';
try
{
    $products = $GLOBALS['pdo']->query('SELECT * FROM product');
}
catch(PDOException $e)
{
    $error = 'This is not working properly, see error message below:<br>'.$e;
    include 'error.html.php';
    exit();
}
    ?>
<h1>Hello and Welcome to Fruity Co.</h1>
<h2>If you are an employee Login <a href="emplogin.php">Here</a> </h2>
<h2>If you are an existing customer Login <a href="userlogin.php">Here</a> </h2>
<h2>If you need to request repairs click <a href="requestRepairs.php">Here</a>"</h2>
<h2>This is a list of our currently available products:</h2>
<h3>As we are exclusive and handcraft all of our products we do restrict orders to a maximum of 1 per month per customer</h3>
<table>
    <tr>
        <th>Product Pic</th>
        <th>Product Name</th>
        <th>Product Price</th>
        <th>Current Quantity</th>
    </tr>
    <?php foreach ($products as $product){
//        $productdescription = $product['ProductDesc'];
//        $productprice = $product['Price'];
//        $productquantity = $product['QuantityAval'];
        $image = $product['ProductPic'];
//        $image = "images/fireman.jpg";
        ?>
    <tr>
        <td><img src="<?php echo $image ?>" alt="test" style="width: 50%; height: 50%" </td>
<!--        <td>--><?php //echo "<img src=$product['ProductPic']"?><!--</td>-->
        <td><a href="purchase.php"><?php echo $product['ProductDesc']?></a></td>
        <td><?php echo $product['Price']?></td>
        <td><?php echo $product['QuantityAval']?></td>
    </tr>
    <?php } ?>
</table>
</body>
</html>