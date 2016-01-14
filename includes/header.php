<?php
echo <<<END
<header>
		<nav>
            <div id=logoholder>
                <a href="#/"></a>
            </div>
            <div id=navbarholder>
				<ul id=navigation-menu>
                    <li><a href="#/"><p>Home</p></a></li>
                    <li><a href="#/laskuri"><p>Laskuri</p></a></li>
                    <li><a href="#/pelaajat"><p>Pelaajat</p></a></li>
                    <li><a href="#/radat"><p>Radat</p></a></li>
                    <li><a href="#/myprofile"><p>My Profile</p></a></li>
                    <li><a href="logout.php"><p style="color:red">Logout</p></a></li> 
				</ul>
			</div>
		</nav>
</header>
END;

?>