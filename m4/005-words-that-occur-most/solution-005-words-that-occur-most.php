<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>M4 - 005 Words That Occur Most</title>
</head>
<body>
    <h1>Words That Occur Most</h1>

<?php
# check if the form was submitted
if(isset($_POST["submit"])){
    $filename = $_POST["filename"];
    $words = array();

    # check if file exists
    if(file_exists($filename)){
        try{
            $file = fopen($filename, "r");

            # get the contents from the file
            $content = file_get_contents($filename);

            # split the words using the space as separator, and delete every non alphanumeric character   
            $split_words = preg_split('/\s+/',(preg_replace("/[^A-Za-z0-9 ]/", '', $content)),-1,PREG_SPLIT_NO_EMPTY);
            fclose($file);

            # loop the array generated by splitting the words
            foreach($split_words as $word){
                $w = strtolower($word);
                # if the word is inside the array add the count
                if (array_key_exists($w, $words)){
                    $words[$w] += 1;
                }
                # if not, create a new key in the array with value 1
                else{
                    $words[$w] = 1;
                }
            }    
            return var_dump($words);
        }
        catch (Exception $e){
            echo "Error ".$e;
        }
    }
    else{
        echo 'File not found, please <a href="javascript:history.back()">go back</a> and insert the right name of the file. ';
    }
}
else{
?>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
        <label>Write the name of the file</label>
        <input type="text" name="filename" />
        <input type="submit" value="submit" name="submit" />
    </form>

<?php
}
?>

</body>
</html>