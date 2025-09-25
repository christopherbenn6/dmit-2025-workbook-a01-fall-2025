<?php
    // $pal = isset($_POST['pal']) ? $_POST['pal'] : '';
    // Shorter version called the null coalescing operator: 
    $pal = $_POST['pal'] ?? '';

    //returns true or false 
    function palindrom_check($string) {

        //strtolower makes it lowercase
        $string = strtolower($string);

        //str_replace = (what character/string we want to target ex. ' ' means space, what we replace it with, the string we want to do this with)
        $string = str_replace('  ', '', $string);

        //strrev reverses a string. $pal_check is a bool for if it is a palendrome
        $pal_check = ($string == strrev($string));

        return $pal_check;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palindrome Checker</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <section class="container py-5">
        <div class="row justify-center">
            <div class="col-md-8 col-md-6">
                <h1 class="text-center fw-light">Palindrome Checker</h1>
                <p class="text-center lead text-muted">Use the form below to check if your word is a palindrome</p>

                <hr class="my-5">

                <form action="<?=htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="mb-5">
                    <div>
                        <label for="pal" class="form-label">Your word or phrase</label>
                        <input type="text" id="pal" name="pal" value="<?= $pal ?>" class="form-control">
                    </div>
                    <input type="submit" id="submit" name="submit" value="Is this a palindrome?" class="btn btn-primary mt-3">
                </form>

                <?php
                    if(isset($_POST['submit'])) {
                        echo "<p>Your phrase was $pal</p>";
                        if(palindrom_check($pal)) {
                            echo "<p>Your phrase is a palindrome!";
                        } else {
                            echo "<p>Your phrase is NOT a palindrome!";
                        }
                    }
                ?>

                <hr class="my-5">

                <h2>What is a Palindrome?</h2>
                <p>A palindrome is a word, phrase, or sequence that reads the same backwards as forward.</p>
            </div>
        </div>
    </section>
</body>
</html>