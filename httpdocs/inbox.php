<?php
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
$user_name = ''; 
$user_name = $_SESSION['username'];
echo $_SESSION['username'];
?>

<?php 

$server = "mysqldb2.ehost-services.com:3306"; 
$dbusername = "georg_testuser"; //database username 
$dbpassword = "password"; //database password 
$dbdatabase = "georgepaz_testdb"; //database name
$sqlconnect = mysql_connect($server, $dbusername, $dbpassword) or die("Couldn't connect to SQL Server on $server");
$sqldb = mysql_select_db($dbdatabase,$sqlconnect) or die("Couldn't open database $dbdatabase"); 
$result = mysql_query("SELECT *  FROM frei_chat WHERE to_name='$user_name' ORDER BY sent DESC");
?>

<?php
while($row = mysql_fetch_array($result))
{
   echo $row['message'];
   echo $row['from_name'];
   echo "</br>";
}

?>