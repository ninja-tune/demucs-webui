<?php
include 'env.php';

$pythonVersion = exec('python3 --version 2>&1');
echo "Python version: " . $pythonVersion;

function process_demucs($inputFile, $model, $stems) {
    $demucsPath = getenv('DEMUCS_PATH');
    $outputBaseDir = 'output';
    $outputDir = $outputBaseDir . '/' . uniqid('output_', true);
    $outputZip = $outputDir . '.zip';
    $escapedInputFile = escapeshellarg($inputFile);
    $escapedOutputDir = escapeshellarg($outputDir);

    if (!file_exists($outputBaseDir)) {
        mkdir($outputBaseDir);
    }

    $cmd = "$demucsPath/demucs -n $model $stems $escapedInputFile -o $escapedOutputDir 2>&1";
    $output = [];
    $returnCode = 0;

    
    exec($cmd, $output, $returnCode);
    
    echo "Command: $cmd<br>";
    echo "Output:<br>";
    echo implode("<br>", $output) . "<br>";
    echo "Return code: $returnCode<br>";

    if ($returnCode === 0) {
        // Create a zip file from the output folder
        $zipCmd = "zip -r $outputZip $outputDir";
        exec($zipCmd, $output, $returnCode);

        // Delete the output folder after creating the zip file
        $delCmd = "rm -rf $outputDir";
        exec($delCmd);

        // Delete the original upload file
        unlink($inputFile);

        return $returnCode === 0 ? $outputZip : false;
    } else {
        return false;
    }
}