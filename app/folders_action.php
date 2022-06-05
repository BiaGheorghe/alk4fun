<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $filePath = "temp/$username";
}else{
    $filePath = "temp/newUser";
}
if(isset($_POST["action"])){
    if($_POST["action"]=="fetch"){
        $userFolders = array_filter(glob($filePath . '/*', GLOB_ONLYDIR), 'is_dir');

        $output = '
        <table class="table table-bordered table-striped">
            <tr>
                <th>folder name</th>
                <th>update</th>
                <th>delete</th>
                <th>download</th>
                <th>use project</th>
            </tr>
        ';

        if(count($userFolders)>0){
            foreach ($userFolders as $name) {
                $folderName = str_replace($filePath.'/', "", $name);
                if($folderName=='history' || $folderName == 'input_uploads'){
                    continue;
                }
                $output .='
                <tr>
                    <td>'.$folderName.'</td>
                    <td><button type ="button" name="update" data-name="'.$name.'" 
                                class="update btn btn-warning btn-xs">Update</td>
                    <td><button type ="button" name="delete" data-name="'.$name.'" 
                                class="delete btn btn-warning btn-xs">Delete</td>
                    <td><button type ="button" name="download" data-name="'.$name.'" 
                                class="download btn btn-warning btn-xs">Download</td>
                    <td><button type ="button" name="use" data-name="'.$name.'" 
                                class="use btn btn-warning btn-xs">Use</td>
                </tr>
                ';
            }
        }
        else{
            $output .='
            <tr>
                <td colspan="6" no folder found"</td>
            </tr>
            ';
        }
        $output .= '</table>';

        echo $output;
    }

    if($_POST["action"] == "create")
    {
        if(!file_exists($_POST["folder_name"])){
            mkdir($filePath.'/'.$_POST["folder_name"], 0777, true);
            echo 'Folder Created';
        }
        else{
            echo 'folder Already Created';
        }
    }

    if($_POST["action"] == "change")
    {
        if(!file_exists($_POST['folder_name'])){
            rename($_POST['old_name'],$_POST['folder_name']);
            echo 'Folder Name Changed';
        }
        else{
            echo 'Folder Already Created';
        }
    }


    if($_POST["action"] == "delete")
    {
        rrmdir($_POST["folder_name"]);
    }

    if($_POST["action"] == "download")
    {
        $folderPath = $_POST["folder_name"];
        $zipFile = $folderPath.'.zip';
        //touch($zipFile);

        $zip = new ZipArchive;
        //$thisZip = $zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE);


         if (zipDir($folderPath, $zipFile)){
             echo $zipFile;
         }
         else{
             echo 'nu s a putut realiza arhiva';
         }

    }

    if($_POST["action"] == "use")
    {
       $folderPath = $_POST["folder_name"];
        $_SESSION["projectPath"]= $folderPath;
        echo 'a fost folosit use';

    }
}

function zipDir($source, $destination): bool
{
    //Set file and folder counters
    $count_folders=0;
    $count_files=0;
    if (extension_loaded('zip')) {
        if (file_exists($source)) {
            $zip = new ZipArchive();
            if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
                //if line below is uncommented then the zip file will reflect and extract to the full server path
                //$source = realpath($source);
                if (is_dir($source)) {
                    $iterator = new RecursiveDirectoryIterator($source);
                    // ignore dot files
                    $iterator->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);
                    $files = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::SELF_FIRST);
                    foreach ($files as $file) {
                        //if line below is uncommented then the zip file will reflect and extract to the full server path
                        //$file = realpath($file);
                        if (is_dir($file)) {
                            $count_folders++;
                            $location = str_replace($source . "\\", '', $file . '/');
                            $zip->addEmptyDir($location);
                        } else if (is_file($file)) {
                            $count_files++;
                            $location = str_replace($source . '\\', '', $file);
                            $fileContent = file_get_contents($file);
                            $zip->addFromString($location, $fileContent );
                        }
                    }
                } else if (is_file($source)) {
                    $zip->addFromString(basename($source), file_get_contents($source));
                }
            }
            //echo 'Finished zipping - '.$count_files.' files in '.$count_folders.' folders<br>';
            return $zip->close();
        }
    }
    return false;
}

function rrmdir($dir) {
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
                    rrmdir($dir. DIRECTORY_SEPARATOR .$object);
                else
                    unlink($dir. DIRECTORY_SEPARATOR .$object);
            }
        }
        if(rmdir($dir)){
            echo "Project deleted";
        }else{
            echo "Project cannot be deleted";
        }
    }
}