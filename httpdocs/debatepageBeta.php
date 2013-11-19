<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
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






<title>State of Debate</title> 
<style type="text/css"> 
<!-- 
 
 #navbar ul { 
	margin: 0; 
	padding: 5px; 
	list-style-type: none; 
	text-align: center; 
	background-color: #000; 
	} 
 
#navbar ul li {  
	display: inline; 
	} 
 
#navbar ul li a { 
	text-decoration: none; 
	padding: .2em 1em; 
	color: #fff; 
	background-color: #000; 
	} 
 
#navbar ul li a:hover { 
	color: #000; 
	background-color: #fff; 
	} 
 
--> 
</style> 
</head> 
<body> 
<div id="navbar"> 
<div style="position:fixed; left:0px; top:0px z-index:1;" />
  <ul> 
<li><a href="http://stateofdebate.com/debatelist.php">Home</a></li>
<li><a href="createuser.html">Sign Up</a></li>
<li><a href="login.html">Login</a></li>
<li><a href="logout.php">Logout</a></li>
<li><a href="blankdebate.html">Create a Debate</a></li>
<li><a href="sendpm.php">Send a private message</a></li>
<li><a href="inbox.php">Inbox</a></li> 
  </ul> 
</div> 
</body> 
</html>



<?php

session_start();

?>


<html>

</br>
</br>

<p align=center><img src="Graphics/BringingPeopleTogetherTopOfPage.jpg" alt="Bringing people together..."></p>
</br>
</br>



<head>
    <title>Debate Page</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

</head>

<body>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>

<?php
$server = "mysqldb2.ehost-services.com:3306"; 
$dbusername = "georg_testuser"; //database username 
$dbpassword = "password"; //database password 
$dbdatabase = "georgepaz_testdb"; //database name
$sqlconnect = mysql_connect($server, $dbusername, $dbpassword) or die("Couldn't connect to SQL Server on $server");
$sqldb = mysql_select_db($dbdatabase,$sqlconnect) or die("Couldn't open database $dbdatabase"); 
?>

<div class="row-fluid">
  <div class="span12">

<table class="table table-bordered">
<?php
$result = mysql_query("SELECT *  FROM debates WHERE did = '$_GET[did]'");
while($row = mysql_fetch_array($result))
  {
  echo "<tr><td>". $row['debatetitle']."</tr></td>";
  echo "<tr><td>".$row['debate']."</tr></td>";
  }

?>
</table>

    <div class="row-fluid">
      <div class="span6">

<table class="table table-hover">

<?php
$result = mysql_query("SELECT sidea  FROM debates WHERE did = '$_GET[did]'");
while($row = mysql_fetch_array($result))
  {
  echo "<tr><td>". $row['sidea']."</tr></td>";
  }
?>


<tr><td>

<form action="makeargument.php" method="post">
  <fieldset>
   <textarea rows="3" input type="text" name="argumenta" placeholder="Make an argument"  /></textarea>
     <button name="did" value="<?php echo $_GET["did"]; ?>" type="submit" class="btn">Argue</button>
  </fieldset>
</form>

</tr></td>



<?php
$result = mysql_query("SELECT arguments.uid, arguments.aid, arguments.argument, arguments.rating, users.username  FROM arguments LEFT JOIN users ON arguments.uid=users.uid WHERE did = '$_GET[did]' AND side = 0 ORDER BY rating DESC");
while($row = mysql_fetch_array($result))
  {
  echo "<tr><td>" . $row['argument']
?>



<a href="upvote.php?aid=<?PHP echo $row['aid']?>&did=<?PHP echo $_GET[did]?>&uid=<?PHP echo $row['uid']?>"; a style="float: right">&#x25B2;</a>

<div style="float: right">
<?php
echo $row['rating'];
 ?>
</div>

<a href="downvote.php?aid=<?PHP echo $row['aid']?>&did=<?PHP echo $_GET[did]?>&uid=<?PHP echo $row['uid']?>"; a style="float: right">&#x25BC;</a>



<?php

echo "<pre>CREATED BY: <a href='/profile.php?username=" .$row['username']."'>".$row['username']." </pre>";
 ?>
</tr></td>


<?php
echo"</td>";
  }
?>











</table>
      </div>
      <div class="span6">
<table class="table table-hover">

<?php
$result = mysql_query("SELECT *  FROM debates WHERE did = '$_GET[did]'");
while($row = mysql_fetch_array($result))
  {
  echo "<tr><td>". $row['sideb']."</tr></td>";
  }
?>

<tr><td>
<form action="makeargument.php" method="post">
  <fieldset>
   <textarea rows="3" input type="text" name="argumentb" placeholder="Make an argument"  /></textarea>
     <button name="did" value="<?php echo $_GET["did"]; ?>" type="submit" class="btn">Argue</button>
  </fieldset>
</form>
</tr></td>

<?php
$result = mysql_query("SELECT arguments.uid, arguments.aid, arguments.argument, arguments.rating, users.username  FROM arguments LEFT JOIN users ON arguments.uid=users.uid WHERE did = '$_GET[did]' AND side = 1 ORDER BY rating DESC");
while($row = mysql_fetch_array($result))
  {
  echo "<tr><td>"
?>






<a href="upvote.php?aid=<?PHP echo $row['aid']?>&did=<?PHP echo $_GET[did]?>&uid=<?PHP echo $row['uid']?>">&#x25B2;</a>


<?php
echo $row['rating'];
 ?>

<a href="downvote.php?aid=<?PHP echo $row['aid']?>&did=<?PHP echo $_GET[did]?>&uid=<?PHP echo $row['uid']?>">&#x25BC;</a>


<?php 
echo $row['argument'];
?>
</br>
<?php
echo "<pre>CREATED BY: <a href='/profile.php?username=" .$row['username']."'>".$row['username']." </pre>";
 ?>
</td></tr>







<?php
echo "</td>";
  }
?>

</table>
      </div>
    </div>

  </div>
</div>

<?php
mysql_close($sqlconnect);
?>

<p align=center><img src="Graphics/ByDividingThemUpBottomOfPage.jpg" alt="...by dividing them up." ALIGN=BOTTOM></p>

</body>
</html>