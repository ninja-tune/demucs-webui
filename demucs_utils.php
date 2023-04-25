<?php
function process_demucs($inputFile, $model, $stems) {
    $outputBaseDir = 'output';
    $outputDir = $outputBaseDir . '/' . uniqid('output_', true);
    $outputZip = $outputDir . '.zip';
    $escapedInputFile = escapeshellarg($inputFile);
    $escapedOutputDir = escapeshellarg($outputDir);

    if (!file_exists($outputBaseDir)) {
        mkdir($outputBaseDir);
    }

    $cmd = "demucs -n $model $stems $escapedInputFile -o $escapedOutputDir 2>&1";
    $output = [];
    $returnCode = 0;

    exec($cmd, $output, $returnCode);

    if ($returnCode === 0) {
        // Create a zip file from the output folder
        $zipCmd = "zip -r $outputZip $outputDir";
        exec($zipCmd, $output, $returnCode);

        // Delete the output folder after creating the zip file
        $delCmd = "rm -rf $outputDir";
        exec($delCmd);

        return $returnCode === 0 ? $outputZip : false;
    } else {
        return false;
    }
}