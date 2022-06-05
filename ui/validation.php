<?php
session_start();
    $con = mysqli_connect('localhost', 'root', 'Parolaptmysql2.0');

    mysqli_select_db($con, 'sessionpractical');

    $name  = $_POST['username'];
    $pass  = $_POST['passwordLog'];

    if($name!=''){
        $statement = $con->prepare("SELECT password from registration where name=?");
        $statement->bind_param("s", $name);
        $statement->execute();
        $resultSet = $statement->get_result();
        $result =$resultSet->fetch_all();

        $hashed_password=$result[0][0];
        echo $hashed_password;

        //$q = "select * from registration where name = '$name'&& password = '$pass' ";

        //$result = mysqli_query($con, $q);
        //$num = mysqli_num_rows($result);

        //if($num == 1){
        if(password_verify($pass,$hashed_password)){
            $_SESSION['username'] = $name;
            unset($_SESSION['projectPath']);
            header('location:ideToggle.php');
        }else{
            header('location:slideLogin.php');
        }
    }else{
        header('location:slideLogin.php');
    }


?>
