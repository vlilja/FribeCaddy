<!DOCTYPE HTML>
    
<?php
session_start();
     

    if(!isset($_SESSION["logged_in"])){
    header("Location:login.php");
    }
?>
    <html lang="en-us" data-ng-app="fribeCaddy">
    <?php set_include_path('includes/');
        include ("head.php");
    
    ?>
    <body>
    <div class=pageWrap>
    <?php include ("header.php"); ?>
        
        <div class="content" data-ng-view>
            
            
        </div>
        
        
        
        
   
    </div>
     <?php include ("footer.php"); ?>
    </body>
    
</html>