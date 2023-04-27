<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = $_POST['model'];
    $stems = $_POST['stems'];
    $emailAddress = $_POST['emailAddress'];

    $chunkIndex = $_POST['chunkIndex'];
    $totalChunks = $_POST['totalChunks'];
    $fileName = $_POST['fileName'];
    $uuid = $_POST['uuid'];
    $file = $_FILES['file'];

    $uploadDir = 'uploads/' . $uuid . '/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $uploadFile = $uploadDir . $fileName;

    if ($file['error'] === 0) {
        $tempFile = $uploadDir . "chunk_" . $chunkIndex . "_" . $fileName;

        if (move_uploaded_file($file['tmp_name'], $tempFile)) {
            if ($chunkIndex + 1 == $totalChunks) {
                $finalFile = fopen($uploadFile, "wb");

                for ($i = 0; $i < $totalChunks; $i++) {
                    $chunkFile = $uploadDir . "chunk_" . $i . "_" . $fileName;
                    $chunkContent = file_get_contents($chunkFile);
                    fwrite($finalFile, $chunkContent);
                    unlink($chunkFile);
                }

                fclose($finalFile);

                    $bashScript = "script.sh";
                    // $logFile = $uploadDir . "log.txt"; // Create a log file for the script output
                    $logFile = "log.txt"; // Create a log file for the script output

                    $command = "bash $bashScript '$uploadFile' $model $emailAddress $stems > $logFile 2>&1 & echo $!";
                    $pid = shell_exec($command);
                    echo "Script running in background with PID: " . $pid;
                } else {
                    echo "Chunk $chunkIndex uploaded";
                }
        } else {
            echo "Error uploading chunk";
        }
    } else {
        echo "Error with chunk";
    }
} else {
    echo "Invalid request";
}
?>