<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Seedlink | login</title>
        <link rel="stylesheet" href="../assets/css/login.css">
        <link rel="icon" href="../assets/images/seedlink.ico" type="icon">
    </head>
    <body>
        
        <!-- login card -->
        <div class="login">
            <form action="../actions/loginUser.php" id="login_form" method="post">
                <h1>Log In</h1>
                <div class="input-box">
                    <input type="email" name="email" id="login_email" placeholder="E-mail">
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="login_password" placeholder="Password">
                </div>
                <div>
                    <input type="checkbox" id="login_showPassword" onclick="showLoginPass()">Show Password
                </div>

                <button type="submit" class="btn" id="submit"> LogIn </button>

                <div class="register-link">
                    <p>Don't have an account?<a href="./signup.php" id="navToSignup"> Sign Up</a></p>
                </div>
                <div id="login_error" style="color: red;"></div>
                <div class="forget-remember">
                    <label><input type="checkbox" > Remember me </label>
                    <a href="#">Forgot Password?</a>
                </div>
            </form>
        </div>

        <script src="../assets/js/signin.js"> </script>
    </body>
</html>
