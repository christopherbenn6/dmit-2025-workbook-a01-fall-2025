<?php

$title = "Search";
include 'includes/header.php';
include 'includes/continents-key.php';

// Country Name Search
$country_search = isset($_GET['country-search']) ? trim($_GET['country-search']) : '';

// Selected Continents
$selected_continents = isset($_GET['continents']) ? ($_GET['continents']) : array();

// Wellbeing Variables
$wellbeing_comparison = $_GET['wellbeing-comparison'] ?? '';
$wellbeing_value = $_GET['wellbeing-value'] ?? '';

// Life Expectancy Variables
$min = $_GET['life-expectancy-min'] ?? 50;
$max = $_GET['life-expectancy-max'] ?? 90;


?>

<h2 class="display-5">Search Our Data</h2>
<p class="mb-5">Explore our data below by country name, continents, wellbeing score, and average lifespan. To get started select the options you'd like to use, and click the "Search" button. This will show you the filtered results based upon what you selected.</p>

<form action="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>" method="GET" class="mb-5 border border-success p-3 rounded shadow-sm">
    <h3 class="display-6">Advanced Search</h3>

    <!-- Country Name Search -->
    <fieldset class="my-5">
        <legend class="fs-5">Search By Country</legend>
        <div class="mb-3">
            <label for="country-search" class="form-label">Enter Country Name:</label>
            <input type="country-search" name="country-search" id="country-search" class="form-control" value="<?= $country_search; ?>">
        </div>
    </fieldset>

    <!-- Continents -->
    <fieldset class="my-5">
        <legend class="fs-5">Filter By Continent</legend>
        <p>Only show results from the following Continent(s):</p>
        <!-- This is our default value. It is empty. If the user chooses this, we will omit continent from our query (as we want to include them all and NOT EXCLUDE anything in this column) -->
        <div class="form-check">
            <input type="checkbox" id="continent-all" name="continents[]" value="<?= in_array("", $selected_continents) ? 'checked' : ""; ?> class="form-check-input">
            <label for="continent-all" class="form-check-label">All Continents</label>
        </div>

        <!-- loop through each continent in array and add a checkbox for each -->
        <?php foreach($continents_key as $id => $name) : ?>
            <div class="form-check">
                <input type="checkbox" id="continent-<?= $id; ?>" name="continents[]" value="<?= $id; ?>" class="form-check-input" <?= in_array((string) $id, $selected_continents) ? 'checked' : ""; ?>>
                <label for="continent-<?= $id; ?>" class="form-check-label"><?= $name; ?></label>
            </div>
        <?php endforeach; ?>
    </fieldset>

    <!-- Wellbeing -->
    <fieldset class="my-5">
        <legend class="fs-5">Filter By Wellbeing</legend>

        <!-- This is going to determine our comparison operator, We cannot directly pass '>' into a query due to htmlspecialchars -->
         <div class="mb-3">
            <label for="wellbeing-comparison" class="form-label">Only show countries with a score: </label>
            <select name="wellbeing-comparison" id="wellbeing-comparison" class="form-select">
                <option value="greater" <?php if($wellbeing_comparison == "greater") echo "selected"; ?>>Above</option>
                <option value="less" <?php if($wellbeing_comparison == "less") echo "selected"; ?>>Below</option>
            </select>
         </div>

         <!-- # for wellbeing value -->
          <div class="mb-3">
            <label for="wellbeing-value" class="form-label">The following value:</label>
            <input type="number" id="wellbeing-value" name="wellbeing-value" value="<?= $wellbeing_value; ?>" class="form-control">
          </div>
    </fieldset>

    <!-- Average Life Expectancy -->
    <fieldset class="my-5">
        <legend class="fs-5">Life Expectancy Range</legend>

        <!-- Min Age -->
        <div class="mb-3">
            <label for="life-expectancy-min" class="form-label">Minimum Age: </label>
            <input type="number" id="life-expectancy-min" name="life-expectancy-min" min="50" max="90" value="<?= $min ?>" class="form-control">
        </div>
            
        <!-- Max Age -->
        <div class="mb-3">
            <label for="life-expectancy-max" class="form-label">Maximum Age: </label>
            <input type="number" id="life-expectancy-max" name="life-expectancy-max" min="50" max="90" value="<?= $max ?>" class="form-control">
        </div>
    </fieldset>
    
    <!-- Submit -->
     <div class="mb-3">
        <input type="submit" id="submit" name="submit" value="Search" class="btn btn-success">
     </div>
