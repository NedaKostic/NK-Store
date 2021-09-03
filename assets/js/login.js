$(document).ready(function(){

//on load show login form hide others
$(".login-form").show();
$("#registration-form").hide();
$("#resetPassword-form").hide();


//show-hide forms on click
$("#regLink").click(function(){
  $("#registration-form").show();
  $(".login-form").hide();
  $("#resetPassword-form").hide();
})

$("#passLink").click(function(){
  $("#resetPassword-form").show();
  $("#registration-form").hide();
  $(".login-form").hide();
})

$(".loginLink").click(function(){
$(".login-form").show();
$("#registration-form").hide();
$("#resetPassword-form").hide();
})


// LOGIN

$("#login").click(function(){
    let statusMessage = $("#statusMessage");
    let username = $("#username").val();
    let password = $("#password").val();
    let remember = $('#remember').is(":checked");
    if(remember==true) remember="1";
   
    if(username!="" && password!="")
    {
         $.post("php/login-php.php?login", {username:username, password:password, remember:remember}, function(response){
            $("input").val("");
            let jsonResp = JSON.parse(response);
              if(jsonResp.fail) statusMessage.html(jsonResp.fail);
              else window.location.assign(jsonResp.redirect);
            })
    } else {
       statusMessage.html("Please fill in all the required fields.");
        $(".login-form input").each(function(){
            if($(this).val() == ""){
              this.focus();
              return false;
            }       
        })
    }
 })


//REGISTRATION
    $("#register").click(function(){
        let regStatusMessage = $("#regStatusMessage");
        let regName = $("#regName").val();
        let regLastname = $("#regLastname").val();
        let regUsername = $("#regUsername").val();
        let regEmail = $("#regEmail").val();
        let regPassword = $("#regPassword").val();
        let regRePassword = $("#regRePassword").val();
        let regPhone = $("#regPhone").val();
        let regAddress = $("#regAddress").val();
        
        if(regName!="" && regLastname!="" && regUsername!="" && regLastname!="" && regEmail!="" && regPassword!="" && regRePassword!="" && regPhone!="" && regAddress!="")
        {

            if(!(regUsername.length<6))
            {
                if(regPassword==regRePassword)
                {
                     $.post("php/login-php.php?register", {regName:regName, regLastname:regLastname, regUsername:regUsername, regEmail:regEmail, regPassword:regPassword, regRePassword:regRePassword, regPhone:regPhone, regAddress:regAddress}, function(response){
    
                     $("input").val("");
                        let regJsonResp = JSON.parse(response);
                        if(regJsonResp.fail) regStatusMessage.html(regJsonResp.fail);
                        else regStatusMessage.html(regJsonResp.pass).css({"color":"black", "font-weight":"bold"});
                     })

                } else {
                regStatusMessage.html("Passwords not matching, please try again.");
                $("#regRePassword").focus();
                }

            } else {
                regStatusMessage.html("Username must contain minimum 6 characters");
                $("#regUsername").focus();
            }

        } else {
             regStatusMessage.html("Please fill in all the required fields.");
            $("#registration-form input").each(function(){
              if($(this).val() == ""){
                this.focus();
                return false;
              }
            })
        }
})


// RESET PASSWORD

$("#resetPassword").click(function(){
  let pwdStatusMessage = $("#passMessage");
  let passEmail = $("#passEmail").val();

  if(passEmail!="")
  {
      $.post("php/login-php.php?resetPassword", {passEmail:passEmail}, function(response){

          $("input").val("");
          
          let jsonResp = JSON.parse(response);

          if(jsonResp.fail) pwdStatusMessage.html(jsonResp.fail);
          else pwdStatusMessage.html(jsonResp.pass).css({"color":"black", "font-weight":"bold"});
     })

  } else {
    pwdStatusMessage.html("Please fill in all the required fields.");
    return false;
  }

})


})