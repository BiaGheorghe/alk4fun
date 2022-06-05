<?php
function LoginLogout()
{
    if (isset($_SESSION['username'])) {
        echo '<form class="login-logout-form" action="logout.php" method="post">
            <button class="btn">Logout</button>
          </form>';
    } else {
        echo '<form class="login-logout-form" action="goToLoginPage.php" method="post">
            <button class="btn">Login</button>
          </form>';
    }
}

function welcomeMsg(){
    if (isset($_SESSION['username'])) {
        $userName = $_SESSION['username'];
        echo 'Hi, '.$userName;
    } else {
        echo 'Hi, guest';
    }
}
