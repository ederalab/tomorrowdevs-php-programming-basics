<?php

try{
    # verify if an argument was entered
    if($argc > 1){
        $filename = "new_file.txt";

        $file = fopen($filename, "a+");

        for($i = 0; $i < $argc; $i++){
            # get the filename from the argument
            $new_filename = $argv[$i];

            # exclude the php filename
            if ($new_filename != basename(__FILE__)){
                try{
                    # read each file
                    $new_file = fopen($new_filename, "r");
                    $read_file = fread($new_file, filesize($new_filename));
                    # write the new file
                    fwrite ($file, $read_file);
                    fclose($new_file);        
                }
                catch (Exception $e){
                    echo "Error ".$e;
                }                
            }
        }

        fclose($file);
    }    
    else{
        echo "Error: missing arguments in command line";
    }
}
catch (Exception $e){
    echo "Error ".$e;
}

?>