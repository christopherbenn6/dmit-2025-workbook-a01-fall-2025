<?php

// These 2 lines of code import our credentials (i.e. the things MySQL needs in order to be authenticated and access the database) and create a connection handle.

// '__DIR__' gives us the script's current directory. The '2' then lets us jump 2 levels up. Finally, the appended path brings us to the data/ directory

use Dom\Mysql;

require_once dirname(__DIR__, 2) . '/data/connect.php';
$connection = db_connect()

?>


<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Canadian Cities Queries</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    </head>

    <body class="container p-3">
        <header class="text-center row justify-content-center my-5">
            <section class="col col-md-10 col-xl-8">
                <h1 class="display-3">Canadian Cities Queries</h1>
                <p class="lead">The answers to all of the following questions are being pulled from the records we currently have stored in our database, one query at a time. This is done programatically, using MySQLi to fetch the records and PHP to display the results to the user. Every single time this page is loaded (or reloaded), the queries are run again.</p>
            </section>
        </header>

        <main class="row justify-content-center">
            <section class="col col-md-10 col-lg-8 col-xxl-6">
                <h2 class="display-4">Questions and Answers</h2>

                <h3 class="mt-4">Question 1: Which city has the highest population?</h3>

                <?php
                
                // The statement php will execute
                $sql = "SELECT city_name FROM cities ORDER BY population DESC LIMIT 1;";

                // The result of sql
                $result = mysqli_query($connection, $sql);

                if(mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    echo "<p>The city with the highest population is " . $row['city_name'] . "</p>";
                } else {
                    echo "<p>No cities found</p>";
                }

                ?>

                <h3 class="mt-4">Question 2: What are the names of all of the cities stored in our database, in alphabetical order?</h3>

                <?php
                
                $sql = "SELECT city_name FROM cities ORDER BY city_name ASC;";

                $result = mysqli_query($connection, $sql);

                if(mysqli_num_rows($result) > 0) {
                    // multiple results, we need an array
                    $cities = array();
                    while($row = mysqli_fetch_assoc($result)) {
                        $cities[] = $row['city_name'];
                    }

                    // IMPLOSIONS?? (array into string)
                    echo "<p>The following cities in our database are displayed here:" . 
                    implode(', ', $cities) . ".</p>";
                } else {
                    echo "<p>No cities found</p>";
                }


                ?>

                <h3 class="mt-4">Question 3: Which cities are located in the province of "QC" (Quebec)?</h3>

                <?php
                
                $sql = "SELECT city_name, province FROM cities WHERE province = 'QC' ORDER BY city_name ASC;";

                $result = mysqli_query($connection, $sql);

                if(mysqli_num_rows($result) > 0) {
                    // multiple results, we need an array
                    $cities = array();
                    while($row = mysqli_fetch_assoc($result)) {
                        $cities[] = $row['city_name'];
                    }

                    // IMPLOSIONS?? (array into string)
                    echo "<p>The following cities in our database are displayed here:" . 
                    implode(', ', $cities) . ".</p><br>";
                } else {
                    echo "<p>No cities found</p>";
                }

                ?>

                <h3 class="mt-4">Question 4: Count the number of cities in each province.</h3>

                <?php

                $sql = "SELECT province, COUNT(*) AS city_count FROM cities GROUP BY province ORDER BY city_count DESC;";
                $result = mysqli_query($connection, $sql);

                if(mysqli_num_rows($result) > 0) : ?>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Province or Territory</th>
                                <th>Number of Cities</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td><?= $row['province'] ?></td>
                                    <td><?= $row['city_count'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                <?php else : ?>
                    <p>No cities found.</p>
                <?php endif; ?>

                <h3 class="mt-4">Question 5: Retrieve the city names and populations for cities with a population greater than 500,000.</h3>

                <?php

                $sql = "SELECT city_name, population FROM cities WHERE population > 500000";
                $result = mysqli_query($connection, $sql);

                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<p>" . $row['city_name'] . "'s population is <b>" . number_format($row['population']) . "</b></p>";
                    }
                } else {
                    echo "<p>No cities found.</p>";
                }

                ?>

                <h3 class="mt-4">Question 6: Sort the cities in alphabetical order by their names.</h3>

                <?php

                $sql = "SELECT * FROM cities";
                $result = mysqli_query($connection, $sql);

                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<p></p>";
                    }
                } else {
                    echo "<p>No cities found.</p>";
                }

                ?>

                <h3 class="mt-4">Question 7: Calculate the average population of all cities.</h3>

                <?php

                $sql = "SELECT AVG(population) as average FROM cities ORDER BY population";
                $result = mysqli_query($connection, $sql);

                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<p>The average population of all cities is " . number_format($row['average']) . "</p>";
                    }
                } else {
                    echo "<p>No cities found.</p>";
                }

                ?>

                <h3 class="mt-4">Question 8: Find the city with the smallest population.</h3>

                <?php

                $sql = "SELECT city_name, population FROM cities ORDER BY population ASC LIMIT 1";
                $result = mysqli_query($connection, $sql);

                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<p>The least populated city is " . $row['city_name'] . " with a population of " . $row['population'] . "</p>";
                    }
                } else {
                    echo "<p>No cities found.</p>";
                }

                ?>

                <h3 class="mt-4">Question 9: List the cities located in provinces starting with the letter "N".</h3>

                <?php

                $sql = "SELECT city_name, province FROM cities WHERE province LIKE 'N%'";
                $result = mysqli_query($connection, $sql);

                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<ul>";
                        echo "<li>" . $row['city_name'] . " : " . $row['province'] . "</li>";
                        echo "</ul>";
                    }
                } else {
                    echo "<p>No cities found.</p>";
                }

                ?>

                <h3 class="mt-4">Question 10: Retrieve the city names and populations for cities with populations between 100,000 and 500,000.</h3>

                <?php

                $sql = "SELECT city_name, population FROM cities WHERE population BETWEEN 100000 AND 500000";
                $result = mysqli_query($connection, $sql);

                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<ul>";
                            echo "<li>" . $row['city_name'] . " : " . $row['population'] . "</li>";
                        echo "</ul>";
                    }
                } else {
                    echo "<p>No cities found.</p>";
                }

                ?>

                <h3 class="mt-4">Question 11: Retrieve the total population for each province in the "cities" table.</h3>

                <?php

                $sql = "SELECT province, SUM(population) AS total_pop FROM cities GROUP BY province ORDER BY total_pop";
                $result = mysqli_query($connection, $sql);

                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<ul>";
                            echo "<li>" . $row['province'] . " : " . $row['total_pop'] . "</li>";
                        echo "</ul>";
                    }
                } else {
                    echo "<p>No cities found.</p>";
                }

                ?>

            </section>
        </main>
    </body>
</html>

<?php

db_disconnect($connection);

?>