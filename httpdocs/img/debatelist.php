<html>

<head>
    <title>Debate List</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>

<body>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>

<p align=center><img src="Graphics/BringingPeopleTogetherTopOfPage.jpg" alt="Bringing people together..."></p>
</br>
</br>
<p align=center><a href="index.html"><img src="Graphics/StateOfDebate.jpg" onmouseover="this.src='Graphics/StateOfDebateMouseOver.jpg'" onmouseout="this.src='Graphics/StateOfDebate.jpg'" /></a></p>

<br>
<br>
<FORM METHOD="LINK" ACTION="blankdebate.html" align=center>
<INPUT TYPE="submit" VALUE="Create a debate" button style="background-color:white"></button>
</FORM>

<FORM METHOD="LINK" ACTION="invite.html" align=center>
<INPUT TYPE="submit" VALUE="Invite people to join State of Debate" button style="background-color:white"></button>
</FORM>


<?php echo $_POST["debatetitle"]; ?><br /><br />
<?php echo $_POST["debate"]; ?> 

<?php
$server = "mysqldb2.ehost-services.com:3306"; 
$dbusername = "georg_testuser"; //database username 
$dbpassword = "password"; //database password 
$dbdatabase = "georgepaz_testdb"; //database name
$sqlconnect = mysql_connect($server, $dbusername, $dbpassword) or die("Couldn't connect to SQL Server on $server");
$sqldb = mysql_select_db($dbdatabase,$sqlconnect) or die("Couldn't open database $dbdatabase"); 

?>

<table class="table table-hover"><tr><th>Debate</th></tr>

<?php

$result = mysql_query("SELECT did,debatetitle  FROM debates");
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='/debatepage.php?did=" . $row['did'] . " '>" . $row['debatetitle'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";

mysql_close($sqlconnect);
?>

<p align=center><img src="Graphics/ByDividingThemUpBottomOfPage.jpg" alt="...by dividing them up." ALIGN=BOTTOM></p>

</body>
</html>