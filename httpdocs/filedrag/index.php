<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Rabbit Hole</title>
<link rel="stylesheet" type="text/css" media="all" href="styles.css" />
</head>
<body>

<h1 >A rabbit hole to your files...</h1>

<div style="float:left; width:66%;">
<form id="upload" action="upload.php" method="POST" enctype="multipart/form-data">

<div id="myfieldset">
<legend>Send File down the Rabbit hole...</legend>

<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="64000000" />

<div>
	<!--<label for="fileselect">Files to upload:</label>-->
	<input type="file" id="fileselect" name="fileselect[]" multiple="multiple" />
	<div id="filedrag">drop files here</div>
</div>

<div id="submitbutton">
	<button type="submit">Upload Files</button>
</div>

</div>

</form>

<div id="progress"></div>

<div id="messages">
<p>Status Messages</p>
</div>
</div>

<script src="filedrag.js"></script>
<div id="dirlist" style="margin-left:66%; width:33%;padding:20px;">
<?php
$files = scandir('uploads/');
foreach($files as $file) {
  echo '<a href="uploads/'.$file.'">'.$file.'</a>';
  echo "<br>";
}
?>
</div>
</body>
</html>