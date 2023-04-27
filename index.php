<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>AI Stem Extractor</title>
	<link rel="stylesheet" href="style.css">
	<link rel="icon"
		href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎹</text></svg>">
</head>

<body>
	<form id="myForm">
		<h1>AI Stem Extractor</h1>
		<!-- <p>Proof of concept, runs slower than real time so best to test with short audio!</p> -->
		<label for="model">Choose a model:</label>
		<select name="model" id="model">
			<option value="htdemucs">htdemucs (Fast)</option>
			<option value="htdemucs_ft">htdemucs_ft (Slow)</option>
		</select>
		<label for="stems">Choose number of stems:</label>
		<select name="stems" id="stems">
			<option value="--two-stems=vocals">vox + other</option>
			<option value=" ">vox + bass + drums + other</option>
		</select>
		<label for="emailAddress">Your email address (this is where files will be sent on completion):</label>
		<input type="email" name="emailAddress" id="emailAddress" placeholder="Email Address" required>
		<label for="file">Upload a WAV:</label>
		<input type="file" name="file" id="file" accept=".wav" required>
		<button type="submit">SUBMIT</button>
	</form>
	<div id="progress" style="display: none;">
		<div id="progress-bar"></div>
	</div>
	<div id="completion-message" style="display: none;">
		<h3>File uploaded successfully!</h3>
		<p>Your processed files will be emailed to you when the process is complete.</p>
		<br>
		<a href=".">Back to main page</a>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="script.js"></script>
</body>

</html>