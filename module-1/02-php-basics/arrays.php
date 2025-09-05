<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Insult Generator</title>

    <!-- BS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body class="container text-center">
    <section class="row min-vh-100 align-items-center justify-content-center">
        <div class="col-lg-8">
            <h1 class="display-5 mb-4">Insult Generator</h1>
            <?php
              if(isset($_POST['generate-btn'])) {
                $adjectives = array('bloody', 'witless', 'lousy', 'lumpy', 'crusty', 'stinky', 'stupid', 'ill-mannered', 'mayonaisse filled');
                $nouns = array('gremlin', 'fungus', 'goblin', 'juggler', 'cow', 'gambler', 'league player', 'valorant player');

                $first_word = $adjectives[rand(min: 0, max: count(value: $adjectives) - 1)];
                $second_word = $nouns[rand(min: 0, max: count(value: $nouns) - 1)];

                echo '<p class="fs-3">' . $first_word . ' ' . $second_word . "</p>";
              }
            ?>
            <form method="POST">
              <input type="submit" class="btn btn-primary mb-3" name="generate-btn" id="generate-btn" value="Generate Insult">
            </form>
            <a href="index.php" class="btn btn-outline-primary">Return to Table of Contents</a>
        </div>
    </section>
  </body>
</html>