
// Switching from sign in to signup
if (document.getElementById("signin_form")) {
    document.getElementById("navToSignup").addEventListener("click", function(event) {
        //Displaying signup card and hiding signin card
        document.querySelector(".signin").style.display="none";
        document.querySelector(".signup").style.display="block";
        // document.getElementsByClassName(".signin").style.display="none";
        // document.getElementsByClassName(".signup").style.display="flex";
        
    });
}


if (document.getElementById("signup_form")){
    document.getElementById("navToSignin").addEventListener("click", function(event) {
        // Hiding signup card and displaying signin card
        document.querySelector(".signup").style.display = "none";
        document.querySelector(".signin").style.display = "flex";
    //     document.getElementsByClassName(".signup").style.display = "none";
    //     document.getElementsByClassName(".signin").style.display = "flex";//
     });
}


// document.getElementById("navToSignup").addEventListener("click", function(event) {
//     //Displaying signup card and hiding signin card
//     document.querySelector(".signin").style.display="none";
//     document.querySelector(".signup").style.display="flex";
    
// });

// document.getElementById("navToSignin").addEventListener("click", function(event) {
//     // Hiding signup card and displaying signin card
//     document.querySelector(".signup").style.display = "none";
//     document.querySelector(".signin").style.display = "flex";
// });