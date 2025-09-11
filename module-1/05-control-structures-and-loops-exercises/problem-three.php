<?php
    $title = "Problem Two - Calendar";
    include 'includes/header.php';
    date_default_timezone_set("America/Edmonton");
    $day = date("l");
    $time = date("H");

    switch(true) {
        case ($time <= 6 || $time > 23);
            $funnyWord = 'twighlight';
            break;
        case ($time < 12);
            $funnyWord = 'morning';
            break;
        case ($time < 16);
            $funnyWord = 'afternoon';
            break;
        default;
            $funnyWord = 'evening';
            break;
    }

    switch ($day) {
        case 'Sunday';
            echo "<p>Tis the $funnyWord of Sunnudagr</p>";
            break;
        case 'Monday';
            echo "<p>Tis the $funnyWord of Mánadagr</p>"; 
            break;
        case 'Tuesday';
            echo "<p>Tis the $funnyWord of Týsdagr</p>"; 
            break;
        case 'Wednesday';
            echo "<p>Tis the $funnyWord of Óðinsdagr</p>"; 
            break;
        case 'Thursday';
            echo "<p>Tis the $funnyWord of Þórsdagr</p>"; 
            break;
        case 'Friday';
            echo "<p>Tis the $funnyWord of Freyjudagr</p>"; 
            break;
        case 'Saturday';
            echo "<p>Tis the $funnyWord of Laugardagr</p>"; 
        default;
            break;
    }
?>

<a href="index.php" class="btn btn-primary-outline">Back</a>

<?php 
    include 'includes/footer.php';
?>