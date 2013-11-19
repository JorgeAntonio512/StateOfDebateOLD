<?php
session_start();
?>
<html>
<head>
 
</head>
<body>
<?php
if(isset($_SESSION['username']))
{
    header("Location: debatelist.php");
}
?>
<p align=center><img src="Graphics/StateOfDebate.jpg" /></a></p>

<center>
<div style="box-shadow: 0 0 5px #888; width:200px; padding: 10px; background-color: #000000;border-radius: 15px; color:#F0FFF0;">
<form action="login.php" method="post">

Username:<br />
 <input type="text" name="username"  />
<br />

Password:<br />
<input type="password" name="password"  />
<br />
<input type="submit" />
</form>
</div>

<br> Not a member yet? <a href="createuser.html">Sign up</a>
</center>
</body>

</html>