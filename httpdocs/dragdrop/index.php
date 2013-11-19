<head>
<style media="screen" type="text/css">
#filedrag
{
	display: none;
	font-weight: bold;
	text-align: center;
	padding: 1em 0;
	margin: 1em 0;
	color: #555;
	border: 2px dashed #555;
	border-radius: 7px;
	cursor: default;
}
#filedrag.hover
{
	color: #f00;
	border-color: #f00;
	border-style: solid;
	box-shadow: inset 0 3px 4px #888;
}
</style>
<script>
	// getElementById
	function $id(id) {
		return document.getElementById(id);
	}
	//
	// output information
	function Output(msg) {
		var m = $id("messages");
		m.innerHTML = msg + m.innerHTML;
	}
	
	// call initialization file
	if (window.File && window.FileList && window.FileReader) {
	Init();
	}
	//
	// initialize
	function Init() {
		var fileselect = $id("fileselect"),
		filedrag = $id("filedrag"),
		submitbutton = $id("submitbutton");
		// file select
		fileselect.addEventListener("change", FileSelectHandler, false);
		// is XHR2 available?
		var xhr = new XMLHttpRequest();
		if (xhr.upload) {
		// file drop
		filedrag.addEventListener("dragover", FileDragHover, false);
		filedrag.addEventListener("dragleave", FileDragHover, false);
		filedrag.addEventListener("drop", FileSelectHandler, false);
		filedrag.style.display = "block";
		// remove submit button
		submitbutton.style.display = "none";
		}
	}
	
	// file drag hover
	function FileDragHover(e) {
	e.stopPropagation();
	e.preventDefault();
	e.target.className = (e.type == "dragover" ? "hover" : "");
	}
	
	// file selection
	function FileSelectHandler(e) {
		// cancel event and hover styling
		FileDragHover(e);
		// fetch FileList object
		var files = e.target.files || e.dataTransfer.files;
		// process all File objects
		for (var i = 0, f; f = files[i]; i++) {
			ParseFile(f);
		}
	}
	
	function ParseFile(file) {
		Output(
			"<p>File information: <strong>" + file.name +
			"</strong> type: <strong>" + file.type +
			"</strong> size: <strong>" + file.size +
			"</strong> bytes</p>"
		);
	}
}
</script>
</head>
<body>
<div style="float:left; width:50%;">
<form id="upload" action="upload.php" method="POST" enctype="multipart/form-data">
<fieldset>
<legend>A rabbit hole for your files...</legend>
<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000" />
<div>
	<label for="fileselect">Files to wire in:</label>
	<input type="file" id="fileselect" name="fileselect[]" multiple="multiple"/>
	<div id="filedrag">or drop files into the abyss here:</div>
</div>
<div id="submitbutton">
	<button type="submit">Jack Files In</button>
</div>
</fieldset>
</form>
</div>
<div style="margin-left:50%; width:50%;padding:20px;">
<?php
$files = scandir('uploads/');
foreach($files as $file) {
  echo '<a href="uploads/'.$file.'">'.$file.'</a>';
  echo "<br>";
}
?>
</div>
</body>
