<?php 

// NOTE: This file requires a record from the database

$continents_key = array(
    1 => "Latin America",
    2 => "North America &amp; Oceania",
    3 => "Western Europe",
    4 => "Middle East",
    5 => "Africa",
    6 => "South Asia",
    7 => "Eastern Erope &amp; Central Asia",
    8 => "East Asia",
);

$continent = $continents_key[$row['continent']];
$population = $row['population'] * 1000;

?>

<div class="card px-0">
    <div class="card-header text-bg-dark">
        <h3 class="card-title fw-light fs-5"> <?= $row['country']; ?> </h3>
    </div>
    <div class="card-body">
         <p class="card-text"><span class="fw-bold">Ranking: </span><?= $row['rank']; ?></p>
         <p class="card-text"><span class="fw-bold">Continent: </span> <?= $continent; ?> </p>
         <p class="card-text"><span class="fw-bold">Population: </span> <?= number_format($population); ?> </p>
         <p class="card-text"><span class="fw-bold">Life Expectancy: </span> <?= $row['life_expectancy']; ?> </p>
         <p class="card-text"><span class="fw-bold">Wellbeing: </span> <?= $row['wellbeing']; ?> </p>
         <p class="card-text"><span class="fw-bold">Happy Planet Index: </span> <?= $row['hpi']; ?> </p>
         <p class="card-text"><span class="fw-bold">GDP per Capita: </span> <?= "$" . number_format($row['gdp_per_capita']); ?> </p>
    </div>
</div>