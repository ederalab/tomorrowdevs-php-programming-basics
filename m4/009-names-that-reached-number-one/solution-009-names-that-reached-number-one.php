<?php
$filepath = "../../utils/BabyNames";

try{
    $files = scandir($filepath);
    $girls = array();
    $boys = array();

    # loop all the files in the folder
    foreach ($files as $fn){
        $filename = $filepath."/".$fn;
        # if is a file of girls' names
        if (str_contains($fn, "Girls")){
            $file = fopen($filename, "r");
            # get content
            $content = file_get_contents($filename);
            # separate each line and insert values in array
            $names = explode("\n", $content);
            # take the first name 
            $n = explode(" ", $names[0]);
            if(!in_array($n[0], $girls)){
                array_push($girls, $n[0]);
            } 
            fclose($file);
        }
        # if is a file of boys' names
        elseif (str_contains($fn, "Boys")){
            $file = fopen($filename, "r");
            # get content
            $content = file_get_contents($filename);
            # separate each line and insert values in array
            $names = explode("\n", $content);
            # take the first name 
            $n = explode(" ", $names[0]);
            if(!in_array($n[0], $boys)){
                array_push($boys, $n[0]);
            } 
            fclose($file);
        }     
    }    

    # output
    echo 'The most popular names for Girls in the years were:<br/>';
    foreach($girls as $girl_name){
        echo "• ".$girl_name."<br/>";
    }

    echo 'The most popular names for Boys in the years were:<br/>';
    foreach($boys as $boy_name){
        echo "• ".$boy_name."<br/>";
    }

}
catch (Exception $e){
    echo "Error ".$e;
}
?>