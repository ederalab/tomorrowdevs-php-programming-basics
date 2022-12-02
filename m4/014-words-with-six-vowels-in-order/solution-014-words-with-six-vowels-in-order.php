<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>M4 - 014 Words with Six Vowels in order</title>
</head>
<body>
    <h1>Words with Six Vowels in order</h1>

<?php
if(isset($_POST["submit"])){
    $filename = $_POST["filename"];
    $vowels = "aeiouy";
    $words_list = array();

    if(file_exists($filename)){
        try{
            $file = fopen($filename, "r");
            # get content
            $content = file_get_contents($filename);
            # split the words by new line 
            $words = explode("\n", $content);
            # loop the words array
            foreach ($words as $word){
                $word_vowels = "";
                # loop each character of each word
                foreach(str_split(strtolower($word)) as $w){
                    # if the character is a vowel add it to the string $word_vowels
                    if (str_contains($vowels, $w)){
                        $word_vowels .= $w;
                    }
                    # if the string $world_vowels is equal to the string $vowels, the word has the six vowels in order
                    # if the word is not in the list push it in the array
                    if (($word_vowels == $vowels) && (!in_array($word, $words_list))){
                        array_push($words_list, $word);
                    }
                }
            }
            fclose($file);

            # output
            echo "The words that contain 6 vowels in order are: <br/>";
            echo "<ul>";
            foreach($words_list as $output){
                echo "<li>".$output."</li>";
            }
            echo "</ul>";

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
        <label>Write the name of the file</label><br/>
        <input type="text" name="filename" /><br/>
        <input type="submit" value="submit" name="submit" />
    </form>

<?php
}
?>

</body>
</html>