<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<title>Horizontal Navigation Bar w/Rollover Effect</title> 
<style type="text/css"> 
<!-- 
 
 #navbar ul { 
	margin: 0; 
	padding: 5px; 
	list-style-type: none; 
	text-align: center; 
	background-color: #000; 
	} 
 
#navbar ul li {  
	display: inline; 
	} 
 
#navbar ul li a { 
	text-decoration: none; 
	padding: .2em 1em; 
	color: #fff; 
	background-color: #000; 
	} 
 
#navbar ul li a:hover { 
	color: #000; 
	background-color: #fff; 
	} 
 
--> 
</style> 
</head> 
<body> 
<div id="navbar"> 
  <ul> 
<li><a href="http://stateofdebate.com/debatelist.php">Home</a></li>
<li><a href="createuser.html">Sign Up</a></li>
<li><a href="login.html">Login</a></li>
<li><a href="logout.php">Logout</a></li>
<li><a href="blankdebate.html">Create a Debate</a></li>
<li><a href="sendpm.php">Send a private message</a></li>
<li><a href="inbox.php">Inbox</a></li> 
  </ul> 
</div> 
</body> 
</html>




<?php    
session_start();
require("config.php");

$message = $_POST['forward2'];
 if (isset($_POST['submit']))
{
// if the form has been submitted, this inserts it into the Database 
  $to_user = $_POST['to_user'];
  $from_user = $_POST['from_user'];
  $message = $_POST['message'];
  mysql_query("INSERT INTO messages (to_user, message, from_user) VALUES ('$to_user', '$message', '$from_user')")or die(mysql_error());
  echo "PM succesfully sent!"; 
}
else
{
    // if the form has not been submitted, this will show the form
?>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
<table border="0">
<tr><td colspan=2><h3>Send PM:</h3></td></tr>
<tr><td></td><td>
<input type="hidden" name="from_user" maxlength="32" value = <?php echo $_SESSION['username']; ?>>
</td></tr>
<tr><td>To User: </td><td>
<input type="text" name="to_user" maxlength="32" value = "">
</td></tr>
<tr><td>Message: </td><td>
<TEXTAREA NAME="message" COLS=50 ROWS=10 WRAP=SOFT></TEXTAREA>
</td></tr>
<tr><td colspan="2" align="right">
<input type="submit" name="submit" value="Send Message">
</td></tr>
</table>
</form>
<?php
}
?>