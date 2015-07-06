<?php

$parced = array();

if ($stringForShell) {

        // exec chell-script
        $command_result = shell_exec($stringForShell);

        // this var with values from shell goes to view
        $parced = explode("\n", trim($command_result));
       
        // setting response for frontend parsing
        foreach ($parced as $k => $v){
                echo ':'.$v."\n";
        }
        
        // clear session to prevent handle of exact file 
        $_SESSION = array();
		session_destroy();

}


