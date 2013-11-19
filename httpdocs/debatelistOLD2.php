<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
<link href="css/styles.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/jquery.ennui.contentslider.css" rel="stylesheet" type="text/css" media="screen,projection" />
<script src="js/tabcontent.js" type="text/javascript"></script>
<link href="css/tabcontent.css" rel="stylesheet" type="text/css" />

<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">



<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
<title>State Of Debate - Home</title>


<!--**********************************SCRIPTS START****************************************-->
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="js/bootstrap.min.js"></script>
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

<div id="userList">
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
	<p>Some User</p><br />
</div>




<div id="wrapper">
	<div id="topnav">
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
	<div id="welcomeBar">
			<p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
	</div>
		<div id="headBanner">
			<div id="highscores">
				<p id="highscoresP">Highscores</p>
				<table id="scoreTable" style="width:200px; clear:both; margin:0 auto;">
					<tr>
						<td>Username</td>
						<td>Rating</td>
					</tr>
					<tr>
						<td>Some User</td>
						<td>100</td>
					</tr>
					<tr>
						<td>Some User</td>
						<td>100</td>
					</tr>
					<tr>
						<td>Some User</td>
						<td>100</td>
					</tr>
					<tr>
						<td>Some User</td>
						<td>100</td>
					</tr>
					<tr>
						<td>Some User</td>
						<td>100</td>
					</tr>
					<tr>
						<td>Some User</td>
						<td>100</td>
					</tr>
					<tr>
						<td>Some User</td>
						<td>100</td>
					</tr>
					<tr>
						<td>Some User</td>
						<td>100</td>
					</tr>
					<tr>
						<td>Some User</td>
						<td>100</td>
					</tr>
					<tr>
						<td>Some User</td>
						<td>100</td>
					</tr>
					<tr>
						<td>Some User</td>
						<td>100</td>
					</tr>
					<tr>
						<td>Some User</td>
						<td>100</td>
					</tr>
					<tr>
						<td>Some User</td>
						<td>100</td>
					</tr>
					<tr>
						<td>Some User</td>
						<td>100</td>
					</tr>
					<tr>
						<td>Some User</td>
						<td>100</td>
					</tr>
				</table>
			</div>

			<div id="two" class="contentslider">
			<div class="cs_wrapper">
				<div class="cs_slider">
					<div class="cs_article">
						<h2> <a href="#">Top Debate!</a> </h2>
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
						<h2> <a href="#">Support Us!</a> </h2>
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
						<h2> <a href="#">New Feature!</a> </h2>
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
	</div>
	
	
	    <div style="width: 1000px; margin: 0 auto; padding: 120px 0 40px; font: 0.85em arial;">
        <ul class="tabs" persist="true">
            <li><a href="#" rel="view1">New Debates</a></li>
            <li><a href="#" rel="view2">Top</a></li>
            <li><a href="#" rel="view3">Trending</a></li>
            <li><a href="#" rel="view4">Browse by Topic</a></li>
        </ul>
        <div class="tabcontents">
            <div id="view1" class="tabcontent">
                <b>New Debates</b>
				<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						Fluid 12
						<div class="row-fluid">
						<div class="span6">
						Fluid 6
						<div class="row-fluid">
							<div class="span6">Fluid 6</div>
						<div class="span6">Fluid 6</div>
						</div>
						</div>
							
						</div>
					</div>
				</div>
				</div>
            </div>
            <div id="view2" class="tabcontent">
                <b>Top Debates</b>
            </div>
            <div id="view3" class="tabcontent">
                <b>Trending Debates</b>
            </div>
            <div id="view4" class="tabcontent">
                <b>Browse Debates by Topic</b>
            </div>
        </div>
    </div>


	


	<div id="footer">
		<p>This is our footer!</p>	
	</div>
</div>

</body>
</html>

