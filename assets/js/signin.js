

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

    const email_format = /^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[a-zA-Z]{2,6}$/; //email formal
    const password_regex = /^(?=.*[A-Z])(?=(.*\d){3,})(?=.*[!@#$%^&*_()-]).{8,}$/; //password format

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


//Signup validation function
function signUpValidation() {
    // Variable declarations
    const fname = document.getElementById("fname").value.trim();
    const lname = document.getElementById("lname").value.trim();

    const email = document.getElementById("email").value.trim();

    const password = document.getElementById("password").value.trim();
    const confirm_password = document.getElementById("confirm_password").value.trim();
    const error = document.getElementById("error");
    const acceptTerms = document.querySelector('.accept input[type="checkbox"]');
    error.innerHTML = "";


    const email_format = /^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[a-zA-Z]{2,6}$/; //email formal
    const password_regex = /^(?=.*[A-Z])(?=(.*\d){3,})(?=.*[!@#$%^&*_()-]).{8,}$/; //password format

    if (!fname || !lname || !email || !password || !confirm_password) {
        error.innerHTML="Detected Empty fields!!";
        console.log("False recorder");
        return false;  
    } if (!email_format.test(email)) {
        error.innerHTML="The email format is wrong!!";
        return false;
    } 
    if (!acceptTerms.checked) {
        error.innerHTML = "You must accept the Terms & Conditions!";
        return false;
    }
    if (!password_regex.test(password)) {
        console.log(password)
        console.log("Password validation failed!!");
        error.innerHTML = "Password must contain at least 8 characters, one uppercase letter, three digits, and one special character!";
        return false;
    } if (confirm_password !== password) {
        error.innerHTML = "Passwords do not match!!";
        return false;
    }

    //success
    error.style.color = "green";
    error.innerHTML="Signup Successful!!";
    console.log("Validation passed: signup successful")
    return true;

}