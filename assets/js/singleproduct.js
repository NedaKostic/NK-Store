$(document).ready(function(){

showItemsNumber();

//SHOW PRODUCT INFO

$("#binfo").click(function(){
    $("#breview, #bdelivery").removeClass();
    $(this).addClass("active-tab");
    $("#review, #delivery").hide();
    $("#info").show();
    })

$("#breview").click(function(){
       $("#binfo, #bdelivery").removeClass();
        $(this).addClass("active-tab");
        $("#info, #delivery").hide();
        $("#review").show();
        })

$("#bdelivery").click(function(){
    $("#binfo, #breview").removeClass();
    $(this).addClass("active-tab");
    $("#info, #review").hide();
         $("#delivery").show();
            })



//SHOW FORM FOR REVIEWS
    
    $("#show-review").click(function() {
     $(this).hide();
     $("#review-form").show();
     ;
    })
             

})


