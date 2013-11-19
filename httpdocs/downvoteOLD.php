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


$sql="INSERT INTO Votes (UID, aid, did, date, rating)
VALUES
('{$_SESSION['UID']}', '$_GET[aid]', '$_GET[did]', CURDATE(), -1)";

?>
<?PHP
$query = "SELECT did, SUM(rating) FROM Votes WHERE did = '$_GET[did]' GROUP BY did"; 

$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
    $did = $row['did'];
    $ratingsum = $row['SUM(rating)'];
    }

 mysql_query("UPDATE Debates SET rating = $ratingsum
WHERE did = '$did'");
?>

<?PHP
$query = "SELECT aid, SUM(rating) FROM Votes WHERE aid = '$_GET[aid]' GROUP BY aid"; 

$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result))
    {
    $aid = $row['aid'];
    $ratingsum = $row['SUM(rating)'];
    }

 mysql_query("UPDATE Arguments SET rating = $ratingsum
WHERE aid = '$aid'");
?>

<?PHP
$query = "SELECT uid, SUM(rating) FROM arguments WHERE uid = '$_GET[uid]' GROUP BY uid"; 

$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result))
    {
    $uid = $row['uid'];
    $ratingsum = $row['SUM(rating)'];
    }

 mysql_query("UPDATE users SET rating = $ratingsum
WHERE uid = '$uid'");
?>

<?PHP
$query = "SELECT uid, SUM(rating) FROM Debates WHERE uid = '$_GET[uid]' GROUP BY uid"; 

$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result))
    {
    $uid = $row['uid'];
    $ratingsum = $row['SUM(rating)'];
    }

 mysql_query("UPDATE users SET rating = $ratingsum
WHERE uid = '$uid'");


if (!mysql_query($sql,$sqlconnect))
  {
  die('Error: ' . mysql_error());
  }

mysql_close($sqlconnect);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>