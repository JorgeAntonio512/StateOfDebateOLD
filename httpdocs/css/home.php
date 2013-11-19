<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

				<?php
				$server = "mysqldb2.ehost-services.com:3306"; 
				$dbusername = "georg_testuser"; //database username 
				$dbpassword = "password"; //database password 
				$dbdatabase = "georgepaz_testdb"; //database name
				$sqlconnect = mysql_connect($server, $dbusername, $dbpassword) or die("Couldn't connect to SQL Server on $server");
				$sqldb = mysql_select_db($dbdatabase,$sqlconnect) or die("Couldn't open database $dbdatabase"); 
				?>  



<head>
<link href="css/styles.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/deep.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/jquery.ennui.contentslider.css" rel="stylesheet" type="text/css" media="screen,projection" />
<script src="js/tabcontent.js" type="text/javascript"></script>
<link href="css/tabcontent.css" rel="stylesheet" type="text/css" />

<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
<title>State Of Debate - Home</title>


<!--**********************************SCRIPTS START****************************************-->
		<!-- Site JavaScript -->
		<script type="text/javascript"
		src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="js/jquery.ennui.contentslider.js"></script>
		<script type="text/javascript">
			$(function() {
				$('#one').ContentSlider({
					width : '900px',
					height : '400px',
					speed : 800,
					easing : 'easeInOutBack'
				});
			});
			$(function() {
				$('#two').ContentSlider({
					width : '720px',
					height : '266px',
					speed : 400,
					easing : 'easeOutQuad',
					textResize : true
				});
			});
		</script>
		<script src="js/jquery.chili-2.2.js" type="text/javascript"></script>
		<script src="js/chili/recipes.js" type="text/javascript"></script>

<!--**********************************SCRIPTS END****************************************-->
</head>

<body>





