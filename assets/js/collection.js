// JavaScript choose collection
let ss = document.querySelector('#ss');
let aw = document.querySelector('#aw');

function showSS() {
    ss.style.display = 'block';
    aw.style.display = 'none';
}

function showAW() {
    ss.style.display = 'none';
    aw.style.display = 'block';
}



$(document).ready(function(){
//add active class for tab buttons

$("#tab1").click(function() {
    $("#tab2").removeClass();
     $("#tab1").addClass("active-tab");
 });

 $("#tab2").click(function() {
    $("#tab1").removeClass();
     $("#tab2").addClass("active-tab");
 });


//image opacity 

    $(".items>img").mouseenter(function(){
        $(this).css("opacity", "0.9");
     })

    $(".items>img").mouseout(function(){ 
        $(this).css("opacity", "1");
   
    })
});








   
//modal
        
// Get the modal
let modal = document.getElementById('myModal');

// Get the image and insert it inside the modal 
let img = $('.myImg');
let modalImg = $("#img01");
let captionText = document.getElementById("caption");
$('.myImg').click(function(){
    modal.style.display = "block";
    var newSrc = this.src;
    modalImg.attr('src', newSrc);
});

//  close the modal
// modal.click = function() {
$(modal).click(function(){
  modal.style.display = "none";
})



