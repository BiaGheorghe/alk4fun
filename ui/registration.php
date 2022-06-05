<?php
    session_start();
    //header('location:slideLogin.html');
    $con = mysqli_connect('localhost', 'root', 'Parolaptmysql2.0');

    mysqli_select_db($con, 'sessionpractical');

    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pass  = $_POST['passwordReg'];
    $secure_pass = password_hash($pass, PASSWORD_BCRYPT);

    $q = "select * from registration where name = '$name' && email = '$email'";

    $result = mysqli_query($con, $q);
    $num = mysqli_num_rows($result);

if($num == 1){
    echo "<script>alert('User with the same username email combination already exists');window.location.href='slideLogin.html';</script>";

}else{
    $qy = "insert into registration(name, email, password) values('$name', '$email', '$secure_pass') ";
    mysqli_query($con, $qy);
    mkdir ("../app/temp/$name", "0777");
    mkdir ("../app/temp/$name/input_uploads", "0777");
    header("location:slideLogin.html");
}

?>

