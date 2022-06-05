<?php
session_start();
if($_FILES["file"]["name"]!=''){
/*    $test = explode(".", $_FILES["file"]["name"]);
    $extension =end($test);
    $name = rand(100, 999).'.'.$extension;*/

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $location = "temp/$username/input_uploads/".$_FILES["file"]["name"];
    }else{
        $location = "temp/newUser/input_uploads/".$_FILES["file"]["name"];
    }

    move_uploaded_file($_FILES["file"]["tmp_name"], $location);
    $_SESSION['uploadedFile'] = $location;
}

?>