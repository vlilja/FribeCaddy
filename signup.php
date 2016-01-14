<!DOCTYPE html>
    <html>
    <?php
        session_start();
        include ("includes/head.php");
        include ('scripts/validateUserCreation.php');
         ?>
<body>
<?php echo <<<END

<header>
		<nav>
				<div id=logoholder>
					<a href="#/"></a>
				</div>
				<div id=navbarholder>
					<ul id=navigation-menu>    
						<li><a href="login.php"><p>Back To Login</p></a></li>
					</ul>
				</div>
		
		</nav>
</header>
END;
if(!isset($_SESSION["r1"])){
        $_SESSION["r1"]=rand(0,9);
        $_SESSION["r2"]=rand(0,9);
    }
    $_SESSION["r3"]=$_SESSION["r1"] + $_SESSION["r2"] + 2;
    $array = ["yksi", "kaksi", "kolme", "neljä", "viisi", "kuusi", "seitsemän", "kahdeksan", "yhdeksän", "kymmenen"];

?>    
        <div class=content>
            <div class=login>
                <form class=usercreation method=POST>
                    <label>Enter username</label>
                    <input type=text name=username></tr><br>
                    <label>Enter password</label>
                    <input type=password name=password><br>
                    <label>Validate password</label>
                    <input type=password name=password2><br>
                    <label>Enter you email</label>
                    <input type=email name=email><br><br><br>
                    <label><?php echo'Oletko botti? Paljonko on '. $array[$_SESSION["r1"]] ."+" . $array[$_SESSION["r2"]]."?&nbsp";?></label><br>
                    <input type="number" name="botti"><br><br><br>
                    <button class="genbtn" type=submit>Create User</button>
                </form>
            </div>
                <?php if(isset($message)){
                        echo "<p>$message</p>";
                        }   
                ?>
        </div>
        
        

        
<?php include ("includes/footer.php"); ?>        
</body>
</html>
        
   