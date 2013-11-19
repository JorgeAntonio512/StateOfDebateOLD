<?php
/* Data base details */
$con = 'mysql'; // MySQL , Oracle , SQLite , PostgreSQL
$username='georg_testuser'; // Database username
$password='password'; //Database password
$client_db_name='georgepaz_testdb'; //Database name
$host='mysqldb2.ehost-services.com'; //host
$port='port=3306;'; //optional port for some servers using different port
$driver='Custom'; //Integration driver
$db_prefix=''; //prefix used for tables in database
$uid='515a6e55b953a'; //Any random unique number

$PATH = 'freichat/'; // Use this only if you have placed the freichat folder somewhere else
$installed=true; //make it false if you want to reinstall freichat
$admin_pswd='age12121'; //backend password 

$debug = false;

/* email plugin */
$smtp_username = '';
$smtp_password = '';

$force_load_jquery = 'NO';

/* Custom driver */
$usertable='users'; //specifies the name of the table in which your user information is stored.
$row_username='username'; //specifies the name of the field in which the user's name/display name is stored.
$row_userid='UID'; //specifies the name of the field in which the user's id is stored (usually id or userid)
$avatar_field_name = 'avatar';