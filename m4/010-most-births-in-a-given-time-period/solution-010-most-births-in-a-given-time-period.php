<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>M4 - 010 Most Births in a given Time Period</title>
</head>
<body>
    <h1>Most Births in a given Time Period</h1>


<?php
# check if the form is submitted
if(isset($_POST["submit"])){

    $first = $_POST["first"];
    $last = $_POST["last"];

    # validation
    if ((!isset($first)) || (!isset($last)) || ($first == "") || ($last == "") || (strlen($first) != 4) || (strlen($last) != 4) || (!is_numeric($first)) || (!is_numeric($last))){
        echo 'Please fill correctly the time period.<br/>Please, <a href="javascript:history.back()">go back</a>';
    }
    elseif (($first < 1900) || ($last > 2012) || ($first > $last)){
        echo 'Please use a valid range, from 1900 to 2012<br/>Please, <a href="javascript:history.back()">go back</a>';
    }

    $filepath = "../../utils/BabyNames";
    
    try{
        $files = scandir($filepath);
        $girls = array();
        $boys = array();

        # loop all the files in the folder
        foreach ($files as $fn){
            $filename = $filepath."/".$fn;
            $year = substr($fn, 0, 4);

            # use only the files in the range of year
            if (($year >= $first) && ($year <= $last)){
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
}
else{
?>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
        <p>Select the range of the years for which you want to know the most used names (from 1900 to 2012) </p>
        <label>First year of the range </label><br/>
        <input type="text" name="first" /><br/>
        <label>Last year of the range </label><br/>
        <input type="text" name="last" /><br/>
        <input type="submit" value="submit" name="submit" />
    </form>

<?php
}
?>

</body>
</html>