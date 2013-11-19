<?php
//This defines an up vote
session_start();

?>

<?php
$server = "mysqldb2.ehost-services.com:3306"; 
$dbusername = "georg_testuser"; //database username 
$dbpassword = "password"; //database password 
$dbdatabase = "georgepaz_testdb"; //database name
$sqlconnect = mysql_connect($server, $dbusername, $dbpassword) or die("Couldn't connect to SQL Server on $server");
$sqldb = mysql_select_db($dbdatabase,$sqlconnect) or die("Couldn't open database $dbdatabase"); 


$sql="INSERT INTO votesdebates (UID, did, date, rating)
VALUES
('{$_SESSION['UID']}','$_GET[did]', CURDATE(), 1)";



if (!mysql_query($sql,$sqlconnect))
  {
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  die('Error: ' . mysql_error());
  }
  
  
$sql="UPDATE Debates SET rating = rating+1 WHERE did = '$_GET[did]'";

if (!mysql_query($sql,$sqlconnect))
  {
  die('Error: ' . mysql_error());
  }
  
$sql="UPDATE users SET rating = rating+1 WHERE UID = '$_GET[uid]'";

if (!mysql_query($sql,$sqlconnect))
  {
  die('Error: ' . mysql_error());
  }
  
mysql_close($sqlconnect);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>