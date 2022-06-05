<?php
session_start();
$code = $_POST['code'];
$parameters = '';

$random = substr(md5(mt_rand()), 0, 7);
$date = new DateTime();
$result = $date->format('Y-m-d-H-i-s');

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $filePath = "temp/$username/history/" . $result . ".alk";
}else{
    $filePath = "temp/newUser/history/" . $result . ".alk";
}

$programFile = fopen($filePath, "w");
fwrite($programFile, $code);
fclose($programFile);


if(isset($_POST["parameters"])) {
    $parametersArray = $_POST['parameters'];

    if($parametersArray){
        foreach($parametersArray as $element) {
            if($element == '-if'){
                $posIf = array_search('-if',$parametersArray);
                $parametersArray[$posIf] = '-i';
                $pos = array_search('-i',$parametersArray)+1;
                $val = $_SESSION['uploadedFile'];
                $parametersArray = array_merge(array_slice($parametersArray, 0, $pos), array($val), array_slice($parametersArray, $pos));
            }
            if($element == '-it'){
                $posIf = array_search('-it',$parametersArray);
                $parametersArray[$posIf] = '-i';
                $pos = array_search('-i',$parametersArray)+1;
                $val = $_POST['inputText'];
                if (isset($_POST['inputText']) && isset($_SESSION['username'])) {
                    $location = "temp/$username/input_uploads/". $result . ".alk";
                }else{
                    $location = "temp/newUser/input_uploads/". $result . ".alk";
                }
                $programFile = fopen($location, "w");
                fwrite($programFile, $val);
                fclose($programFile);

                $parametersArray = array_merge(array_slice($parametersArray, 0, $pos), array($location), array_slice($parametersArray, $pos));
            }
            if($element == '-p'){
                $pos = array_search('-p',$parametersArray)+1;
                $val = $_POST['precision'];
                $parametersArray = array_merge(array_slice($parametersArray, 0, $pos), array($val), array_slice($parametersArray, $pos));
            }
        }
        $parameters = join(" ",$parametersArray);
    }
}

$compiler_path = 'bin/alki.bat';
$output = exec("$compiler_path -a $filePath $parameters 2>&1");
echo editOutput($output);;

function editOutput($output): string
{
    $position = strrpos($output, 'off', 0);
    $output = substr($output, $position + 3);
    return "\n Output: \n".$output;
}





