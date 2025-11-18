<?php 

// Start by creating an image object that is 512px by 512px large.
$image = imagecreate(512, 512);

// This is image is empty, lets fill it with a color
// red: rgb(255, 0, 0);
$red = imagecolorallocate($image, 255, 0, 0);

// 0, 0 means start top left
imagefill($image, 0, 0, $red);

// This tells the browser what MIME type we're dealing with. 
header("Content-type: image/png");

imagepng($image);

// Image has been output, now we free up resources for server (garbage collection)
imagedestroy($image)
?>