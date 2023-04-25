<?php
if (isset($_GET['output'])) {
    $outputPath = urldecode($_GET['output']);
    $outputFilename = basename($outputPath);

    if (file_exists($outputPath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . $outputFilename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($outputPath));
        readfile($outputPath);
        exit;
    } else {
        echo "Error: File not found.";
    }
} else {
    echo "Error: No output file provided.";
}