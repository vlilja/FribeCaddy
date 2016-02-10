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
                <ul id=mobilenav>
                    <li class="dropdown"><a>--Navigation--</a>
                        <ul class="drop-nav">
                            <li><a href="#/">Home</a></li>
                            <li><a href="#/laskuri">Laskuri</a></li>
                            <li><a href="#/pelaajat">Pelaajat</a></li>
                            <li><a href="#/radat">Radat</a></li>
                            <li><a href="#/myprofile">My Profile</a></li>
                            <li><a href="logout.php"><i style="color:red">Logout</i></a></li>
                        </ul>
                    </li>
                </ul>
			</div>
		</nav>
</header>
END;

?>