<?php
$filename = "../../utils/sample_file.txt";

$letters = array();
$alphabet = "abcdefghijklmnopqrstuvwxyz";
$total_letters = 0;

try{
    $file = fopen($filename, "r");

    # get the contents from the file replacing blank spaces with nothing
    $content = str_split(str_replace(" ", "", file_get_contents($filename)));
    fclose($file);

    # loop the array
    foreach($content as $character){
        $c = strtolower($character);
        if (str_contains($alphabet, $c)){
            if (array_key_exists($c, $letters)){
                $letters[$c] += 1;
            }
            else{
                $letters[$c] = 1;
            }    
            $total_letters += 1;
        }
    }
    
    # sort associative array in ascending order
    arsort($letters);

    # output
    echo "Proportion of letters in the text: <br/>";

    foreach ($letters as $k => $v){
        $percentage = $v / $total_letters * 100;
        $p = number_format($percentage, 2, ',', ' ');
        echo strtoupper($k).": ".$p."%<br/>";
    }
    
}
catch (Exception $e){
    echo "Error ".$e;
}
?>