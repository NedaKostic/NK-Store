$(document).ready(function(){
    showItemsNumber();   //number of items in basket
    showSizes();         //get available sizes and qty
    
    
//to get all available sizes 
    function showSizes(){

       let size_product_id = $("#size_product_id").attr("value");

         $.post("php/sizeQty-php.php", {size_product_id:size_product_id}, function(response){
        let jsonResp=JSON.parse(response);

            for(element of jsonResp.data){
            $("#choose-size").append("<option value='"+element.size_id+"' data-qty='"+element.quantity+"'>" +element.size_name+"<br></option>");   
            } 
   
//based on choosen size show qty

        $("#choose-size").change(function(){

            clearQty();   //to not add new content after every change
 
                let maxSelected = $(this).find(':selected').attr('data-qty');
  
                for(let qty=1;qty<=maxSelected;qty++) 
        
                $("#choose-qty").append("<option value='"+qty+"'>"+qty+"<br></option>"); 
        
            })
        
        }) 
}


//clear qty
function clearQty(){
    $("#choose-qty option:not(:first)").remove();  
}

//clear size
function clearSizes(){
    $("#choose-size option:not(:first)").remove();  
}



//add to cart

$("#add-to-cart").click(function(){
    let product_id =  $("#size_product_id").attr("value");
    let selectedSize = $("#choose-size").val();
    let selectedQty = $("#choose-qty").val();
    let cartMessage = $("#cartMessage");
   
    if(product_id!=0 && selectedSize!=0 && selectedQty!=0)
    {
        $.post("php/cart-php.php?add-to-cart", {product_id: product_id, selectedSize:selectedSize, selectedQty:selectedQty}, function(response){

            let jsonResp = JSON.parse(response);

            if(jsonResp.fail) cartMessage.html(jsonResp.fail);
            else 
            {
                showItemsNumber();
                clearSizes();
                clearQty();
                showSizes();
                cartMessage.html(jsonResp.pass);
            } 
        })
    } else cartMessage.html("You must choose size and quantity!");

})


})