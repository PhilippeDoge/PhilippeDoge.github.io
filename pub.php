<?php
// Define the directory to read images from
$dir = "image/";

// Open the directory and read its contents
if (is_dir($dir)) {
    $files = scandir($dir);

    // Remove the "." and ".." entries from the list of files
    $files = array_diff($files, array(".", ".."));

    // Choose a random image from the list
    $random_file = $files[array_rand($files)];

    // Display the image
    echo "<img src=\"$dir$random_file\">";
} else {
    echo "Error: $dir is not a directory";
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Image Gallery</title>
</head>
<body>

<img src="<?php echo $image; ?>>
</body>
</html>