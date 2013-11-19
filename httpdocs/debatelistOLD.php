<?php
session_start();
?>
<html>

<head>
    <title>Debate List</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>

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
<li><a href="profile.php">Profile</a></li>
  </ul> 
</div> 




</br>
</br>
<p><img src="Graphics/BringingPeopleTogetherTopOfPage.jpg" alt="Bringing people together..."></p>
</br>
</br>

<center>
<a href="http://igg.me/p/368080/x/779292" target="_blank">Indiegogo</a>
<a href="http://www.gofundme.com/2f4j70" target="_blank">GoFundMe</a>
<a href="http://rkthb.co/22722" target="_blank">RocketHub</a>
</center>
<?php


//if(isset($_SESSION['username']))
echo "Welcome to State of Debate, ".$_SESSION['username'];
echo $_SESSION['username'];
echo $_SESSION['UID'];

$server = "mysqldb2.ehost-services.com:3306"; 
$dbusername = "georg_testuser"; //database username 
$dbpassword = "password"; //database password 
$dbdatabase = "georgepaz_testdb"; //database name
$sqlconnect = mysql_connect($server, $dbusername, $dbpassword) or die("Couldn't connect to SQL Server on $server");
$sqldb = mysql_select_db($dbdatabase,$sqlconnect) or die("Couldn't open database $dbdatabase"); 

?>
</center>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="span10">
           <?php echo $_POST["debatetitle"]; ?><br /><br />
           <?php echo $_POST["debate"]; ?>      
<table class="table table-hover"><tr><th>Debate</th></tr>

<?php

$result = mysql_query("SELECT debates.uid, debates.did, debates.debatetitle, debates.rating, users.username  FROM debates LEFT JOIN users ON debates.uid=users.uid ORDER BY rating DESC");
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>";
?>


<a href="updebate.php?did=<?PHP echo $row['did']?>&uid=<?PHP echo $row['uid']?>"><img name="jsbutton2" src="Graphics/up.png" width="75" height="75" border="0"
alt="javascript button"></a>

<?php echo $row['rating'] ?>


<a href="downdebate.php?did=<?PHP echo $row['did']?>&uid=<?PHP echo $row['uid']?>"><img name="jsbutton1" src="Graphics/down.png" width="75" height="75" border="0"
alt="javascript button"></a>

<?php

echo "<a href='/debatepage.php?did=" . $row['did'] . " '>" . $row['debatetitle'] . "</a></br><pre>                    CREATED BY: <a href='/profile.php?username=" .$row['username']."'>".$row['username']." </pre>";
?>

</td>


<?php

echo "</tr>";
  }
echo "</table>";
?>


    </div>
    <div class="span2">
<div style="position:fixed; right:10px; top:0px z-index:1;" />
      

<center>
  <tr>
    <td align="center">TOP RATED USERS</td>
  </tr>
  <tr>
    <td>
      <table border="2">
      <tr>
        <td>USERNAME</td>
        <td>RATING</td>
      </tr>
</center>
	  

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
  </td>
</tr>
</table>
    </div>
  </div>
</div>






<?php
mysql_close($sqlconnect);
?>

<p><img src="Graphics/ByDividingThemUpBottomOfPage.jpg" alt="...by dividing them up." ALIGN=BOTTOM></p>

</body>
</html>