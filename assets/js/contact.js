$(document).ready(function(){

    // CONTACT SECTION 
    
    $("#contact-btn").click(function(){
        let name = $("#name").val();
        let email = $("#email").val();
        let subject = $("#subject").val(); 
        let message = $("#message").val(); 
    
        $.post("php/contact-php.php", {name:name, email:email, subject:subject, message:message}, function(response){
    
            $("input").val("");
            $("textarea").val("");
            let statusMessage = $("#statusMessage");
            let jsonResp = JSON.parse(response);

            
            if(jsonResp.fail) statusMessage.html(jsonResp.fail).css("color", "red");
            else 
            {
                statusMessage.html(jsonResp.pass).css({"color":"yellow", "font-weight":"bold"});
            }
        })
    
    })

})