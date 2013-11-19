<?php
	//database connection
	mysql_connect("mysqldb2.ehost-services.com:3306", "georg_testuser", "password") or die(mysql_error());
	mysql_select_db("georgepaz_testdb") or die(mysql_error());
?>