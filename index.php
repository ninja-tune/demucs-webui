<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>AI Stem Extractor</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<h1>AI Stem Extractor</h1>
	<p>Proof of concept, runs slower than real time so best to test with short audio!</p>
	<form id="myForm">
		<label for="model">Choose a model:</label>
		<select name="model" id="model">
			<option value="htdemucs">MQ (Fast)</option>
			<option value="htdemucs_ft">HQ (Slow)</option>
		</select>
		<label for="stems">Choose number of stems:</label>
		<select name="stems" id="stems">
			<option value="--two-stems=vocals">vox + other</option>
			<option value=" ">vox + bass + drums + other</option>
		</select>
		<label for="emailAddress">Your email address (this is where files will be sent on completion):</label>
		<input type="email" name="emailAddress" id="emailAddress" placeholder="Email Address">
		<label for="file">Upload a WAV:</label>
		<input type="file" name="file" id="file" accept=".wav">
		<button type="submit">Submit</button>
	</form>
	<div id="progress">
		<div id="progress-bar"></div>
	</div>
	<div id="completion-message" style="display: none;">
		<h3>File uploaded successfully!</h3>
		<p>Your processed files will be emailed to you when the process is complete.</p>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="script.js"></script>
</body>

</html>