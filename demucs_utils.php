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


    if (strtoupper(substr(PHP_OS, 0, 3)) === 'DAR') {
        // Mac environment
        $cmd = "/Users/elliotseeds/.pyenv/shims/demucs -n $model $stems $escapedInputFile -o $escapedOutputDir 2>&1";
    } else {
        // Linux environment (replace '/path/to/demucs' with the actual path)
        $cmd = "/home/elliot/.local/bin/demucs -n $model $stems $escapedInputFile -o $escapedOutputDir 2>&1";
    }



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