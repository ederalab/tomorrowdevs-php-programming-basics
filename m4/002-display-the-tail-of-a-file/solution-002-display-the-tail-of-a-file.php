<?php

function tailOfFile($filename, $line_limit=10){
    $content = array();
    $file = fopen($filename, "r");
    if(file_exists($filename)){
        try{
            # loop to the end of file
            while(!feof($file)){
                $line = fgets($file);
                # push the line into the array
                array_push($content, $line);
            }
            fclose($file);
        }
        catch (Exception $e){
            echo "Error ".$e;
        }
    }
    # extract the last lines from the array
    $output = array_slice($content, -$line_limit);
    return $output;
}

var_dump(tailOfFile('../../utils/sample_file.txt', 20));

?>