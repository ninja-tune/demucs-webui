<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Demucs Result</title>
	<link rel="stylesheet" href="css/main.css">
</head>

<body>
	<h1>Demucs Result</h1>
	<?php
    if (isset($_GET['output'])) {
        $outputPath = urldecode($_GET['output']);
        $outputFilename = basename($outputPath);
        echo "<a href='download.php?output=" . urlencode($outputPath) . "'>Download Result</a>";
    } else {
        echo "<p>Error: No output file found.</p>";
    }
    ?>
	<br><br>
	<a href="index.php">Back to main page</a>
	<script src="js/main.js"></script>
</body>

</html>