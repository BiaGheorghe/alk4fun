<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration Page</title>
    <link rel="stylesheet" href="CSS/slideLogin.css" />
    <link rel="stylesheet" href="CSS/style.css" />
</head>
<body>
<nav class="navbar">
    <div class="navbar-container container">
        <h1 class="logo">Alk</h1>
        <input type="checkbox" name="" id="">
        <div class="hamburger-lines">
            <span class="line line1"></span>
            <span class="line line2"></span>
            <span class="line line3"></span>
        </div>
        <ul class="menu-items">
            <li>
                <form class="ide-form" action="ideToggle.php" method="post">
                    <button class="btn" name="open-folder">Home</button>
                </form>
            </li>
            <li>
                <form class="login-logout-form" action="goToLoginPage.php" method="post">
                    <button class="btn">Login</button>
                </form>
            </li>
            <li>
                <form class="project-form" action="foldersDrop.php" method="post">
                    <button class="btn" name="open-folder">Open project</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
<div class="body">
    <div class="container-box">
        <div class="blueBg">
            <div class="box signin">
                <h2>Already Have an Account?</h2>
                <button class="signinBtn" onclick="removeActive()">Sign in</button>
            </div>
            <div class="box signup">
                <h2>Don't Have an Account?</h2>
                <button class="signupBtn" onclick="addActive()">Sign up</button>
            </div>
        </div>
        <div class="formBx" id="formBx">
            <div class="form signinForm">
                <form action="validation.php" method="post">
                    <h3>Sign In</h3>
                    <input id="username" name="username" type="text" placeholder="Username">
                    <input id="passwordLog" name="passwordLog" type="password" placeholder="Password">
                    <input type="submit" value="Login">
                </form>
            </div>
            <div class="form signupForm">
                <form action="registration.php" method="post">
                    <h3>Sign Up</h3>
                    <input id="name" name="name" type="text" placeholder="Username">
                    <input id="email" name="email" type="email" placeholder="Email">
                    <input id="passwordReg" name="passwordReg" type="password" placeholder="Password">
                    <input type="submit" value="Register">
                </form>
            </div>
        </div>
    </div>
</div>
<script src="JS/loginRegister.js"></script>
</body>
</html>
