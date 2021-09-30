<?php
include "class.php";
$trl = new TrialClass;
$productId = isset($_POST['productId']) ? $_POST['productId'] : "";
if(isset($_POST['updateBtn']))
{
    $product = isset($_POST['product']) ? $_POST['product'] : "";
    $stock = isset($_POST['stock']) ? $_POST['stock'] : "";
    $price = isset($_POST['price']) ? $_POST['price'] : "";

    $where = "productId = ".$productId;
    $trl->setTableName("sales_data")
        ->setFieldsValues([
            "product"   => $product,
            "stock"     => $stock,
            "price"     => $price
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
    $stock = $data[0]['stock'];
}

echo "<form id='formUpdate' action='".$_SERVER['PHP_SELF']."' action='' method='POST'></form>";
echo "<input form='formUpdate' type='hidden' class='w3-input w3-border' value='".$productId."' name='productId' required>";
echo "<div class='row'>";
	echo "<div class='col-md-12'>";
		echo "<label>Product Name</label>";
		echo "<input form='formUpdate' type='text' class='w3-input w3-border' value='".$product."' name='product' required>";
	echo "</div>";
echo "</div>";
echo "<div class='row w3-padding-top'>";
	echo "<div class='col-md-12'>";
		echo "<label>Stock</label>";
		echo "<input form='formUpdate' type='number'  min=0 class='w3-input w3-border' value='".$stock."' name='stock' required>";
	echo "</div>";
echo "</div>";
echo "<div class='row w3-padding-top'>";
	echo "<div class='col-md-12'>";
		echo "<label>Price</label>";
		echo "<input form='formUpdate' type='number' min=0 step=any class='w3-input w3-border' value='".$price."' name='price' required>";
	echo "</div>";
echo "</div>";
echo "<div class='row w3-padding-top'>";
	echo "<div class='col-md-12 w3-center'>";
        echo "<button form='formUpdate' class='w3-btn w3-indigo w3-round w3-tiny' name='updateBtn'><i class='fa fa-check'></i>&emsp;<b>UPDATE</b></button>";
	echo "</div>";
echo "</div>";
?>