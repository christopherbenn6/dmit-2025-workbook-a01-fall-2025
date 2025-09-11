<?php
    $title = "Problem One - Value Checker";
    include 'includes/header.php';
    $value = 0;
    switch (true) {
        case (!is_numeric($value));
            echo "<p>$value is not a number</p>";
            break;
        case $value > 0;
            echo "<p>$value is a Positive Number</p>";
            break;

        case $value < 0;
            echo "<p>$value is a Negative Number</p>";
            break;

        default; 
            echo "<p>$value is 0</p>";
            break;
    }
?>

<a href="index.php" class="btn btn-primary-outline">Back</a>

<?php 
    include 'includes/footer.php';
?>