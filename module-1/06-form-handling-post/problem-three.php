<?php
    $title = "Problem Three - Vowel Counter";
    include 'includes/header.php';

    $orig_text = isset($_POST['text']) ? trim($_POST['text']) : '';
    $text = mb_strtolower($orig_text);
    $vowels = ['a', 'e', 'i', 'o', 'u'];
    $message = '';
?>
<!--  -->

<form action="<?=htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="mb-4">
        <label for="text">Enter a Sentence Below</label>
        <input type="text" id="text" name="text" class="form-control" placeholder="ex. hello world" value="<?= $orig_text?>">
    </div>
    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
</form>
<?php
    if(isset($_POST['submit'])) {
        echo "balls";
        if($text === '') {
            $message = "<p>Please submit a string</p>";
        } else if(is_string($text)) {
            $vowel_count = 0;
            foreach(str_split($text) as $ch) {
                if(in_array($ch, $vowels, true)) {
                    $vowel_count++;
                }
            }
            $message = "<p>This sentence has $vowel_count vowels</p>";
        } else {
            $message = "<p>Please submit a string</p>";
        }
    }
    echo $message;
?>
<a href="index.php" class="btn btn-primary-outline">Back</a>
<?php 
    include 'includes/footer.php';
?>