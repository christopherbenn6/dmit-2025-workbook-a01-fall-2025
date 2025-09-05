<?php
    $title = "Problem Two - Pythagorean Theorem";
    include 'includes/header.php';

    $a = 73;
    $b = 90;
    $c = round(sqrt($a**2 + $b**2), 2);

    echo "<p class=\"fw-bold\">One side is $a cm, the other side is $b cm so the hypotenuse is $c cm</p>";
?>

<a href="index.php" class="btn btn-primary-outline">Back</a>

<?php 
    include 'includes/footer.php';
?>