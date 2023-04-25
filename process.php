<?php
// Add this function to the beginning of your process.php file
function get_upload_error_message($error_code) {
    $upload_errors = array(
        UPLOAD_ERR_INI_SIZE   => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
        UPLOAD_ERR_FORM_SIZE  => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
        UPLOAD_ERR_PARTIAL    => 'The uploaded file was only partially uploaded.',
        UPLOAD_ERR_NO_FILE    => 'No file was uploaded.',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder.',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
        UPLOAD_ERR_EXTENSION  => 'A PHP extension stopped the file upload.'
    );
    return isset($upload_errors[$error_code]) ? $upload_errors[$error_code] : 'Unknown upload error.';
}

require 'demucs_utils.php';

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];
    $model = $_POST['model'];
    $stems = $_POST['stems'];

    if ($file['error'] === 0) {
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileNameParts = explode('.', $fileName);
        $fileExt = strtolower(end($fileNameParts));
        
        if ($fileExt === 'wav') {
            $fileDestination = 'uploads/' . uniqid('', true) . '.' . $fileExt;
            move_uploaded_file($fileTmpName, $fileDestination);
            $outputPath = process_demucs($fileDestination, $model, $stems);

            if ($outputPath) {
                header("Location: result.php?output=" . urlencode($outputPath));
            } else {
                echo "Error processing the file.";
            }
        } else {
            echo "Invalid file type.";
        }
    } else {
		echo get_upload_error_message($file['error']);
    }
}