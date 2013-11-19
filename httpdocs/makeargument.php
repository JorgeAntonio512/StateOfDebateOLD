<?php

session_start();

?>
<?php

echo $_POST["did"];
echo $_POST["argumentb"];

$server = "mysqldb2.ehost-services.com:3306"; 
$dbusername = "georg_testuser"; //database username 
$dbpassword = "password"; //database password 
$dbdatabase = "georgepaz_testdb"; //database name
$sqlconnect = mysql_connect($server, $dbusername, $dbpassword) or die("Couldn't connect to SQL Server on $server");
$sqldb = mysql_select_db($dbdatabase,$sqlconnect) or die("Couldn't open database $dbdatabase"); 


if(empty( $_POST["argumenta"])){
$sql = "INSERT INTO arguments (did, uid, side,argument,timestamp)
VALUES
('$_POST[did]','{$_SESSION['UID']}',1,'$_POST[argumentb]',NOW())";
}



if(empty( $_POST["argumentb"])){
$sql = "INSERT INTO arguments (did,uid,side,argument,timestamp)
VALUES
('$_POST[did]','{$_SESSION['UID']}',0,'$_POST[argumenta]', NOW())";
}

if (!mysql_query($sql,$sqlconnect))
  {
  die('Error: ' . mysql_error());
  }


mysql_close($sqlconnect);

header("location: debatepage.php?did=".$_POST["did"]);

?>