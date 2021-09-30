<?php
include "class.php";

$trl = new TrialClass;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href=href="https://fonts.googleapis.com/css2?family=Audiowide" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/css/iziModal.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Stock Management</title>
</head>
<style>
    body{
        font-size:13px;
        font-family: "Audiowide", sans-serif;
    }

    tr td{
        vertical-align:middle;
    }
</style>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            <a class="navbar-brand" href="#">Trial Project</a>
        </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active" id='productNav'><a href="#">Products</a></li>
                    <li class='' id='salesNav'><a href="#">Sales</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class='container' id='productView'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='w3-right'>
                    <button class='w3-btn w3-indigo w3-round w3-tiny' id='addProduct'><i class="fa fa-plus"></i>&emsp;<b>ADD</b></button>
                </div>
            </div>
        </div>
        <div class='row w3-padding-top'>
            <div class='col-md-12'>
                <table class='table table-bordered table-condesed table-striped'>
                    <thead class='w3-indigo'>
                        <th class='w3-center'>#</th>
                        <th class='w3-center'>Product Name</th>
                        <th class='w3-center'>Stock</th>
                        <th class='w3-center'>Price</th>
                        <th class='w3-center'>Actions</th>
                    </thead>
                    <tbody>
                        <?php
                        $x = 0;
                        $totalPrice = 0;
                        $sql = "SELECT * FROM sales_data";
                        $data = $trl->setSQLQuery($sql)->getRecords();
                        if($data != NULL)
                        {
                            foreach ($data as $key)
                            {
                                echo "<tr>";
                                    echo "<td class='w3-center'><b>".++$x."</b></td>";
                                    echo "<td class='w3-center'>".$key['product']."</td>";
                                    echo "<td class='w3-center'>".$key['stock']."</td>";
                                    echo "<td style='text-align:right;'>".number_format($key['price'],2)."</td>";
                                    echo "<td class='w3-center'>
                                        <button class='w3-btn w3-green w3-round w3-tiny sell' data-stock=".$key['stock']." id='".$key['productId']."'><i class='fa fa-shopping-cart'></i>&emsp;<b>SELL</b></button>
                                        <button class='w3-btn w3-indigo w3-round w3-tiny edit' id='".$key['productId']."'><i class='fa fa-pencil-square'></i>&emsp;<b>EDIT</b></button>
                                    </td>";
                                echo "</tr>";

                                $totalPrice += $key['price'];
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style='text-align:right;'><b>Total Price : <?php echo number_format($totalPrice,2); ?></b></td>
                            <td></td>
                        </tr>
                    <tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class='container' id='salesView' hidden>
        <div class='row w3-padding-top'>
            <div class='col-md-12'>
                <table class='table table-bordered table-condesed table-striped'>
                    <thead class='w3-indigo'>
                        <th class='w3-center'>#</th>
                        <th class='w3-center'>Product Name</th>
                        <th class='w3-center'>Sale Qty</th>
                        <th class='w3-center'>Price</th>
                        <th class='w3-center'>Total Price</th>
                    </thead>
                    <tbody>
                        <?php
                        $x = 0;
                        $totalPrice = 0;
                        $sql = "SELECT * FROM sales_product";
                        $data = $trl->setSQLQuery($sql)->getRecords();
                        if($data != NULL)
                        {
                            foreach ($data as $key)
                            {
                                $productId = $key['productId'];
                                $qty = $key['qty'];
                                $price = $key['price'];

                                $sql = "SELECT * FROM sales_data WHERE productId = ".$productId;
                                $dataSales = $trl->setSQLQuery($sql)->getRecords();
                                if($dataSales != NULL)
                                {
                                    $product = $dataSales[0]['product'];
                                    
                                    $totalSalePrice = $qty * $price;
                                    echo "<tr>";
                                        echo "<td class='w3-center'><b>".++$x."</b></td>";
                                        echo "<td class='w3-center'>".$product."</td>";
                                        echo "<td class='w3-center'>".$key['qty']."</td>";
                                        echo "<td style='text-align:right;'>".number_format($price,2)."</td>";
                                        echo "<td style='text-align:right;'>".number_format($totalSalePrice,2)."</td>";
                                    echo "</tr>";

                                    $totalPrice += $totalSalePrice;
                                }
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style='text-align:right;'><b>Total Sale Price : <?php echo number_format($totalPrice,2); ?></b></td>
                        </tr>
                    <tfoot>
                </table>
            </div>
    </div>
    <div id='modal-izi-add'><span class='izimodal-content-add'></span></div>
    <div id='modal-izi-update'><span class='izimodal-content-update'></span></div>
    <div id='modal-izi-sell'><span class='izimodal-content-sell'></span></div>
</body>
</html>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/js/iziModal.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
    $("#addProduct").click(function(){
		$("#modal-izi-add").iziModal({
            title                   : '<i class="fa fa-flash"></i><font style="text-transform: uppercase;"> Add Product</font>',
            headerColor             : '#1F4788',
            subtitle                : '<b style="text-transform: uppercase;"><?php echo (date('F d, Y'));?></b>',
            width                   : 450,
            fullscreen              : false,
            transitionIn            : 'comingIn',
            transitionOut           : 'comingOut',
            padding                 : 20,
            radius                  : 0,
            top                     : 10,
            restoreDefaultContent   : true,
            closeOnEscape           : true,
            closeButton             : true,
            overlayClose            : false,
            onOpening               : function(modal){
                                        modal.startLoading();
                                        $.ajax({
                                            url         : 'addProduct.php',
                                            type        : 'POST',
                                            data        : {
                                            },
                                            error: function() {
                                                        alert('error');
                                            },
                                            async       : true,
                                            success     : function(data){
                                                            $( ".izimodal-content-add" ).html(data);
                                                            modal.stopLoading();
                                            }
                                        });
			},
			onClosed            : function(modal){
									$("#modal-izi-add").iziModal("destroy");
			}
        });

        $("#modal-izi-add").iziModal("open");
    });
    
    $(".sell").click(function(){
        var productId = $(this).prop("id");
        var stock = $(this).attr("data-stock");
        if(stock > 0)
        {
            $("#modal-izi-sell").iziModal({
                title                   : '<i class="fa fa-flash"></i><font style="text-transform: uppercase;"> Sell Product</font>',
                headerColor             : '#1F4788',
                subtitle                : '<b style="text-transform: uppercase;"><?php echo (date('F d, Y'));?></b>',
                width                   : 450,
                fullscreen              : false,
                transitionIn            : 'comingIn',
                transitionOut           : 'comingOut',
                padding                 : 20,
                radius                  : 0,
                top                     : 10,
                restoreDefaultContent   : true,
                closeOnEscape           : true,
                closeButton             : true,
                overlayClose            : false,
                onOpening               : function(modal){
                                            modal.startLoading();
                                            $.ajax({
                                                url         : 'sellProduct.php',
                                                type        : 'POST',
                                                data        : {
                                                                productId : productId
                                                },
                                                error: function() {
                                                            alert('error');
                                                },
                                                async       : true,
                                                success     : function(data){
                                                                $( ".izimodal-content-sell" ).html(data);
                                                                modal.stopLoading();
                                                }
                                            });
                },
                onClosed            : function(modal){
                                        $("#modal-izi-sell").iziModal("destroy");
                }
            });
        }
        else
        {
            Swal.fire({
                title: 'Ooops!',
                text: 'This product is out of stock.',
                icon: 'warning',
                showConfirmButton: false,
                timer: 2500
            })
        }

        $("#modal-izi-sell").iziModal("open");
    });

    $(".edit").click(function(){
        var productId = $(this).prop("id");
		$("#modal-izi-update").iziModal({
            title                   : '<i class="fa fa-flash"></i><font style="text-transform: uppercase;"> Edit Product</font>',
            headerColor             : '#1F4788',
            subtitle                : '<b style="text-transform: uppercase;"><?php echo (date('F d, Y'));?></b>',
            width                   : 450,
            fullscreen              : false,
            transitionIn            : 'comingIn',
            transitionOut           : 'comingOut',
            padding                 : 20,
            radius                  : 0,
            top                     : 10,
            restoreDefaultContent   : true,
            closeOnEscape           : true,
            closeButton             : true,
            overlayClose            : false,
            onOpening               : function(modal){
                                        modal.startLoading();
                                        $.ajax({
                                            url         : 'editProduct.php',
                                            type        : 'POST',
                                            data        : {
                                                            productId : productId
                                            },
                                            error: function() {
                                                        alert('error');
                                            },
                                            async       : true,
                                            success     : function(data){
                                                            $( ".izimodal-content-update" ).html(data);
                                                            modal.stopLoading();
                                            }
                                        });
			},
			onClosed            : function(modal){
									$("#modal-izi-update").iziModal("destroy");
			}
        });

        $("#modal-izi-update").iziModal("open");
    });

    $("#productNav").click(function(){
        $("#productView").show();
        $("#salesView").hide();
        $(this).removeClass("active");
        $(this).addClass("active");
        $("#salesNav").removeClass("active");
    });

    $("#salesNav").click(function(){
        $("#salesView").show();
        $("#productView").hide();
        $(this).removeClass("active");
        $(this).addClass("active");
        $("#productNav").removeClass("active");
    });
});
</script>