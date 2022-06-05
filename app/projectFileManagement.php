<?php
if($_POST["action"] == "fetch_file")
{
    $filePath = $_POST["filePath"];
    $file_content = file_get_contents($_POST["filePath"], true);
    $_SESSION["filePath"] = $filePath;
    echo $file_content;

}

if($_POST["action"] == "save")
{
    $filePath = $_POST["filePath"];
    $_SESSION["filePath"] = $filePath;
    $programFile = fopen($filePath, "w");
    ftruncate($programFile, 0);
    fwrite($programFile, $_POST["code"]);
    fclose($programFile);
    echo 'success';

}

if($_POST["action"] == "createFile")
{
    if(!file_exists($_POST["file_name"])) {
        $filePath = $_POST["filePath"].'/'. $_POST["file_name"];
        $programFile = fopen($filePath, "w");
        fwrite($programFile, "");
        fclose($programFile);
        echo 'file created';
    }
    else{
        echo 'File With the Same Name Already Exist';
    }

}

if($_POST["action"] == "createFolder")
{
    if(!file_exists($_POST["folder_name"])){
        mkdir($_POST["folderPath"].'/'.$_POST["folder_name"], 0777, true);
        echo 'Folder Created';
    }
    else{
        echo 'folder Already Created';
    }
}

if($_POST["action"] == "updateFolder")
{
    if(!file_exists($_POST['folder_path'])){
        rename($_POST['old_name'],$_POST['folder_path']);
        echo 'Folder Name Changed';
    }
    else{
        echo 'Folder Already Created';
    }
}

if($_POST["action"] == "delete")
{
    recursiveDelete($_POST["folder_name"]) ;
}

function recursiveDelete($str) {
    if (is_file($str)) {
        return @unlink($str);
    }
    elseif (is_dir($str)) {
        $scan = glob(rtrim($str,'/').'/*');
        foreach($scan as $index=>$path) {
            recursiveDelete($path);
        }
        return @rmdir($str);
    }
}

if($_POST["action"] == "updateFile")
{
    if(!file_exists($_POST['file_path'])){
        rename($_POST['old_name'],$_POST['file_path']);
        echo 'File Name Changed';
    }
    else{
        echo 'File Already Created';
    }
}

if($_POST["action"] == "deleteFile")
{
    if(file_exists($_POST['file_path'])){
        if (unlink($_POST['file_path'])) {
            echo'file was successfully deleted';
        } else {
            echo' there was a problem deleting the file';
        }
    }
}