<div id="wrapper">
	<!--<img style="height:100px;" src="State.png" />-->
	<div style="margin-top:50px;" id="topnav"><!--This is temp, remove margin-->
		<ul>
			<li style="padding-left:30px;"><a href="home.html">Home</a></li>
			<li><a href="#">Sign In</a></li>
			<li><a href="#">Sign Up</a></li>
			<li><a href="#">Profile</a></li>
			<li><a href="#">Rules</a></li>
			<li><a href="#">Messaging</a></li>
			<li><a href="#">Help</a></li>
			
			<li style="clear:left; float:right; padding-right:30px;"><input name="Text1" type="text" value=" Search Debates"></li>
			<!--<form method="post"></form>-->
		</ul>
	</div>	
	<div id="pageContent">

	<div id="welcomeBar">
			<p>Welcome, User!</p>
	</div>
		<div id="headBanner">
			<div id="highscores">
				<p id="highscoresP">Highscores</p>
				<table id="scoreTable" style="width:200px; clear:both; margin:0 auto;">


					<tr>
						<th>Username</th>
						<th>Rating</th>
						
					</tr>

							<?php
								$order = "SELECT * FROM users ORDER BY rating DESC LIMIT 0, 15";			
								$result = mysql_query($order);
								while($data = mysql_fetch_row($result)){
								  echo("<tr><td>$data[3]</td><td>$data[2]</td></tr>");
								}
							?>	
					

				</table>
			</div>

			<div id="two" class="contentslider">
			<div class="cs_wrapper">
				<div class="cs_slider">
					<div class="cs_article">
						<h2> <a href="#">Top Debate!</a> </h2>
				<?php
					$query1 = mysql_query("SELECT * FROM debates ORDER BY rating DESC LIMIT 0, 1");
					while($row = mysql_fetch_array($query1))
					{
						?>
							<h1 style="padding-left:475px;"><?php echo($row['debatetitle']) ?></h1>
						<?php
						
					}
				?>
						
				
						<a href="#">
							<img src="images/article01.jpg"
								alt="Artist's interpretation of article headline" />
						</a>
						<p>
							Hendrerit tincidunt vero vel eorum claritatem. Soluta
							legunt quod qui dolore typi. Vel dolore soluta qui odio
							non. Sollemnes minim eorum feugiat nihil nobis. Gothica
							dolor in legentis nihil quinta.
						</p>
						<p>
							Iriure parum autem putamus lectores duis. Quam sit quis
							me me zzril. Facer etiam in lectores hendrerit etiam.
							Exerci lorem liber tincidunt nostrud decima. Mutationem
							est zzril ipsum facer nobis.
						</p>
						<a href="#" class="readmore">Read More</a>
					</div><!-- End cs_article -->

					<div class="cs_article">
						<h2> <a href="#">Top User!</a> </h2>
						<a href="#">
							<img src="images/article02.jpg"
								alt="Artist's interpretation of article headline" />
						</a>
						
						<p>
							Nibh nihil et ex accumsan insitam. Qui lius congue
							hendrerit quam vero. Demonstraverunt molestie ipsum
							magna nobis sequitur. Ex diam euismod quis ii velit.
						</p>
						<p>
							In quam lectores placerat Investigationes illum. Diam
							sollemnes nihil lorem claram consectetuer. Eros nam
							placerat claritas claritatem congue. Adipiscing ut
							clari suscipit nulla habent.
						</p>
						<a href="#" class="readmore">Read More</a>
					</div><!-- End cs_article -->

					<div class="cs_article">
						<h2> <a href="#">Support Us!</a> </h2>
						<a href="#">
							<img src="images/article03.jpg"
								alt="Artist's interpretation of article headline" />
						</a>
						<p>
							Clari eum vel blandit notare quarta. Autem processus
							lectores augue iriure facit. Volutpat aliquip erat
							imperdiet ipsum tation. Typi luptatum ut
							demonstraverunt eros quam. Ut clari consectetuer
							tincidunt liber qui. 
						</p>
						<p>
							Modo vel facilisis qui liber est. Eorum Investigationes
							processus adipiscing commodo ea. Id iis claritatem vero
							ea consequat.
						</p>
						<a href="#" class="readmore">Read More</a>
					</div><!-- End cs_article -->

					<div class="cs_article">
						<h2> <a href="#">Did you know..?</a> </h2>
						<a href="#">
							<img src="images/article04.jpg"
								alt="Artist's interpretation of article headline" />
						</a>
						<p>
							Iis nostrud claritas quis sed qui. Ut nunc facilisi
							claritatem quinta sit. Assum ii liber diam zzril nobis.
							Qui nibh delenit fiant te illum. Delenit claritas ut
							exerci eros typi. 
						</p>
						<p>
							Videntur vel euismod ut eleifend quis. Nobis aliquam
							nunc vero blandit illum. Lius placerat litterarum
							processus quam legere. Accumsan modo non at congue
							duis. Odio duis ut blandit feugait in. 
						</p>
						<a href="#" class="readmore">Read More</a>
					</div><!-- End cs_article -->

				</div><!-- End cs_slider -->
			</div><!-- End cs_wrapper -->
		</div><!-- End contentslider -->
	</div>
	
	
	
	
	
	    <div style="width: 1000px; margin: 0 auto; padding: 120px 0 40px; font: 0.85em arial;">
        <ul class="tabs" persist="true">
            <li><a href="#" rel="view1">New Debates</a></li>
            <li><a href="#" rel="view2">Top</a></li>
            <li><a href="#" rel="view3">Trending</a></li>
            <li><a href="#" rel="view4">Browse by Topic</a></li>
        </ul>
        <div style="background-color:#fff;" class="tabcontents">
            <div id="view1" class="tabcontent">
                               
				<?php
					$query1 = mysql_query("SELECT * FROM debates RIGHT JOIN users ON debates.UID=users.UID ORDER BY timestamp DESC LIMIT 0, 10");
					while($row = mysql_fetch_array($query1))
					{
						?>
							<?php echo "<a href='/debatepage.php?did=" . $row['did'] . " '>"; ?>

							<div class="debateBox">
								<div style="text-align:center; padding-bottom:20px;"><?php echo($row['debatetitle']) ?></div>
								<!----><div class="centerBox"><?php echo($row['description']) ?></div>

								<div style="clear:left;" class="leftBox">
									<p class="dateStamp" style="text-align:center; font-size:10px;"><?php echo date('F j, Y', strtotime($row['timestamp']) ); ?>  </br> <?php echo    
                                                                              date ('g:i a', strtotime($row['timestamp']) ); ?></p>
                                                                         <?php echo  '<img class="userImage" src="'.$row['imagelocation'].'"alt=" />';?>
									 <p style="text-align:center; font-size:10px;"></p><?php echo '<p style="text-align:center; font-size:10px;">' . $row['username'] . '</p>';?>
                                    
								</div>


							</div><?php "</a>"; ?>


						<?php
						
					}
					
					
				?>
              
            </div>
            <div id="view2" class="tabcontent">
				<!---------------------------------The below is temporary; the formatting is wrong------------------------->
				<?php
					$query1 = mysql_query("SELECT * FROM debates ORDER BY rating DESC LIMIT 0, 10");
					while($row = mysql_fetch_array($query1))
					{
						?>
							<div class="debateBox">
								<div style="text-align:center;"><?php echo($row['debatetitle']) ?></div>
								<div class="leftBox">
									<p class="dateStamp" style="text-align:center; font-size:10px;">March 8, 1993</p>
									<p class="timeStamp" style="text-align:center; font-size:10px;">12:59 PM</p>
									<img class="userImage" src="images/tempFace.jpg" alt=""/>
									<p class="userName" style="text-align:center; font-size:10px;">Joshua Stowers</p>
								</div>
							</div>
						<?php
						
					}
					
					
				?>
				<!-------------------------------------------------------------------------------->


            </div>
            <div id="view3" class="tabcontent">
                <b>Trending Debates</b>
            </div>
            <div id="view4" class="tabcontent">
                <b>Browse Debates by Topic</b>
            </div>
        </div>
    </div>


	</div><!--End pageContent-->


	<div id="footer">
		<p>This is our footer!</p>	
	</div>
</div>

</body>
</html>
<?php
	mysql_close($sqlconnect);
?>