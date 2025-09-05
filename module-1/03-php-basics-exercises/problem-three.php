<?php
    $title = "Problem Two - Pythagorean Theorem";
    include 'includes/header.php';

    $fullNumber = '281078787';
    $addedNumber = 0;
    for($i = strlen(($fullNumber)); $i >= 0; $i--){
        $addedNumber += intval(substr($fullNumber, $i, 1));
    }
    echo "<p>$addedNumber</p>";

?>

<a href="index.php" class="btn btn-primary-outline">Back</a>

<?php 
    include 'includes/footer.php';
?>