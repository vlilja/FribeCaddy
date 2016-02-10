

$(document).ready(function(){
   
  
   
   if ($(window).width() < 600) {
      console.log("moi");
    $(".dropdown").addClass("gradientFill");
   $(".dropdown").css("border-bottom", "1px solid gray");
   $(".drop-nav").children().addClass("gradientFill");
   $(".drop-nav").children().css("border-bottom", "1px solid gray");
  
   $(".dropdown").click(function(){
     
      $(".drop-nav").toggle();
   });
   } 
   
   
   
   
});



