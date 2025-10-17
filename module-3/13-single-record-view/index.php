<?php
    $title = 'Home';
    @include 'includes/header.php';
?>

<h2 class="display-5">Welcome to the Happy Planet Index</h2>
<p class="lead mb-5">The Happy Planet Index is a measure of sustainable well-being, ranking countries by how efficiently they deliver long, happy lives using our limited environmental resources.</p>

<?php

$sql = "SELECT `rank`, `country` FROM happiness_index;";

// OOP method
$result = $connection->query($sql); 

if($connection->error) : ?>
    <p>OH NO! There was an error retrieving the data</p>
<?php elseif ($result->num_rows > 0) : ?>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">HPI Ranks</th>
                <th scope="col">Country Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php

            while($row = $result->fetch_assoc()) {
                // This takes all row values and assigns each value to a variable with the column's name.
                extract($row);

                echo "
                    <tr> \n
                        <td>$rank</td> \n
                        <td>$country</td> \n
                        <td><a href=\"country.php?rank=" . urlencode($rank) . "&country=" . urlencode($country) . "\">View Stats</a></td> \n
                    </tr> \n
                ";
            }

            ?>
        </tbody>
    </table>

<?php
    endif;
    @include 'includes/footer.php'
?>