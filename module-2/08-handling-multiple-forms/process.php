<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nums = array();

    // Maps the post array into an indexed array rather than an associative array
    for ($i = 1; $i <= $set_length; $i++) {
        // Unique to PHP, this adds each $_POST["num-{$i}"] to the nums array
        $nums[] = $_POST["num-{$i}"];
    }

    // sorts numbers in ascending order by default 
    sort($nums);

    // MEAN

    $mean = array_sum($nums) / count($nums);
    // echo $mean;

    // MEDIAN

    $middle = floor((count($nums) - 1) / 2);
    if (count($nums) % 2 == 0) {
        $median = ($nums[$middle] + $nums[$middle + 1] / 2);
    } else {
        $median = $nums[$middle];
    }
    // MODE

    // This takes the array $nums and returns an associative array where the keys are the unique values from $nums and the vakues are the count of how many times each value appears in the array.
    $mode = array_count_values($nums);

    $mode = array_keys($mode, max($mode));

    // implode() is a php method that concatonates the elements of an array into a single string using a specified delimiter
    $mode = implode(', ', $mode);

    echo "<div class=\"alert alert-info\" role=\"alert\">
            <p>Your numbers were: " . implode(', ', $nums) . "</p> \n
            <p>Mean: {$mean}</p> \n
            <p>Median: {$median}</p>\n
            <p>Mode: {$mode}</p> \n
        </div>";
}
