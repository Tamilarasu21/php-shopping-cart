<?php
session_start();
require_once "db.php";
require_once "product.php";

#Instance for db.php
$database= new db("shop","products");

if(isset($_POST['add']))
{
    if(isset($_SESSION['cart']))
    {
        $item_array_id=array_column($_SESSION['cart'],'product_id');

        if(in_array($_POST['product_id'],$item_array_id))
        {
            echo "<script>alert('product is already added in the cart')</script>";
            echo "<script>window.location='index.php'</script>";
        }
        else
        {
            $count=count($_SESSION['cart']);
            $item_array=array('product_id'=>$_POST['product_id']);
            $_SESSION['cart'][$count]=$item_array;
        }
    }
    else
    {
        $item_array=array('product_id'=>$_POST['product_id']);
        $_SESSION['cart'][0]=$item_array;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping cart</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<?php require_once("header.php"); ?>
    <div class="container">
        <div class="row text-center py-3">
            <?php 
                $result=$database->getData();
                while($row=mysqli_fetch_assoc($result))
                {
                    product($row['product_name'],$row['product_price'],$row['product_image'],$row['id']);
                }
            ?>
        </div>
    </div>
<!-- bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>