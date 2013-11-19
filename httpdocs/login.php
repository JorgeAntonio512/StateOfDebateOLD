<?php
session_start();

$server = "mysqldb2.ehost-services.com:3306"; 
$dbusername = "georg_testuser"; //database username 
$dbpassword = "password"; //database password 
$dbdatabase = "georgepaz_testdb"; //database name
$sqlconnect = mysql_connect($server, $dbusername, $dbpassword) or die("Couldn't connect to SQL Server on $server");
$sqldb = mysql_select_db($dbdatabase,$sqlconnect) or die("Couldn't open database $dbdatabase"); 

$username = mysql_real_escape_string($_POST[username]); 
$password = mysql_real_escape_string($_POST[password]); 


$queryZ = 'SELECT username,UID  FROM users WHERE username = "'.$username.'"  AND password = "'.$password.'"';

$result = mysql_query($queryZ);

while($row = mysql_fetch_array($result))
  {
         $sessionID = $row['UID'];
         $sessionName = $row['username'];
         // store session data
         
  }
$_SESSION['UID'] = $sessionID;         
$_SESSION['username'] = $sessionName;

echo $_SESSION['UID'];
echo $_SESSION['username'];


mysql_close($sqlconnect);

echo session_id();
header("location: debatelist.php");
?>