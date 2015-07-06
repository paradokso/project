<?php

// generating file path

$storeFolder = 'invoices';
$ds = DIRECTORY_SEPARATOR;
$firstTargetPath = dirname(__FILE__) . $ds . $storeFolder . $ds;


if ($_FILES['file']) {

        // if uploaded file exist in common session
        if (($_FILES['file']['tmp_name'] == $_SESSION['tmp_name'])){

        $_SESSION = array();
        session_destroy();

 }
        // get file body
        $tempFile = $_FILES['file']['tmp_name'];

        // replace spaces to "_" for correct saving
        $fileName = str_replace(" ", '_', $_FILES['file']['name']);

        // verifying file format

        if (verifyFormat($fileName)) {

                $date = date('YmdHis');

                $secondTargetPath = $date . "_" . randSix();

                unset($_SESSION["targetFile"]);
                
                $tempPlace = $firstTargetPath . $secondTargetPath;

                mkdir($tempPlace);

                $targetFile = $tempPlace . $ds . $fileName;

                move_uploaded_file($tempFile, $targetFile);

                // use session for moving filePath in shell-script
                $_SESSION['targetFile'] = $targetFile;

                // to prevent upload file with not permitted formats
                unset($_FILES);
                
        }

}

?> 