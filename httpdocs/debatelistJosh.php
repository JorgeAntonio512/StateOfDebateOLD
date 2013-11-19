<?php
session_start();

if(!isset($_SESSION['UID']))
{
    header("Location: index.php");
}

$server = "mysqldb2.ehost-services.com:3306"; 
$dbusername = "georg_testuser"; //database username 
$dbpassword = "password"; //database password 
$dbdatabase = "georgepaz_testdb"; //database name
$sqlconnect = mysql_connect($server, $dbusername, $dbpassword) or die("Couldn't connect to SQL Server on $server");
$sqldb = mysql_select_db($dbdatabase,$sqlconnect) or die("Couldn't open database $dbdatabase"); 
$result = mysql_query("SELECT debates.uid, debates.did, debates.debatetitle, debates.rating, debates.timestamp, users.username  FROM debates LEFT JOIN users ON debates.uid=users.uid ORDER BY rating DESC");
?>

<!DOCTYPE html>
<html>
  <head>



<!--===========================FreiChatX=======START=========================-->
<!--	For uninstalling ME , first remove/comment all FreiChatX related code i.e below code
	 Then remove FreiChatX tables frei_session & frei_chat if necessary
         The best/recommended way is using the module for installation                         -->

<?php
$ses=null;


if(isset($_SESSION['UID']))
{ 
  if($_SESSION['UID'] != null) // Here null is guest 
  { 
   $ses=$_SESSION['UID']; //LOOK, now userid will be passed to FreiChat 
  } 
}




if(!function_exists("freichatx_get_hash")){
function freichatx_get_hash($ses){

       if(is_file("/var/www/vhosts/stateofdebate.com/httpdocs/freichat/hardcode.php")){

               require "/var/www/vhosts/stateofdebate.com/httpdocs/freichat/hardcode.php";

               $temp_id =  $ses . $uid;

               return md5($temp_id);

       }
       else
       {
               echo "<script>alert('module freichatx says: hardcode.php file not
found!');</script>";
       }

       return 0;
}
}
?>
                        <script type="text/javascript" language="javascipt"src="http://stateofdebate.com/freichat/client/main.php?id=<?php echo $ses;?>&xhash=<?php echo freichatx_get_hash($ses); ?>"></script>                        
	<link rel="stylesheet" href="http://stateofdebate.com/freichat/client/jquery/freichat_themes/freichatcss.php" type="text/css">
<!--===========================FreiChatX=======END=========================-->   





  <link href="css/styles.css" rel="stylesheet" type="text/css" media="screen" />
	<style type="text/css">
	#content {
        background-color:#FFFFF0;
		padding: 10px;
    }
	</style>
	<style type="text/css"> 
	
	 
	 #navbar ul { 
		padding:5px;
		list-style-type: none; 
		text-align: center; 
		background-color: #000;
		background-image:url('../Graphics/gradient.png');
		box-shadow: 0 0 5px #888;
		margin: 0 auto;
		border-bottom-right-radius: 50px;
		border-bottom-left-radius: 50px;

		margin:auto;
		} 
	 
	#navbar ul li {  
		padding:5px;
		display: inline; 
		} 
	 
	#navbar ul li a { 
		padding:5px;
		text-decoration: none; 
		color: #fff; 
		background-color: #000; 
		
		border-radius: 15px;
		} 
	 
	#navbar ul li a:hover { 
		border-radius: 15px;
		padding:5px;
		color: #000; 
		background-color: #fff;
		box-shadow: inset 0px 0px 10px 0px #000000;
		} 
	 
	
	</style>
    <title>State of Debate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  </head>
  <body>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script> 
		<div id="navbar"> 
		<div style="position:fixed; z-index:1;" />
		  <ul> 
		<li><a href="http://stateofdebate.com/debatelist.php">Home</a></li>
		<li><a href="blankdebate.html">Create a Debate</a></li> 
		<li><a href="profile.php?username=<?php echo $_SESSION['username']?>">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
		  </ul> 
		  
		</div> 
	  <div>
		<div>
		  <div style="padding: 50px 10px;">
		  
				<div class="row">
					<div class="span4">
					<?php
						while($row = mysql_fetch_array($result))
						{
					?>
					<div id="content" style="box-shadow: 0 0 5px #888;border-radius: 15px;">
						<div>
							<a href="updebate.php?did=<?PHP echo $row['did']?>&uid=<?PHP echo $row['uid']?>">&#x25B2;</a>
							<?php echo $row['rating']; ?>
							<a href="downdebate.php?did=<?PHP echo $row['did']?>&uid=<?PHP echo $row['uid']?>">&#x25BC;</a>
							<br>
							<?php echo "<a href='/debatepage.php?did=" . $row['did'] . " '>" . $row['debatetitle'] . "</a></br>"; ?>
							<?php echo "Creator: <a href='/profile.php?username=" .$row['username']."'>".$row['username'];?></a>
<br>

						</div>
					</div>
					<br>
					<?php
						}
					?>
					</div>
					<div class="span3" style="padding: 10px;">
						<div style="position:fixed; margin-left: auto;margin-right: auto;">
                                 <div style="text-align:center"><a href="profile.php?username=<?php echo $_SESSION['username'];?>">[ stateOfDebate <?php echo $_SESSION['username']?> ] </a></div>
							<br>
							<div>
							<table class="table table-hover">
							<p>Text</p>
							<tr><th>Top Rated Users</th><th>Rating</th></tr>
								<?php
								$order = "SELECT * FROM users ORDER BY rating DESC";
								//order to search data
								//declare in the order variable
												
								$result = mysql_query($order);	
								//order executes the result is saved
								//in the variable of $result
												
								while($data = mysql_fetch_row($result)){
								  echo("<tr><td>$data[3]</td><td>$data[2]</td></tr>");
								}
								?>
							</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	  </div>
  </body>
</html>

<?php
mysql_close($sqlconnect);
?>