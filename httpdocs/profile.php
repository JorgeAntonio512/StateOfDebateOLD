<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<title>State of Debate</title> 
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
<div style="position:fixed; left:0px; top:0px z-index:1;" />
  <ul> 
<li><a href="http://stateofdebate.com/debatelist.php">Home</a></li>
<li><a href="createuser.html">Sign Up</a></li>
<li><a href="login.html">Login</a></li>
<li><a href="logout.php">Logout</a></li>
<li><a href="blankdebate.html">Create a Debate</a></li>
<li><a href="sendpm.php">Send a private message</a></li>
<li><a href="inbox.php">Inbox</a></li> 
<li><a href="profile.php">Profile</a></li>
  </ul> 
</div> 
</body> 
</html>

<html>

<center>
</br>
</br>
</br>
</br>
<?php

//if(!isset($_SESSION)){session_start();}
session_start();

echo $_GET['username'];
echo "'s Profile";
?>
</center>
<center>
<?php
$server = "mysqldb2.ehost-services.com:3306"; 
$dbusername = "georg_testuser"; //database username 
$dbpassword = "password"; //database password 
$dbdatabase = "georgepaz_testdb"; //database name
$sqlconnect = mysql_connect($server, $dbusername, $dbpassword) or die("Couldn't connect to SQL Server on $server");
$sqldb = mysql_select_db($dbdatabase,$sqlconnect) or die("Couldn't open database $dbdatabase"); 

$query1 = mysql_query("SELECT * FROM users WHERE username='$_GET[username]'");
					while($row = mysql_fetch_array($query1))
{
echo '<img class="userImage" src="'.$row['imagelocation'].'" height="100" width="100" alt=" />';
}
?>



</center>


<table align="center">
<tr>
    <td>
      <table border="1">
      <tr>
        <td><?php echo $_GET['username']?>'s rating is:</td>
      

<?PHP



$order = "SELECT * FROM users WHERE username = '$_GET[username]'";
//order to search data
//declare in the order variable
				
$result = mysql_query($order);	
//order executes the result is saved
//in the variable of $result
				
while($data = mysql_fetch_row($result)){
  echo("<td>$data[2]</td></tr>");
}


?>
    </table>
  </td>
</tr>
</table>
<a href="addtotribe.php?username=<?php echo $_GET['username']?>">
<img src="Graphics/PlusSign.png" height="50" width="50" title="click here to add this user to your tribe!" />
</a>

<center><a href="yourtribe.php?username=<?php echo $_GET['username']?>"><?php echo $_GET['username']?>'s Tribe</a></center>
</br>
</br>






<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Rabbit Hole</title>
<link rel="stylesheet" type="text/css" media="all" href="styles.css" />
</head>
<body>

<h1 >Upload your profile picture here. Formats accepted are .jpg, .jpeg, .gif, .jfif, .bmp, and .png. Drag or select your file, and then reload the page.</h1>

<div style="float:left; width:66%;">
<form id="upload" action="upload.php" method="POST" enctype="multipart/form-data">

<div id="myfieldset">
<legend>Send File down the Rabbit hole...</legend>

<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="64000000" />

<div>
	<!--<label for="fileselect">Files to upload:</label>-->
	<input type="file" id="fileselect" name="fileselect[]" multiple="multiple" />
	<div id="filedrag">drop files here</div>
</div>

<div id="submitbutton">
	<button type="submit">Upload Files</button>
</div>

</div>

</form>

<div id="progress"></div>

<div id="messages">
<p>Status Messages</p>
</div>
</div>

<script src="filedrag.js"></script>
<div id="dirlist" style="margin-left:66%; width:33%;padding:20px;">
<?php
$files = scandir('uploads/');
foreach($files as $file) {
  echo '<a href="uploads/'.$file.'">'.$file.'</a>';
  echo "<br>";





mysql_close($sqlconnect);
}
?>
</div>
</body>
</html>










</br>
</br>
</html>