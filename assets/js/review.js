$(document).ready(function(){

    // SEND REVIEW
    
    $("#review-button").click(function(){
            let review_product_id = $("#review_product_id").attr("value");
            let review_name = $("#review_name").val();
            let review_textarea = $("#review_textarea").val();
        
            $.post("php/review-php.php?review-button", {review_product_id:review_product_id, review_name:review_name, review_textarea:review_textarea}, function(response){
        
                $("input").val("");
                $("textarea").val("");
                let reviewMessage = $("#reviewMessage");
                let jsonResp = JSON.parse(response);
        
                if(jsonResp.fail) reviewMessage.html(jsonResp.fail);
                else reviewMessage.html(jsonResp.pass);   
                
            })
    
    })


   
})