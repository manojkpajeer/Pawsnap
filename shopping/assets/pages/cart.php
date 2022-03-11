<div id="staplesbmincart">
    <form method="get" class="">  
        <div class="sbmincart-suc-cart-text">Cart</div>  
        <button type="button" class="sbmincart-closer">×</button>    
        <?php 

            $total_price = 0;
            
            if (!empty($_SESSION['cart_item'])) {

                echo "<ul>";

                foreach ($_SESSION['cart_item'] as $item) {
                    $prodictId = $item['prodictId'];
                    $productName = $item['productName'];
                    $productQuantity = $item['productQuantity'];
                    $productPrice = $item['productPrice'];
                    
                    $itemPrice = $productPrice * $productQuantity ;
                    $total_price += $itemPrice;
                    
                    ?>        

                        <li class="sbmincart-item">            
                            <div class="sbmincart-details-name">                
                                <a class="sbmincart-name" href="product-detail.php?source=<?php echo $prodictId;?>"><?php echo $productName;?></a>                
                                <ul class="sbmincart-attributes">   
                                </ul>            
                            </div>            
                                       
                            <div class="sbmincart-details-remove"></div> 
                            <div class="sbmincart-details-quantity">                
                                <a class="sbmincart-name" href="product-detail.php?source=<?php echo $prodictId;?>"><?php echo $productQuantity;?></a>
                            </div>            
                            <div class="sbmincart-details-price">                
                                <span class="sbmincart-price text-end"><i class="fa fa-rupee-sign"></i> <?php echo number_format($productPrice, 1);?></span>            
                            </div>                   
                        </li>    
                        <?php
                        }
                        ?>

                </ul>    
                    <div class="sbmincart-footer">                    
                        <div class="sbmincart-subtotal"> <i class="fa fa-rupee-sign"></i> <?php echo number_format($total_price, 1);?></div>            
                        <a class="sbmincart-submit" href="checkout.php">Check Out</a>            
                    </div> 
                <?php
            } else {
                ?>
                    <div class="sbmincart-footer">                    
                        <p class="sbmincart-empty-text">Your shopping cart is empty</p>            
                    </div>
                <?php
            }
        ?>   
        <input type="hidden" name="cmd" value="_cart">    
        <input type="hidden" name="upload" value="1">            
        <input type="hidden" name="bn" value="sbmincart_AddToCart_WPS_US">    
    </form>
</div>
