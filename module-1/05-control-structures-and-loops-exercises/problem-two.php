<?php
    $title = "Problem Two - Times Tables";
    include 'includes/header.php';
?>
<table class="table table-striped">
    <tbody>
        <tr>
        </tr>
        <?php
            $value = 973;
            for($i = 1; $i <= 20; $i++) {
                $result = $value * $i;
                echo "<tr>
                        <td class=\"border border-primary p-2\">$i x $value</td>
                        <td class=\"border border-primary p-2\">$result</td>
                      </tr>";
            }
            //echo "<td> . ($i * $value) . </td>"
        ?>
    </tbody>
</table>
<a href="index.php" class="btn btn-primary-outline">Back</a>

<?php 
    include 'includes/footer.php';
?>