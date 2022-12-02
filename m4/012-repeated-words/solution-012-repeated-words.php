<?php

try{ 
    # verify if an argument was entered
    if($argc == 2){
        
        $filename = $argv[1];
        $repeated_words = [];

        try{
            
            $file = fopen($filename, "r");

            # get content
            $content = file_get_contents($filename);
            # split the words using the space as separator, and delete every non alphanumeric character
            $split_words = preg_split('/\s+/',(preg_replace("/[^A-Za-z0-9 ]\n/", '', $content)),-1,PREG_SPLIT_NO_EMPTY);
            fclose($file);

            $wordcount = count($split_words);

            $i = 0;
            while ($i < $wordcount){
                # check if a word is equal to the following one
                if (($i != $wordcount-1) && (strtolower($split_words[$i]) == strtolower($split_words[$i+1]))){
                    array_push($repeated_words, $split_words[$i]);
                }
                $i ++;
            }
            
            return var_dump($repeated_words);
        }
        catch (Exception $e){
            echo "Error ".$e;
        }
    }
}
catch (Exception $e){
    echo "Error ".$e;
} 

?>