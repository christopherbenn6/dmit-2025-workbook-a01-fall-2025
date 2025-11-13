<?php

    // Retrieve the country name and ranking from the query string
    $rank = isset($_GET['rank']) ? urldecode($_GET['rank']) : '';
    $rank = htmlspecialchars($rank, ENT_QUOTES, 'UTF-8');

    $country = isset($_GET['country']) ? urldecode($_GET['country']) : '';
    $country = htmlspecialchars($country, ENT_QUOTES, 'UTF-8');

    $title = 'Country Statistics';
    @include 'includes/header.php';

    // If we're missing a value in the qquery string, we'll display an error right away
    if($rank == "" || $country == "") {
        echo "<h2 class=\"display-5\">Oh no!</h2>";
        echo "<p class=\"lead\">We couldn't find the country you're looking for</p>";
    } else {
        // Because user can change the result of the query, we must use a prepared statement
        $query = "SELECT * FROM `happiness_index` WHERE `rank` = ?;";

        /*
            A prepared statement uses a ? (placeholder) instead of the raw vlue (ex. $rank). This gives us an additional layer of security (via level of abstraction) and makes us substantially less vulnmerablue to attacks like SQL injections. This essentially take the literal value.
        */
        if($statement = $connection->prepare($query)) {
            $statement->bind_param("i", $rank);
            $statement->execute();
            $result = $statement->get_result();
            if ($row = $result->fetch_assoc()) {
                echo "<h2 class=\"display-5\">" . $row['country'] . " Statistics</h2>";
                include 'includes/country-card.php';
            }
        } else {
            die("QUERY PREPARATION FAILED YOU BASTARD" . $connection->error);
        }
    } 
?>


<!-- Back Button -->
<a href="index.php" class="btn btn-dark mt-4">Return to Index</a>

<?php
    @include 'includes/footer.php'
?>