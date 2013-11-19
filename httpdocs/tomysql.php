<?php 

if (isset($_GET['c'])) 
{ 
    $con = mysql_connect('mysqldb2.ehost-services.com:3306', 'georg_testuser', 'password'); 


    mysql_select_db('georgepaz_testdb', $con); 


    $sql = "INSERT INTO teste (content) VALUES ('". $_GET['c']. "')"; 

    $query = mysql_query($sql, $con); 
    if($query) { 
         echo("ok"); 
    } else { 
         echo("nicht ok"); 
    } 

    mysql_close($con); 
} 
?>