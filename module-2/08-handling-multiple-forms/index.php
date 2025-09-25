<?php 
    // Retain data set length from Get or Post
    $set_length = '';

    switch (true) {

        case isset($_GET['set-length']):
            $set_length = htmlspecialchars($_GET['set-length']);
            break;

        case isset($_POST['set-length']):
            $set_length = htmlspecialchars($_POST['set-length']);
            break;

        default:
            $set_length = '';
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mean, Median, &amp; Mode Calculator</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <main class="container mt-5">
        <section class="row justify-content-center">
            <div class="col-md-10 col-lg-9 col-xxl-8">
                <h1 class="mb-5 text-center">Mean, Median, &amp; Mode Calculator</h1>
                <div class="row">
                    <!-- Introduction & Definitions -->
                    <div class="col-md-6">
                        <aside class="card">
                            <div class="card-header bg-info">
                                <h2 class="card-title">What are Mean Median and Mode?</h2>
                            </div>
                            <div class="card-body">
                                <p class="mb-4 text-body-secondary">The mean, median and mode are different ways of figuring out the 'center', or a 'typical' data point in a given set of numbers.</p>
                                <dl>
                                    <dt>Mean</dt>
                                    <dd>The 'average' number; found by adding all data points and dividing by the number of data points</dd>

                                    <dt>Median</dt>
                                    <dd>The 'middle' number; found by ordering all data points and picking out the one in the middle.</dd>

                                    <dt>Mode</dt>
                                    <dd>The most 'frequent'; number that is the number that occurs the highest number of time.s</dd>
                                </dl>
                            </div>
                        </aside>
                    </div>
                    <div class="col-md-6">
                        <!-- In this script we echo final calculations. We put it here so the final results appear at the top of the page -->
                        <?php include 'process.php'?>

                        <!-- Asks for number of data points (how many numbers) -->
                        <form action="<?=htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET" class="mb-5">
                            <div class="mb-3">
                                <label for="set-length" class="form-label">How many numbers are in your dataset?</label>
                                <input type="number" id="set-length" name="set-length" value="<?=$set_length?>"class="form-control">
                            </div>

                            <input type="submit" name="submit-get" id="submit-get" value="Generate Form" class="btn btn-info">
                        </form>

                        <!-- If $set_length is set, then the form will appear -->
                        <?php if($set_length != '') : ?> 
                            <form action="<?=htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                <!-- This wont show, but is a vessel to store the input of the first form -->
                                <input type="hidden" name="set-length" id="post-set-length" value="<?= $set_length ?>">

                            <?php 
                                for($i = 1; $i <= $set_length; $i++) {
                                    //If user has already filled out the form, we want to keep that value
                                    $value = isset($_POST["num-{$i}"]) ? htmlspecialchars($_POST["num-{$i}"]) : '';
                                    echo "<div class=\"mb-3\">
                                            <label for=\"num-{$i}\" class=\"form-label\">Enter Number {$i}</label> \n
                                            <input type=\"number\" class=\"form-control\" name=\"num-{$i}\" id=\"num-{$i}\" value=\"{$value}\" required> \n
                                        </div> \n";
                                } 
                            ?>
                            <input type="submit" id="submit-post" name="submit-post" class="btn btn-info my-4" value="Calculate">
                        </form>
                        <?php endif; ?> 
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>