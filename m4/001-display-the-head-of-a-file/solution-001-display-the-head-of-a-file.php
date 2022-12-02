<?php

function headOfFile($filename, $line_limit=10){
    $line_count = 0;
    $file = fopen($filename, "r");
    if(file_exists($filename)){
        try{
            # loop each line until the end of file
            while(($line = fgets($file)) !== false){ 
                # limit until the limit
                if($line_count < $line_limit){
                    echo $line."<br/>";
                    $line_count++;    
                }
            }
            fclose($file);
        }
        catch (Exception $e){
            echo "Error ".$e;
        }
    }
}

headOfFile('../../utils/sample_file.txt');

?>