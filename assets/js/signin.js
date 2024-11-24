

//Signin form validation
if (document.getElementById("signin_form")) {
    document.getElementById("signin_form").addEventListener("submit", function(event) {
        if (!signInValidation()) {
            event.preventDefault();
        }
    });
}

//Signup form validation
if (document.getElementById("signup_form")) {
    document.getElementById("signup_form").addEventListener("submit", function(event) {
        if (!signUpValidation()) {
            event.preventDefault();
        }
    });
}



//Signin validation function
function signInValidation(){
    //variable declarations
    const email = document.getElementById("login_mail").value.trim();
    const password = document.getElementById("login_password").value.trim();
    const error = document.getElementById("login_error");

    if (!email || !password) {
        error.innerHTML="Detected Empty fields!!";
        console.log("False recorder");
        return false;
    } else if (!email_format.test(email)) {
        error.innerHTML="The email format is wrong!!";
        return false;
    } else if (!password_regex.test(password)) {
        error.innerHTML = "Password must contain at least 8 characters, one uppercase letter, three digits, and one special character!";
        return false;
    }
    error.style.color="green";
    error.innerHTML="Log In Successful!!";
    return true;
}