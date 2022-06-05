
<?php
session_start();
require_once("uploaddir.class.php");
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $dirPath = "temp/$username";
}else{
    $dirPath = "temp/newUser";
}
$up = new UploadFolder();
$up->set_folder($dirPath);
$up->process($_POST["path"], $_FILES["file"]);

?>
