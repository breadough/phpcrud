<?php
include 'functions.php';

$name = $_POST['ulam_name'];
$description = $_POST['ulam_description'];
$imagepath = strtolower($_FILES['ulam_picture']["name"]);

// upload an image
$target_dir = "img/";
$target_file = $target_dir . basename($_FILES["ulam_picture"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["ulam_picture"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  
  // Check file size
  if ($_FILES["ulam_picture"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
    echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
    $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["ulam_picture"]["tmp_name"], $target_file)) {
        $query = new QueryBuilder(
            Connection::make($config['database'])
        );
        $query->addUlam($name, $description, $imagepath);
        header('location: /');
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }