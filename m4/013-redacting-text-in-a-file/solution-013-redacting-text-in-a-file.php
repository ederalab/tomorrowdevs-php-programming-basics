<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>M4 - 013 Redacting Text in a File</title>
</head>
<body>
    <h1>Redacting Text in a File</h1>

<?php
# check if the form was submitted
if(isset($_POST["submit"])){
    $text_filename = $_POST["text"];
    $words_filename = $_POST["words"];

    if(file_exists($text_filename) && file_exists($words_filename)){
        try{
            # get the file of sensitive words
            $words_file = fopen($words_filename, "r");
            # get content
            $content = file_get_contents($words_filename);
            # split the words using the space as separator
            $words = preg_split('/\s+/',$content,-1,PREG_SPLIT_NO_EMPTY);
            # make lowecase every word in the array
            $words_lowercase = array_map('strtolower', $words);

            fclose($words_file);

            # get the text to be redacted
            $text_file = fopen($text_filename, "r");
            $text = explode(" ", file_get_contents($text_filename));
            
            $redacted_text = file_get_contents($text_filename);

            foreach($words_lowercase as $w){
                $count = strlen($w);
                # replace every sensitive word
                $redacted_text = str_ireplace($w, str_repeat("*", $count), $redacted_text);
            }

            fclose($text_file);

            $redacted_filename = "redacted.txt";
            $redacted_file = fopen($redacted_filename, "w");
            file_put_contents($redacted_filename, $redacted_text);

            fclose($redacted_file);

            echo "File successfully created!";
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
        <label>Write the name of the text file</label><br/>
        <input type="text" name="text" /><br/>
        <label>Write the name of the sensitive word file</label><br/>
        <input type="text" name="words" /><br/>
        <input type="submit" value="submit" name="submit" />
    </form>

<?php
}
?>

</body>
</html>