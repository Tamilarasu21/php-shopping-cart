<?php
session_start();
require_once("db.php");
require_once("product.php");

$database=new db("shop","products");

if(isset($_POST['remove']))
{
   if($_GET['action']=='remove')
   {
        foreach($_SESSION['cart'] as $key=>$value)
        {
            if($value['product_id']==$_GET['id'])
            {
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('product has been removed')</script>";
                echo "<script>window.location='cart.php'</script>";
            }
        }
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body class="bg-light">
<?php
require_once("header.php");
?>
<div class="container-fluid">
<div class="row px-5">
    <div class="col-md-7">
        <div class="shopping-cart pt-3">
            <h6>My cart</h6>
            <hr>
             <?php
                $total=0; 
                if(isset($_SESSION['cart']))
                {
                    $product_id=array_column($_SESSION['cart'],'product_id');
                    $result=$database->getData();
                    while($row=mysqli_fetch_assoc($result))
                    {
                        foreach($product_id as $id)
                        {
                            if($row['id']==$id)
                            {
                                cart($row['product_image'],$row['product_name'],$row['product_price'],$row['id']);
                                $total+=(int)$row['product_price']; 
                            }
                        }  
                    }
                }
                else
                {
                    echo "<h2>Cart is empty</h2>";
                }
             ?>
        </div>
    </div>
    <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
        <div class="pt-3">
            <h6>PRICE DETAILS</h6>
            <hr>
            <div class="row price-details">
                <div class="col-md-6">
                    <?php
                        if(isset($_SESSION['cart']))
                        {
                            $count=count($_SESSION['cart']);
                            echo "<h6>Price($count items)</h6>";
                        }
                        else
                        {
                            echo "<h6>Price(0 items)</h6>";
                        }
                    ?>
                    <h6>Delivery Charges</h6>
                    <hr>
                    <h6>Amount Payable</h6>
                </div>
                <div class="col-md-6">
                    <h6>&#8377; <?php echo $total ?></h6>
                    <h6 class="text-success">Free</h6>
                    <hr>
                    <h6>&#8377;
                        <?php 
                            echo $total;
                        ?>
                    </h6>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>