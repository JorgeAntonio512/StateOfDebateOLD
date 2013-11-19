<html>
<body>

<p align=center><img src="Graphics/BringingPeopleTogetherTopOfPage.jpg" alt="Bringing people together..."></p>
</br>
</br>
<p align=center><a href="index.html"><img src="Graphics/StateOfDebate.jpg" onmouseover="this.src='Graphics/StateOfDebateMouseOver.jpg'" onmouseout="this.src='Graphics/StateOfDebate.jpg'" /></a></p>

<?php
$server = "mysqldb2.ehost-services.com:3306"; 
$dbusername = "georg_testuser"; //database username 
$dbpassword = "password"; //database password 
$dbdatabase = "georgepaz_testdb"; //database name
$sqlconnect = mysql_connect($server, $dbusername, $dbpassword) or die("Couldn't connect to SQL Server on $server");
$sqldb = mysql_select_db($dbdatabase,$sqlconnect) or die("Couldn't open database $dbdatabase"); 

$sql = "INSERT INTO users (username,password)
VALUES
('$_POST[username]','$_POST[password]')";

if (!mysql_query($sql,$sqlconnect))
  {
  die('Error: ' . mysql_error());
  }

mysql_close($sqlconnect);

header("location: index.php");
?>

<p align=center><img src="Graphics/ByDividingThemUpBottomOfPage.jpg" alt="...by dividing them up." ALIGN=BOTTOM></p>

</body>
</html>