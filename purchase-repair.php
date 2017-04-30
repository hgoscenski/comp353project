<?php 
include_once 'db.inc.php';
// var_dump($_POST);

$pdo = $GLOBALS['pdo'];
$userid = $_POST['userid'];

try{
    if(isset($_POST['seePurchases'])){
        $sql = "SELECT o.Date, o.OrderID, ProductDesc, Price FROM fruityco.order o 
            JOIN orderline ol ON o.OrderID = ol.OrderID
            JOIN product p ON ol.ProductID = p.ProductID
            WHERE UserID = :userid";
        $s = $pdo->prepare($sql);
        $s->bindValue(':userid', $userid);
        $s->execute();
        $results = $s->fetchAll();
        // var_dump($results);

        ?>
    <table>
        <tr>
            <th>Order Date</th>
            <th>Order ID</th>
            <th>Product Name</th>
            <th>Price</th>
        </tr>
    <?php foreach ($results as $result){ ?>
    <tr>
        <td><?=$result['Date'] ?> </td>
        <td><?=$result['OrderID'] ?></td>
        <td><?=$result['ProductDesc']?></td>
        <td><?="$ ".number_format($result['Price'],2)?></td>
    </tr>
    <?php } ?>
</table>
<?php
    }

} catch(PDOException $e){
    echo $e;
}
?>
<button onclick="history.go(-1);">Back </button>
