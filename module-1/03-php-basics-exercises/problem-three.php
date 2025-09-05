<?php
    $title = "Problem Two - Pythagorean Theorem";
    include 'includes/header.php';

    //Using Math and stuff
    // $fullNumber = '281078787';
    // $addedNumber = 0;
    // for($i = strlen(($fullNumber)); $i >= 0; $i--){
    //     $addedNumber += intval(substr($fullNumber, $i, 1));
    // }
    // echo "<p>$addedNumber</p>";

    //treating a string as an array
    $string = '1234';
    $result = 0;
    for($i = strlen($string) - 1; $i >= 0; $i--) {
        $result += intval($string[$i]);
    }
    echo "<p>Adding all the digits of $string gives $result</p>";

?>

<a href="index.php" class="btn btn-primary-outline">Back</a>

<?php 
    include 'includes/footer.php';
?>