<?php

// erify format
function verifyFormat($param) {

        $fileFormat = strstr($param, '.');

        if (($fileFormat == ".pdf") ||
                ($fileFormat == ".doc") ||
                ($fileFormat == ".xls") ||
                ($fileFormat == ".jpg") ||
                ($fileFormat == ".jpeg")) {

        return TRUE;
        }
}

// generating 6 random numbers
function randSix() {
        $random_num = '';
        for ($i = 0; $i < 6; $i++) {
                $random_num .= rand(0, 9);
        }
        return $random_num;
}
