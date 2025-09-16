<?php
    $title = "Problem One - Even or Odd";
    include 'includes/header.php';

    //Ternary Statement: Says if $_post[number] is set, use that value (but trimmed), otherwise its empty
    $number = isset($_POST['number']) ? trim($_POST['number']) : '';
?>
<!-- ACTION: Where are we sending this data
     METHOD: $_GET / $_POST 
     name="" IS REQUIRED TO GET DATA-->

<form 
    action="<?=htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="mb-3">
        <label for="number" class="form-label">Enter a Number</label>
        <input type="text" id="number" class="form-control" name="number" placeholder="ex. 1" step="1" value="<?= $number?>" required>
        
    </div>
    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
</form>
<?php 
    if(isset($_POST['submit'])) {
        if($number === ''){
            $message = "<p class=\"fs-2 text-danger\">Please enter a value</p>";
        } elseif (filter_var($number, FILTER_VALIDATE_INT) !== FALSE) {
            $number = (int) $number;
            if($number % 2 == 0) {
                $message = "<p class=\"fs-2 text-success\">This Number is Even</p>";
            } else {
                $message = "<p class=\"fs-2 text-danger\">This Number is Odd</p>";
            }
        } else {
            $message = "<p class=\"fs-2 text-danger\">Invalid Number</p>";
        }
        echo $message;
    }
?>
<a href="index.php" class="btn btn-primary-outline">Back</a>

<?php 
    include 'includes/footer.php';
?>