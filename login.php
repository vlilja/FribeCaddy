<!DOCTYPE html>
    <html>
    <?php
	
		
	
	
        include ("includes/head.php"); 
        require_once('scripts/validateLogon.php'); ?>
<body>
<div class=pageWrap>
<?php echo <<<END
<header>
		<nav>
				<div id=logoholder>
					<a href="#/"></a>
				</div>
				<div id=navbarholder>
					<ul id=navigation-menu>    
						<li><a href="signup.php"><p>Sign-Up</p></a></li>
					</ul>
				</div>
		</nav>
</header>

END;
?>
<div class=content>
	
    <div class=login>
        <form method=POST>
            <label>Username</label>
            <input type=text name=username><br><br>
            <label>Password&nbsp</label>
            <input type=password name=password><br><br>        
            <button class="genbtn loginbtn" type=submit>Login</button>        
        </form>
    </div>
	
</div>



</div>
<?php include ("includes/footer.php"); ?>
</body>
</html>