<?php
include "class.php";
$trl = new TrialClass;
if(isset($_POST['saveBtn']))
{
    $product = isset($_POST['product']) ? $_POST['product'] : "";
    $stock = isset($_POST['stock']) ? $_POST['stock'] : "";
    $price = isset($_POST['price']) ? $_POST['price'] : "";

    $trl->setTableName("sales_data")
        ->setFieldsValues([
            "product"   => $product,
            "stock"     => $stock,
            "price"     => $price
        ])
        ->insert();

    header("location:index.php");
    exit();
}
echo "<form id='formInsert' action='".$_SERVER['PHP_SELF']."' action='' method='POST'></form>";
echo "<div class='row'>";
	echo "<div class='col-md-12'>";
		echo "<label>Product Name</label>";
		echo "<input form='formInsert' type='text' class='w3-input w3-border' name='product' required>";
	echo "</div>";
echo "</div>";
echo "<div class='row w3-padding-top'>";
	echo "<div class='col-md-12'>";
		echo "<label>Stock</label>";
		echo "<input form='formInsert' type='number'  min=0 class='w3-input w3-border' name='stock' required>";
	echo "</div>";
echo "</div>";
echo "<div class='row w3-padding-top'>";
	echo "<div class='col-md-12'>";
		echo "<label>Price</label>";
		echo "<input form='formInsert' type='number' min=0 step=any class='w3-input w3-border' name='price' required>";
	echo "</div>";
echo "</div>";
echo "<div class='row w3-padding-top'>";
	echo "<div class='col-md-12 w3-center'>";
        echo "<button form='formInsert' class='w3-btn w3-indigo w3-round w3-tiny' name='saveBtn'><i class='fa fa-check'></i>&emsp;<b>SAVE</b></button>";
	echo "</div>";
echo "</div>";
?>