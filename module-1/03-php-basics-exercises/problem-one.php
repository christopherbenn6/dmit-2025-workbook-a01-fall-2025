<?php
    $title = "Problem One - Variable Swap";
    include 'includes/header.php';
    $var1 = 7;
    $var2 = 5;
    echo "<p>variable One = $var1<p/>";
    echo "<p>variable Two = $var2<p/>";

    $var3 = $var1;
    $var1 = $var2;
    $var2 = $var3;

    echo "<p>variable One = $var1<p/>";
    echo "<p>variable Two = $var2<p/>";
?>

<a href="index.php" class="btn btn-primary-outline">Back</a>

<?php 
    include 'includes/footer.php';
?>