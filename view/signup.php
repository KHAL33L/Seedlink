<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ei-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Seedlink | SignUp</title>
        <link rel="stylesheet" href="../assets/css/login.css">
        <link rel="icon" href="../assets/images/seedlink.ico" type="icon">
    </head>

    <body>  
        <!-- Signup card -->
        <div class="signup">
            <form action="../actions/signupUser.php" id="signup_form" method="post">
                <h1>Sign Up</h1>
                <p id="w_note">Join our community to gain exclusive products and services</p>

                <div class="input-box">
                    <ul>
                        <li><input type="text" placeholder="First Name..." id="fname" name="fname" required> </li>
                        <li><input type="text" placeholder="Last Name..."  id="lname" name="lname" required></li>
                    </ul>
                </div>

                <div class="input-box">
                    <input type="email" name="email" id="email" placeholder="E-mail...">
                </div>
                <div class="input-box">
                    <input type="number" name="number" id="number" placeholder="Phone number...">
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="password" placeholder="Password...">
                </div>

                <div class="input-box">
                    <input type="password" name="confirm password" id="confirm_password" placeholder="Confirm Password...">
                </div>

                <div>
                    <input type="checkbox" id="showPassword" onclick="showSignupPass()">Show Password
                </div>

                <div class="accept">
                    <label><input type="checkbox" id="accept_terms"> Accept Terms & Conditions</label>
                </div>

                <button type="submit" class="btn" id="submit">SignUp</button>

                <div class="register-link">
                    <p>Already Have an Account? <a href="./login.php" id="navToSignin">Sign In</a></p>
                </div>
                <div id="error" style="color: red;"></div>
            
            </form>

           
        </div>

        
        <script src="../assets/js/signin.js"></script>
    </body>
</html>
<!--Added by the great Peggy-->