</form>

<!-- Results -->

<?php

/*
    If the user chose to include everything, their query would look like this:
    SELECT * FROM happiness_index WHERE 1 = 1
    AND country LIKE '%country'
    AND continent IN ($continents) 
    AND wellbeing (> or <) $min AND $max;
*/
if(isset($_GET['submit'])) {
    echo '<section class="row justify-content-center my-5">';
    echo '<h2 class="display-5 mb-5">Results</h2>';

    $query = "SELECT * FROM happiness_index WHERE 1 = 1";

    // array to keep track of placeholders (?)
    $parameters = [];

    // We will assign the type as something like "i" - int for a later mysqli function
    $types = '';

    // BIG NOTE: THERE IS VERY LITTLE FORM VALIDATION (no time) SO YOU WOULD HAVE TO VALIDATE EVERYTHING

    // Country Search
    if(!$country_search == "") {
        // We cannot use "AND country LIKE '%?%' because thats searching for just ? (because its a string). So we use special function that will treat ? as placeholder
        $query .= " AND `country` LIKE CONCAT('%', ?, '%')";

        // php syntax allows to add to an array like this:
        $parameters[] = $country_search;

        $types .= 's';
    }

    // Continents (Checkboxes)

    // Checks if the user chose all continents (which has a value="") or if nothing was checked 
    if(!empty($selected_continents) && !in_array("", $selected_continents)) {

        // arrayfill function fills th array (starting at [0]) with a ? for each $selected_continents. we then implode this array to a string separated by a , to work with sql syntax
        $placeholders = implode(',', array_fill(0, count($selected_continents), '?'));

        $query .= " AND `continent` IN ($placeholders)";

        foreach ($selected_continents as $key => $continent) {
            // Usually php creates copies but & means no copy. This could've been an issue with later sql syntax
            $parameters[] = &$selected_continents[$key];
            $types .= "i";
        }
    }
    // Wellbeing Score (> or <)
    if($wellbeing_value != "" && is_numeric($wellbeing_value)) {
        $operator = $wellbeing_comparison == 'greater' ? '>' : '<';

        $query .= " AND `wellbeing` $operator ?";
        $parameters[] = &$wellbeing_value;
        $types .= "d";
    }
    // Life Expectancy Range

    // If we do not still have our default values, we'll add this to the query.
    if ($min != 50 || $max != 90) {
        $query .= " AND life_expectancy BETWEEN ? AND ?";

        $parameters[] = &$min;
        $parameters[] = &$max;

        $types .= "dd";
    } 
    // FOR DEBUGGING
        // echo "<p>" . $query . "</p>";
        // var_dump($parameters);
        // echo "<p>" . $types . "</p>";

    // Prepeare / Execute SQL

    if($statement = $connection->prepare($query)) {

        if($types != ""){
            $bind_names = [];
            $bind_names[] = $types;

            foreach($parameters as $key => $value) {
                $bind_names[] = &$parameters[$key];
            }

            // bind_params($statement, $bind_names[index]) for every parameter in bind names
            call_user_func_array([$statement, 'bind_param'], $bind_names);
        }

        $statement->execute();
        $result = $statement->get_result();

        // Displaying results
        if($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-6 col-xl-4 mb-4">';
                include 'includes/country-card.php';
                echo '</div>';
            }

        } else { // No results
            echo "<h3>No Results Found</h3>";
            echo "<p>No countries match your search criteria</p>";
        }
    } else {
        echo "<h3>Error Retrieving Results</h3>";
    }

    echo '</section>';
}

?>



<?php include 'includes/footer.php'; ?>