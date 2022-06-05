<?php

$mainFolder = true;
$output='';
function ListFolder($path)
{

    //using the opendir function
    if (is_dir($path)){

        if($GLOBALS['mainFolder'] == true){
            $GLOBALS['mainFolder'] = false;
        }
        $dir_handle = @opendir($path) or die("Unable to open $path");
        //Leave only the lastest folder name
        $latestFolderName = explode("/", $path);
        $dirname = end($latestFolderName);

        //display the target folder.
        echo("<li>
               <input type='checkbox'  hidden id=".$dirname." />
               <label oncontextmenu='rightClickFolder(event,\"$path\")' for=".$dirname." style=' background-color: transparent;
                                                                                                 font-family: sans-serif;   
                                                                                                 color: #174a69;
                                                                                                 font-size: 16px;
                                                                                                 background-repeat: no-repeat;
                                                                                                 border: none;
                                                                                                 cursor: pointer;
                                                                                                 overflow: hidden;
                                                                                                 outline: none; ' 
               >".$dirname."</label>");
        echo "<ul>";
        while (false !== ($file = readdir($dir_handle))) {
            if ($file != '.' && $file != '..') {
                if (is_dir($path . '/' . $file)) {
                    //Display a list of sub folders.
                    ListFolder($path . '/' . $file);
                } else {
                    //Display a list of files.
                    $folderPath = $path . '/' . $file;
                    echo "<li><button name='displaybtn' type='button' class='file_btn' onclick='copyCode(\"$folderPath\")' oncontextmenu='rightClickFile(event,\"$folderPath\")' style='  
                                                                                                 background-color: transparent;
                                                                                                 color: #174a69;
                                                                                                 font-family: sans-serif;   
                                                                                                 font-size: 16px;
                                                                                                 background-repeat: no-repeat;
                                                                                                 border: none;
                                                                                                 cursor: pointer;
                                                                                                 overflow: hidden;
                                                                                                 outline: none; ' 
                                      id='".$file."'>".$file."</button></li>";
                }
            }
        }
        echo "</ul>\n";
        echo "</li>\n";

        //closing the directory
        closedir($dir_handle);
    }


}


?>