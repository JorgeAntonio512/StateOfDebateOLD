<?php
session_start();
?>

<?php 

$server = "mysqldb2.ehost-services.com:3306"; 
$dbusername = "georg_testuser"; //database username 
$dbpassword = "password"; //database password 
$dbdatabase = "georgepaz_testdb"; //database name
$sqlconnect = mysql_connect($server, $dbusername, $dbpassword) or die("Couldn't connect to SQL Server on $server");
$sqldb = mysql_select_db($dbdatabase,$sqlconnect) or die("Couldn't open database $dbdatabase"); 
$result = mysql_query("SELECT arguments.uid, arguments.aid, arguments.argument, arguments.rating, arguments.timestamp, users.username  FROM arguments LEFT JOIN users ON arguments.uid=users.uid ORDER BY timestamp DESC");
?>

<?php
while($row = mysql_fetch_array($result))
{
   echo $row['argument'];
   echo "</br>";
   echo $row['timestamp'];
   echo "</br>";
   echo "</br>";
}

?>