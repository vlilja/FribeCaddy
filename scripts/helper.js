

$(document).ready(function(){
   
  
   
   if ($(window).width() < 750) {
   $(".dropdown").addClass("gradientFill");
   $(".dropdown").css("border-bottom", "1px solid gray");
   $(".drop-nav").children().addClass("gradientFill");
   $(".drop-nav").children().css("border-bottom", "1px solid gray");
  
   $(".dropdown").click(function(){
     
      $(".drop-nav").toggle();
   });
   
   
   
   } 
   
   
   
   
});



