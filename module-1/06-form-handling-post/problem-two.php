<?php
    $title = "Problem Two - Temperature Converter";
    include 'includes/header.php';

    $temperature = isset($_POST['temperature']) ? trim($_POST['temperature']) : '';
    $direction = isset($_POST['direction']) ? trim($_POST['direction']) : '';
    $message = '';
?>

<form 
    action="<?=htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <!-- Temperature Value (Number) -->
    <div class="mb-4">
        <label for="temperature" class="form-label">Temperature</label>
        <input type="number" name="temperature" id="temperature" class="form-control" placeholder="Please Enter a Number" value="<?= $temperature?>">
    </div>

    <!-- Direction (F to C || C to F) -->
    <fieldset class="mb-4">
        <legend class="fw-normal fs-6">Conversion Type</legend>

        <div class="form-check">
            <input type="radio" name="direction" id="c-to-f" class="form-check-input" value="c-to-f"<?php echo $direction === 'c-to-f' ? 'checked' : ''; ?>>
            <label for="c-to-f">Celcius to Farenheight</label>
        </div>

        <div class="form-check">
            <input type="radio" name="direction" id="f-to-c" class="form-check-input" value="f-to-c" <?php echo $direction === 'f-to-c' ? 'checked' : ''; ?>>
            <label for="f-to-c">Farenheight to Celcius</label>
        </div>

    </fieldset>

    <!-- Form Submission -->
    <input type="submit" name="submit" value="Convert" class="btn btn-primary">
</form>
<?php 
    if(isset($_POST['submit'])) {
        if($temperature === '') {
            $message= "<p class=\"fs-2 text-danger\">Invalid Temperature</p>";
        } elseif(!is_numeric($temperature)) {
            $message = "<p class=\"fs-2 text-danger\">Invalid Temperature </p>";
        } elseif (!in_array($direction, ['c-to-f', 'f-to-c'])) {
            $message = "<p class=\"fs-2 text-danger\">Please Select a conversion type</p>";
        } else {
            $temperature = (float) $temperature;
            if($direction === 'c-to-f') {
                $result = ($temperature * (9/5)) + 32;
                $message = "<p class=\"fs-2 text-success\">{$temperature}°C is {$result}F</p>";
            } else {
                $result = ($temperature - 32) * (5/9);
                $message = "<p class=\"fs-2 text-success\">{$temperature}°F is {$result}°C";
            }
            echo $message;
        }
    }
?>
<a href="index.php" class="btn btn-primary-outline">Back</a>

<?php 
    include 'includes/footer.php';
?>