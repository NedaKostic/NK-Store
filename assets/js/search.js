$(document).ready(function(){

    $("#searchBox").keyup(function(){
        var inputText= $(this).val();
        if(inputText!="")
        {
             $.post("php/search-php.php", {inputText:inputText}, function(response){
                 
                 $("#search-results").show();
                $("#search-results").html(response);
             })
        } else
        $("#search-results").hide();
    })
    
    })