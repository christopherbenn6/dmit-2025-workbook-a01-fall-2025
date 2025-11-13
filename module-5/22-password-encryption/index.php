<?php

$first_password = $_POST['first-password'] ?? "";
$second_password = $_POST['second-password'] ?? "";
$is_match = NULL;

if($_SERVER['REQUEST_METHOD'] === "POST") {
    // Hash the first password as we normally would when a user registers an account. The default encryption method is currently BCrypt
    $first_hash = password_hash($first_password, PASSWORD_DEFAULT);

    // Unnecessary, just to see it's different
    $second_hash = password_hash($second_password, PASSWORD_DEFAULT);

    // Compares non hash to hash (second is in plain text, first is hash)
    $is_match = password_verify($second_password, $first_hash);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Encryption</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="container">
    <main class="row justify-content-center my-5">
        <section class="col col-md-10 col-lg-8">
            <h1 class="text-center display-6">How does password encription work?</h1>
            <p class="lead">Enter a password to see how password hashing works. Then, enter another to see if it matches the first</p>

            <?php if(!is_null($is_match)) : ?>
                <div class="my-3 text-center">
                    <p class="fs-4">When compared, PHP Determined that <?= $is_match ? "yes, these passwords match!" : "No, these passwords don't match" ?></p>
                </div>
            <?php endif; ?>


            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="mb-3">
                    <label for="first-password" class="form-label">First Password</label>
                    <input type="text" id="first-password" name="first-password" value="<?= $first_password; ?>" class="form-control">
                    <p class="form-text">Enter a string, password or phrase you'd like to test</p>
                </div>
                <?php if($first_password != "") : ?>

                    <div class="border border-warning rounded p-3">
                        <p class="form-text">For the first password, you entered: <?= $first_password ?></p>
                        <p class="form-text">When encrypted, it produced the following hash: <?= $first_hash ?></p>
                        <p class="form-text">In the real world, this password would be provided by the user during their accout registration, which would then go through an encryption algorythm and the resulting hash would be put into a secure database</p>
                    </div>

                    <div class="border border-warning rounded p-3">
                        <p class="form-text">For the second password, you entered: <?= $second_password ?></p>
                        <p class="form-text">When encrypted, it produced the following hash: <?= $second_hash ?></p>
                        <p class="form-text">In the real world, this password would be provided by the user when they attempt to log in. The PHP engine would then compare it to the hash stored in the database to see if it's statisticallylikely that the passwords are identical.</p>
                    </div>

                <?php endif; ?>

                <div class="mb-3">
                    <label for="second-password" class="form-label">Second Password</label>
                    <input type="text" id="second-password" name="second-password" value="<?= $second_password; ?>" class="form-control">
                    <p class="form-text">Now, enter another. This one can be identical or different to the one above.</p>
                </div>

                <input type="submit" id="submit" name="submit" value="Hash and Compare" class="btn btn-primary">
            </form>
        </section>
    </main>
</body>
</html>