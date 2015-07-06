<?php
session_start();

// uploading file
require 'functions.php';
require 'upload.php';

// if form is filled, preparing string for exec shell-script
$postHandler = $_POST;

if ($postHandler) {

        //verifying data
        $verify = array();
        
        // numbers are correct entered?
        if (($postHandler) !== false) {

                if ((is_numeric(strlen($postHandler ["INN"]) == 10)) ||
                        (is_numeric(strlen($postHandler ["INN"])) == 12))
                 {
                        $verify["INN"] = $postHandler ["INN"];
                }

                if (is_numeric(strlen($postHandler ["INN"])) == 12) {
                        $verify["KPP"] = 0;
                } else {
                        $verify["KPP"] = $postHandler ["KPP"];
                }

                if (is_numeric(strlen($postHandler ["BIC"])) == 9) {
                        $verify["BIC"] = $postHandler ["BIC"];
                }
                if (is_numeric(strlen($postHandler ["Cor_Acc"])) == 20) {
                        $verify["Cor_Acc"] = $postHandler ["Cor_Acc"];
                }
                if (is_numeric(strlen($postHandler ["Checking_Acc"])) == 20) {
                        $verify["Checking_Acc"] = $postHandler ["Checking_Acc"];
                }
                
                // gathering data for shell-script
                $result = array(
                    'COM' => 'sh ./extractor_stub.sh 2>&1',
                    'INN' => $verify ["INN"],
                    'KPP' => $verify ["KPP"],
                    'BIC' => $verify ["BIC"],
                    'Cor_Acc' => $verify ["Cor_Acc"],
                    'Checking_Acc' => $verify ["Checking_Acc"],
                    'filePlace' => $_SESSION['targetFile'],
                );
                
                // getting specified string for shell
                $stringForShell = '';
                foreach ($result as $r) {
                        $stringForShell .= " " . $r;
                }

        }
}

// exec shell-script in script.php
require 'script.php';