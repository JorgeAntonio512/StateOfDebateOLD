<html>
<body>
<?php 

 session_start(); 
 
 ?>

<p align=center><img src="Graphics/BringingPeopleTogetherTopOfPage.jpg" alt="Bringing people together..."></p>
</br>
</br>
<p align=center><a href="index.html"><img src="Graphics/StateOfDebate.jpg" onmouseover="this.src='Graphics/StateOfDebateMouseOver.jpg'" onmouseout="this.src='Graphics/StateOfDebate.jpg'" /></a></p>

<?php echo $_POST["debatetitle"]; ?>
<br /><br />
<?php echo $_POST["debate"]; ?>
<br /><br />
<?php echo $_POST["sidea"]; ?>
<br /><br />
<?php echo $_POST["sideb"]; ?>    
<br /><br />
<?php echo $_POST["description"]; ?>


<?php
$server = "mysqldb2.ehost-services.com:3306"; 
$dbusername = "georg_testuser"; //database username 
$dbpassword = "password"; //database password 
$dbdatabase = "georgepaz_testdb"; //database name
$sqlconnect = mysql_connect($server, $dbusername, $dbpassword) or die("Couldn't connect to SQL Server on $server");
$sqldb = mysql_select_db($dbdatabase,$sqlconnect) or die("Couldn't open database $dbdatabase"); 

$sql = "INSERT INTO Debates (UID, debatetitle,debate,sidea,sideb,timestamp,description)
VALUES
('{$_SESSION['UID']}','$_POST[debatetitle]','$_POST[debate]','$_POST[sidea]','$_POST[sideb]',NOW(),'$_POST[description]')";

if (!mysql_query($sql,$sqlconnect))
  {
  die('Error: ' . mysql_error());
  }

$id = mysql_insert_id();

mysql_close($sqlconnect);

header("location: debatepage.php?did=".$id);
?>

<p align=center><img src="Graphics/ByDividingThemUpBottomOfPage.jpg" alt="...by dividing them up." ALIGN=BOTTOM></p>

</body>
</html>