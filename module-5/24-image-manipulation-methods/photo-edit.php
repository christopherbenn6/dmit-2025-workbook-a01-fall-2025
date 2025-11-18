<?php 

// Instead of creating an image from nothing
$image = imagecreatefromjpeg("test-imgs/1x1.jpg");

// This method changes the gamma in the image
imagegammacorrect($image, 1.0, 2.0);

// Instead of outputting to the browser, lets try saving the image this time
imagejpeg($image, "test-imgs/image-output.jpeg");
// This image should create a new file to the workbook

imagedestroy($image);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image</title>
</head>
<body>
    <h1>Title Correction Demo</h1>
    <img src="test-imgs/image-output.jpeg" alt="This should be a camera">
</body>
</html>