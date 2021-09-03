$(document).ready(function(){

    //SHOW CONTENT
    
    $("#b-dashboard").click(function(){
         $(".accBtn").not(this).removeClass("active-account-tab");
         $(this).addClass("active-account-tab");
         $(".accCon").not("#dashboard-content").hide();
         $("#dashboard-content").show();
        })

    $("#b-orders").click(function(){
         $(".accBtn").not(this).removeClass("active-account-tab");
         $(this).addClass("active-account-tab");
         $(".accCon").not("#orders-content").hide(); 
        $("#orders-content").show();
            })
    
    $("#b-address").click(function(){
        $(".accBtn").not(this).removeClass("active-account-tab");
        $(this).addClass("active-account-tab");
        $(".accCon").not("#address-content").hide(); 
        $("#address-content").show();
          clearAddress();
             })
    
    $("#b-password").click(function(){
        $(".accBtn").not(this).removeClass("active-account-tab");
         $(this).addClass("active-account-tab");
         $(".accCon").not("#password-content").hide(); 
        $("#password-content").show();
        clearPassword();
    })

    $("#b-opinion").click(function(){
        $(".accBtn").not(this).removeClass("active-account-tab");
         $(this).addClass("active-account-tab");
         $(".accCon").not("#opinion-content").hide(); 
        $("#opinion-content").show();
        clearPollMess();
        showPoll();
    })

    $("#b-contact").click(function(){
        $(".accBtn").not(this).removeClass("active-account-tab");
        $(this).addClass("active-account-tab");
        $(".accCon").not("#contact-content").hide(); 
        $("#contact-content").show();
         clearContact();
        })
    


//CHANGE ADDRESS

$("#changeAddress").click(function(){

    let statusMessage = $("#changeAddressMessage");
    let deliveryAddress = $("#deliveryAddress").val();

        if(deliveryAddress!="")
        {
            $.post("php/user-php.php?changeAddress", {deliveryAddress:deliveryAddress}, function(response){

            let jsonResp = JSON.parse(response);
            if(jsonResp.fail) statusMessage.html(jsonResp.fail);
            else {
                $("input").val("");
                statusMessage.html(jsonResp.pass).css("color", "black");
            }
            })
        } else {
                statusMessage.html("Please fill in input field.");
                $("#deliveryAddress").focus();
            }
})

//CLEAR INPUT FIELD AND MESSAGE ADDRESS
function clearAddress() {
    $("input").val("");  
    $("#changeAddressMessage").html(""); 
}



 //CHANGE PASSWORD

 $("#changePassword").click(function(){

    let pwdStatusMessage = $("#changePassMessage");
    let currentPwd = $("#currentPwd").val();
    let newPwd = $("#newPwd").val();
    let confirmNewPwd = $("#confirmNewPwd").val();

        if(currentPwd!="" && newPwd!="" && confirmNewPwd!="")
        {
                    if(newPwd==confirmNewPwd)
                    {
                        $.post("php/user-php.php?changePassword", {currentPwd:currentPwd, newPwd:newPwd,confirmNewPwd:confirmNewPwd}, function(response){

                            $("input").val("");
                            let jsonResp = JSON.parse(response);
                            if(jsonResp.fail) pwdStatusMessage.html(jsonResp.fail);
                            else pwdStatusMessage.html(jsonResp.pass).css("color", "black");
                        })
                    }else {
                        pwdStatusMessage.html("Passwords not matching, please try again.");
                        $("#confirmNewPwd").focus();
                    }      
        } else {
                pwdStatusMessage.html("Please fill in all the required fields.");
                $("#password-content input").each(function(){
                    if($(this).val() == ""){
                    this.focus();
                    return false;
                    }
                })
            }  
 })

 //CLEAR INPUT FIELD AND MESSAGE PASSWORD
 function clearPassword(){
    $("input").val("");  
    $("#changePassMessage").html("");   
}




//GIVE US OPINION - SHOW POLL

function showPoll(){
    $.post("php/user-php.php?b-opinion",function(response){
        let jsonResp=JSON.parse(response);
        let opinionMess = $("#opinion-message");

      if(jsonResp.fail) 
      { 
         $("#poll").empty();
          opinionMess.html(jsonResp.fail);
       }
    })

}

//SEND THE POLL RESULTS 
$("#confirm").click(function(){

        let answer = $("input[type='radio'][name='vote']:checked").attr("id");
        let opinionMess = $("#opinion-message");

        if(answer!=""){
        $.post("php/user-php.php?confirm", {answer:answer}, function(response){
        let jsonResp=JSON.parse(response);
            
            if(jsonResp.fail) opinionMess.html(jsonResp.fail).css("color", "red");
                    else 
                    {
                        $("#poll").empty();
                        opinionMess.html(jsonResp.pass);
                    }
        })
            } else opinionMess.html("You must choose one option");
})


 //CLEAR MESSAGE POLL
function clearPollMess(){
       $("#opinion-message").empty();
}



 //SEND MESSAGE - CONTACT US

 $("#contactUs").click(function(){
   
        let contactStatusMessage = $("#contactStatusMessage");
        let contactSubject = $("#contactSubject").val(); 
        let contactMessage = $("#contactMessage").val(); 

            if(contactSubject!=""  && contactMessage!="")
            {
                 $.post("php/user-php.php?contactUs", {contactSubject:contactSubject, contactMessage:contactMessage}, function(response){
                    $("input").val("");
                    $("textarea").val("");
                    let jsonResp = JSON.parse(response);
                    if(jsonResp.fail) contactStatusMessage.html(jsonResp.fail);
                    else contactStatusMessage.html(jsonResp.pass).css({"color":"yellow", "font-weight":"bold"});
                })
            } else { contactStatusMessage.html("Please fill in all the required fields.");
                     $("#contact-content input, #contact-content textarea").each(function(){
                     if($(this).val() == ""){
                     this.focus();
                     return false;
                     }
                    })
            }
                
                })


                
//CLEAR CONTACT FIELDS
    function clearContact(){
     $("input").val("");  
    $("#contactMessage").val("");  
    $("#contactStatusMessage").html(""); 
    }              

})




    