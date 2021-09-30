<?php
include "class.php";
$trl = new TrialClass;
$productId = isset($_POST['productId']) ? $_POST['productId'] : "";

if(isset($_POST['confirmBtn']))
{
    $stock = isset($_POST['stock']) ? $_POST['stock'] : "";
    $price = isset($_POST['price']) ? $_POST['price'] : "";
    $originalStock = isset($_POST['price']) ? $_POST['originalStock'] : "";

    $trl->setTableName("sales_product")
        ->setFieldsValues([
            "productId"     => $productId,
            "price"         => $price,
            "qty"           => $stock
        ])
        ->insert();

    $where = "productId = ".$productId;
    $totalStock = $originalStock - $stock;
    $trl->setTableName("sales_data")
        ->setFieldsValues([      
            "stock"           => $totalStock
        ])
        ->update($where);

    header("location:index.php");
    exit();
}

$sql = "SELECT * FROM sales_data WHERE productId = ".$productId;
$data = $trl->setSQLQuery($sql)->getRecords();
if($data != NULL)
{
    $product = $data[0]['product'];
    $price = $data[0]['price'];
    $originalStock = $data[0]['stock'];
}

echo "<form id='formSell' action='".$_SERVER['PHP_SELF']."' action='' method='POST'></form>";
echo "<input form='formSell' type='hidden' class='w3-input w3-border' value='".$productId."' name='productId' required>";
echo "<input form='formSell' type='hidden' class='w3-input w3-border' value='".$originalStock."' name='originalStock' required>";
echo "<input form='formSell' type='hidden' class='w3-input w3-border' value='".$price."' name='price' required>";
echo "<div class='row'>";
	echo "<div class='col-md-12'>";
		echo "<label class='w3-medium'>Product Name : ".$product."</label>";
	echo "</div>";
echo "</div>";
echo "<div class='row w3-padding-top'>";
	echo "<div class='col-md-12'>";
		echo "<label>Stock</label>";
		echo "<input form='formSell' type='number'  min=1 max=".$originalStock." class='w3-input w3-border' name='stock' required>";
	echo "</div>";
echo "</div>";
echo "<div class='row w3-padding-top'>";
	echo "<div class='col-md-12 w3-center'>";
        echo "<button form='formSell' class='w3-btn w3-indigo w3-round w3-tiny' name='confirmBtn'><i class='fa fa-check'></i>&emsp;<b>CONFIRM</b></button>";
	echo "</div>";
echo "</div>";
?>