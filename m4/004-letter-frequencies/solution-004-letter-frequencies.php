<?php

try{ 
    # verify if an argument was entered
    if($argc > 1){
        
        $letters = array();
        $alphabet = "abcdefghijklmnopqrstuvwxyz";
        
        for($i = 0; $i < $argc; $i ++){
            try{
                # get the filename from the argument
                $filename = $argv[$i];

                # exclude the php filename
                if ($filename != basename(__FILE__)){
                    try{
                        $file = fopen($filename, "r");
                        while (false !== ($char = fgetc($file))) {
                            $c = strtolower($char);
                            # check if the character is a letter
                            if (str_contains($alphabet, $c)){
                                # if the letter is inside the array add the count
                                if (array_key_exists($c, $letters)){
                                    $letters[$c] += 1;
                                }
                                # if not, create a new key in the array with value 1
                                else{
                                    $letters[$c] = 1;
                                }    
                            }
                        }
                    }
                    catch (Exception $e){
                        echo "Error ".$e;
                    } 
                }
            }
            catch (Exception $e){
                echo "Error ".$e;
            }             
        }
        return var_dump($letters);
    }
}
catch (Exception $e){
    echo "Error ".$e;
} 

?>