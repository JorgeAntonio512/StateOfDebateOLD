<?php
$localhost = "mysqldb2.ehost-services.com:3306";
$mysqlusername  = "georg_testuser";
$mysqlpassword  = "password";
$db = "georgepaz_testdb";
$con = mysql_connect($localhost, $mysqlusername, $mysqlpassword);
mysql_select_db("$db", $con);
?> 