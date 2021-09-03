$(document).ready(function(){
    showItemsNumber();
})

function showItemsNumber(){
    $.post("php/cart-php.php?number", function(response){
        let jsonResp = JSON.parse(response);
        $("#cart-items-number").text(jsonResp.pass);
    })
}