<!doctype html>
<html lang="en">
  <head>
    <!-- Required Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Comparison Operators, Logical Operators, Control Structures, & Loops</title>

    <!-- BS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  </head>
  <body class="container text-center">
    <section class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="display-5 my-5">Comparison Operators, Logical Operators, Control Structures, & Loops</h1>

            <h2 class="display-6 my-5">Comparison Operators</h2>
            <p class="lead">Used to compare two values (e.g., <code>==</code>, <code>!=</code>, <code>&lt;</code>, <code>&gt;</code>), returning <code>true</code> or <code>false</code>.</p>

            <?php
              $x = 6;
              if($x == 6) {
                echo '<p> X equals 6 </p>';
              }
              if($x === 6) {
                echo '<p>X equals 6 and is the same data type</p>';
              }
              if($x != 5) {
                echo '<p>X is NOT 5</p>';
              }
              if($x > 5) {
                echo '<p>X is a pretty big boy</p>';
              }
              if($x < 7) {
                echo '<p>X is a pretty small boy</p>';
              }
            ?>

            <h2 class="display-6 my-5">Logical Operators</h2>
            <p class="lead">Combine multiple conditions using <code>&amp;&amp;</code> (AND), <code>||</code> (OR), and <code>!</code> (NOT).</p>

            <?php 
              if($x > 2 && $x < 19) {
                echo '<p>X is a medium boy</p>';
              }
              if($x > 4 || $x < 1){
                echo '<p>X exists idk anymore</p>';
              }
              if($x > 2 xor $x > 10) {
                echo '<p>x esiststs</p>';
              }
            
            ?>

            <h2 class="display-6 my-5">Control Structures</h2>
            <p class="lead">Direct the flow of your program based on conditions.</p>

            <h3 class="my-3">Nested If/Else Block</h3>
            <p class="lead">An <code>if</code> or <code>else</code> statement placed inside another to check multiple layers of conditions.</p>
            <?php 
              $x = 'STRING!';
              if($x === 5) {
                $message = '<p>X is 5</p>';
              } elseif ($x === 6){
                $message = '<p>X is 6</p>';
              } elseif (is_numeric($x) && ($x < 10 || $x > 4)){
                
              } else {
                $message = '<p>balls</p>';
              }

              // NOTE: DOING MATH ON A STRING CONSIDERS IT AS 0 

              //isset returns true or false if it is initialized 
              if(isset($message)) {
                echo $message;
              }
            ?>

            <h3 class="my-3">Switch Statement</h3>
            <p class="lead">A cleaner way to check a single variable against many possible values using <code>switch</code> and <code>case</code>.</p>
            <?php
            $x = 8;
            // we want a true statement
              switch (true){
                case $x === 5;
                  $message = '<p>X is 5 </p>';
                  break;

                case $x === 6;
                  $message = '<p>X is 6</p>';
                  break;

                // this is called a fallthrough case, used to evaluate multiple things at once, kinda like and OR statement
                case $x > 10;
                case $x < 7;
                  $message = '<p>DOUBLE TIME SWITCH CASE</p>';
                  break;

                default;
                  $message = '<p>This is so sad</p>';
                  break;
              }
              if(isset($message)) {
                echo $message;
              }
            ?>

            <h3 class="my-3">PHP 8+ Alternative: <code>match</code> Expression</h3>
            <p class="lead">A more concise and safer alternative to <code>switch</code>, introduced in PHP&nbsp;8, using the <code>match</code> expression.</p>
            <?php

              /* This is a match expression, it uses strict comparison and has concise syntax
                however it is functionally the same as if and switch statements */
                $message = match (true) {
                  $x === 5        => '<p>X is 5 </p>',
                  $x === 6        => '<p>X is 6 </p>',
                  $x > 10, $x < 7 => '<p>X is greater than 10 or less than 7</p>',
                  default         => '<p>NOOOOOOOOOO</p>'
                };
                if(isset($message)) {
                  echo $message;
              }
            ?>

            <h2 class="display-6 my-5">Loops</h2>
            <p class="lead">Repeat blocks of code while a condition is <code>true</code>.</p>

            <h3 class="my-3">While Loop</h3>
            <p class="lead">Repeats code as long as a condition stays <code>true</code>, checking the condition <em>before</em> each run.</p>
            <?php
              $i = 0;
              while($i < 5) {
                $i++;
                echo "<p>$i</p>";
              }
            ?>

            <h3 class="my-3">Do/While Loop</h3>
            <p class="lead">Runs code <em>at least once</em>, then keeps looping if the condition is still <code>true</code>.</p>
              <?php
                $j = 0;
                do {
                  $j++;
                  echo "<p>$j</p>";
                } while($j < 5);
              ?>
            <h3 class="my-3">For Loop</h3>
            <p class="lead">Repeats code a specific number of times using a counter: <code>for (start; condition; update)</code>.</p>
                <?php
                  for($f = 1; $f < 10; $f++) {
                    echo "<p>$f</p>";
                  }
                ?>
            <h3 class="my-3">For Each Loop</h3>
            <p class="lead">Loops through each item in an array using <code>foreach ($array as $item)</code>.</p>
              <?php
                // We will be using a "Super Global" array ($_Server) DO NOT DO THIS BEYOND PROD
                foreach($_SERVER as $key => $value){
                  echo "<p>$key : $value</p>";
                }
              ?>
        </div>
    </section>
  </body>
</html>