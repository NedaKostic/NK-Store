$(document).ready(function(){
    clearCart();
    showCart();
    totalPrice();
    showItemsNumber();
})  

//show products in the cart
function showCart(){

        $.post("php/cart-php.php?cart", function(response){
                    let jsonResp=JSON.parse(response);
                    let cartMessage = $("#cart-message");
                
                    if(jsonResp.data!=""){
                        $("#cart").append("<table id='cart-table'><thead><tr><th>Product Name</th><th class='cart-img'>Product image</th><th>Color</th><th>Size</th><th>Qty</th><th>Price per item</th><th>Total price</th><th>Remove</th></tr></thead>");

                        for(element of jsonResp.data)  
                        $("#cart-table").append("<tbody><tr><td>"+element.product_name+"</td><td class='cart-img'><img src='assets/images/products/"+element.product_image_name+"'></td><td>"+element.product_color+"</td><td>"+element.size_name+"</td><td data-cartQty='"+element.cart_quantity+"'>"+element.cart_quantity+"</td><td>&euro; "+element.product_price_per_item+"</td><td class='row-total' data-rowtotal="+element.product_price_per_item * element.cart_quantity+">&euro; "+element.product_price_per_item * element.cart_quantity+"</td><td><button class='b-remove' id='"+element.product_id+"' data-cartSize='"+element.size_id+"' data-cartQty='"+element.cart_quantity+"'><i class='fas fa-trash cart-trash'></i></button></td></tr></tbody></table>"); 
                        
                        $("#cart-bottom").append("<br><br><div class='total-price'></div><br><button id='buy'>BUY PRODUCTS</button><div id='cart-status'></div>");

                        showItemsNumber();
                        totalPrice(); 
                    } else {
                        cartMessage.html("No items in the cart!");
                        $(".total-price, #buy, #cart-status").remove();
                    }
        })
    
}


//to calculate total price of all added products in cart
function totalPrice(){
   let sum = 0;
    $(".row-total").each(function(){
        sum += $(this).data('rowtotal');
        $(".total-price").html("TOTAL PRICE: &euro; " +sum);
    })
}



//clear cart and messages

function clearCart(){
    $("#cart-table").remove();  
    $(".total-price, #buy, #cart-status").remove();
}




//delete each product from cart

    $(document).on('click','.b-remove', function(){

        let cartStatus = $("#cart-status");
        let id = $(this).attr("id");   
        let size = $(this).attr("data-cartSize"); 
        let qty = $(this).attr("data-cartQty"); 

            $.post("php/cart-php.php?remove-item", {id:id, size:size, qty:qty}, function(response){
                let jsonResp = JSON.parse(response);
                
                    if(jsonResp.fail) cartStatus.html(jsonResp.fail);
                    else cartStatus.html(jsonResp.pass);
                    
                    $("#cart-table").remove();  
                    $(".total-price, #buy").remove();  
                    showCart();
                    totalPrice(); 
                    showItemsNumber(); 
            })   
    })


//buy all from cart

$(document).on('click','#buy',function(){
    
            let cartMess= $("#cart-message");
            
            $.post("php/cart-php.php?buy", function(response){
            let jsonResp = JSON.parse(response);
        
                if(jsonResp.fail) cartMess.html(jsonResp.fail);
                else {
                    cartMess.html(jsonResp.pass);
                    clearCart();     
					showItemsNumber(); 
                }
            })
})

