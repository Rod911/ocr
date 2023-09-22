<?php
// upload file to assets dir with a random generated name
$target_dir = "assets/";
$input_name = "image";
if (isset($_FILES[$input_name])) {
	$imageFileType = pathinfo($_FILES[$input_name]["name"], PATHINFO_EXTENSION);
	$target_file = $target_dir . md5(time()) . "." . $imageFileType;
	$uploadOk = 1;
	// Check if image file is a actual image or fake image
	if (isset($_POST["submit"])) {
		$check = getimagesize($_FILES[$input_name]["tmp_name"]);
		if ($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	// if (file_exists($target_file)) {
	// 	echo "Sorry, file already exists.";
	// 	$uploadOk = 0;
	// }
	// Check file size
	// if ($_FILES[$input_name]["size"] > 500000) {
	// 	echo "Sorry, your file is too large.";
	// 	$uploadOk = 0;
	// }
	// Allow certain file formats
	if (
		in_array(strtolower($imageFileType), ["jpg", "jpeg", "png", "gif"]) === false
	) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES[$input_name]["tmp_name"], $target_file)) {
			// echo "The file " . $target_file . " has been uploaded.";
			header("Location: ocr.html?file=" . $target_file);
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
} else {
	echo "No file selected.";
}
