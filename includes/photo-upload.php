<?php
$target_dir = getcwd() . DIRECTORY_SEPARATOR . "uploads" .  DIRECTORY_SEPARATOR;
$target_file = $target_dir . basename($_FILES["lenderphoto"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
move_uploaded_file($_FILES["lenderphoto"]["tmp_name"], $target_file);

?>