$(document).ready(function(){ 
 
//BACK TO TOP BUTTON
$(window).scroll(function() {
 //Check to see if the window is top if not then display button
    if ($(this).scrollTop()>200) 
        $("#onTop").fadeIn(500);
    else 
      $("#onTop").fadeOut(500);
      
  //Click event to scroll to top
  $("#onTop").click(function(){
  $("html, body").stop().animate({scrollTop: 0}, 500);
  })

})
})

//PRELOADER
$(window).on('load', function(){
  $('.preloader').fadeOut(500); 
});



    










