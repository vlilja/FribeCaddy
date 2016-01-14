<?php
session_start();
echo '
<div class=col-1>
<div>
<h1>FribeCaddy</h1><br>
<p>
    Welcome to use FribeCaddy '.$_SESSION["logged_in"].'!<br>
    FribeCaddy is a free tool to use for scorekeeping on the frisbee-golf course!<br>
    Enjoy the game!
</p>
</div>
</div>
';
?>