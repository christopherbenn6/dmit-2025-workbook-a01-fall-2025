<?php

$title = "Search";
include 'includes/header.php';
include 'includes/continents-key.php';

// Country Name Search
$country_search = isset($_GET['country-search']) ? trim($_GET['country-search']) : '';

// Selected Continents
$selected_continents = isset($_GET['continents']) ? ($_GET['continents']) : array();

// Wellbeing Variables
$wellbeing_comparison = isset($_GET['wellbeing-comparison']) ?? '';
$wellbeing_value = isset($_GET['wellbeing-value']) ?? '';

// Life Expectancy Variables
$min = isset($_GET['life-expectancy-min']) ?? 50;
$max = isset($_GET['life-expectancy-max']) ?? 90;


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
                <option value="greater" <?php if($wellbeing_comparison == "above") echo "selected"; ?>>Above</option>
                <option value="less" <?php if($wellbeing_comparison == "below") echo "selected"; ?>>Below</option>
            </select>
         </div>

         <!-- # for wellbeing value -->
          <div class="mb-3">
            <label for="wellbeing-value" class="form-label">The following value:</label>
            <input type="number" id="wellbeing-value" name="wellbeing-value" min="1" max="10" value="<?= $wellbeing_value; ?>" class="form-control">
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

?>



<?php include 'includes/footer.php'; ?>