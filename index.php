<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Demucs Web UI</title>
	<link rel="stylesheet" href="css/main.css">



</head>

<body>
	<h1>Demucs Web UI</h1>
	<p>This is purely proof of concept - and is very slow as there is no hardware accelation currently on this
		machine. I suggest using short ~15s clips to purely to audit the Demucs stem seperation algorithm</p>

	<form id="demucs-form" action="process.php" method="post" enctype="multipart/form-data">
		<label for="file">Upload WAV file:</label>
		<input type="file" name="file" id="file" accept=".wav" required><br><br>

		<label for="model">Choose a model:</label>
		<select name="model" id="model">
			<option value="htdemucs">MQ (Fast)</option>
			<option value="htdemucs_ft">HQ (Slow)</option>
		</select><br><br>

		<label for="stems">Number of stems:</label>
		<!-- <input type="number" name="stems" id="stems" value="4" min="2" max="5" required><br><br> -->
		<select name="stems" id="stems">
			<option value="--two-stems=vocals">vox + other</option>
			<option value="">vox + bass + drums + other</option>
		</select><br><br>

		<input type="submit" value="Process" name="submit">
	</form>
	<script src="js/main.js"></script>

	<div id="waiting-container"
		style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0, 0, 0, 0.5); z-index:1000;">
		<div id="waiting-indicator" style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);">
			<p>Please wait, processing the audio file...</p>
			<img src="loading.gif" alt="Loading...">
		</div>
	</div>

	<h3>Todo</h3>
	<ul>
		<li>Cronjob to clear out old zips</li>
		<li>Add additional models for testing</li>
		<li>Add gpu to instance</li>
	</ul>
	<script>
	document.getElementById('demucs-form').addEventListener('submit', function() {
		document.getElementById('waiting-container').style.display = 'block';
	});
	</script>
	<!-- 
	<?php
	phpinfo();
	?> -->
</body>



</html>