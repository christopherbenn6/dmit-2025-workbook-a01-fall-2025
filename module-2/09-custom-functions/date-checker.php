<?php
    $date = $_POST['date'] ?? '';

    //This function validates a date format. Returns true / false.
    function validate_date($date) {

        // We need to compare in the same format. This is the format we use.
        $date_format = 'Y-m-d';

        $parsed_date = date_parse_from_format($date_format, $date);

        //Checks if format entered has errors, and if date exists (no Feb 30)
        return $parsed_date['error_count'] === 0 && checkdate($parsed_date['month'], $parsed_date['day'], $parsed_date['year']);
    }

    //This Function calculates the days difference (In days) between two days (today and the user's provided date)
    function calculate_days_difference($date) {
        //The current date of the server
        $current_date = date('Y-m-d');

        // Dates are strings, however unix time is an interger (Jan 1 1970 time counter). This converts to unix time and calculates the difference
        $difference = strtotime($current_date) - strtotime($date);
        
        //Return difference in days
        return round($difference / (60 * 60 * 24));
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date Checker</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <section class="container py-5">
        <div class="row justify-center">
            <div class="col-md-8 col-md-6">
                <h1 class="text-center fw-light">Date Checker</h1>
                <p class="text-center lead text-muted">Want to know how many days it's been since something happened? What about a countdown until a day in the future? Enter a date below to check how many days are between then and now</p>

                <hr class="my-5">

                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="mb-5">
                    <div>
                        <label for="date" class="form-label">Enter a Date</label>
                        <input type="date" id="date" name="date" value="<?= $date ?>" class="form-control">
                    </div>
                    <input type="submit" id="submit" name="submit" value="Check Date" class="btn btn-primary mt-3">
                </form>
                <?php
                    if($_SERVER['REQUEST_METHOD'] === 'POST') {
                        // Validate the date the user provided
                        if(validate_date($date)) {
                            // IF date is valid we compare
                            $days_difference = calculate_days_difference($date);
                            if($days_difference < 0) {
                                $days_difference = abs($days_difference);
                                echo "<p>It will be $days_difference days until $date";
                            } else if ($days_difference > 0) {
                                echo "<p>It has been $days_difference days since $date";
                            } else {
                                echo "<p>TODAY IS THE DAY FERB";
                            }
                        } else {
                            echo "<p class=\"text-danger\">Invalid date format.</p>";
                        }
                    }
                ?>


            </div>
        </div>
    </section>
</body>

</html>