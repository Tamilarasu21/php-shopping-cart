<?php
function product($product_name,$product_price,$product_image,$productid)
{
    $form = '<div class="col-md-3 col-sm-6 my-3 my-md-0">
                <form action="" method="post">
                    <div class="card shadow">
                        <div>
                            <img src="'.$product_image.'" alt="image1" class="img-fluid card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">'.$product_name.'</h5>
                                <h6>
                                    <i class="fa fa-star"> </i><i class="fa fa-star"> </i><i class="fa fa-star"> </i><i class="fa fa-star"> </i><i class="fa fa-star-o"> </i>
                                </h6>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur</p>
                                <h5><small><s class="text-secondary">&#8377;29999</s></small>&nbsp;<span class="price">&#8377;'.$product_price.'</span></h5>
                                <button type="submit" name="add" class="btn btn-warning my-3">Add to cart&nbsp;<i class="fa fa-shopping-cart"></i></button>
                                <input type="hidden" name="product_id" value="'.$productid.'">    
                            </div>
                        </div>
                    </div>
                </form>
            </div>';
    echo $form;
}

function cart($productimg,$productname,$productprice,$productid)
{
    $element='<form action="cart.php?action=remove&id='.$productid.'" method="post" class="cart-items pb-3">
    <div class="border rounded ">
       <div class="row bg-white">
       <div class="col-md-3 pl-0">
           <img src="'.$productimg.'" alt="Iphone" class="img-fluid">
       </div>
       <div class="col-md-6">
           <h5 class="pt-2">'.$productname.'</h5>
           <small class="text-secondary"></small>
           <h5 class="pt-2">&#8377;'.$productprice.'</h5>
           <button type="submit" class="btn btn-secondary">Save for later</button>
           <button type="submit" class="btn btn-danger mx-2" name="remove">Remove</button>
       </div>
       <div class="col-md-3 py-5">
           <div>
               <button type="button" class="btn bg-light border rounded-circle"><i class="fa fa-minus"></i></button>
               <input type="text" value="1" class="form-control w-25 d-inline">
               <button type="button" class="btn bg-light border rounded-circle"><i class="fa fa-plus"></i></button>
           </div>
       </div>
       </div>
    </div>
    </form>'; 

    echo $element;
}
?>