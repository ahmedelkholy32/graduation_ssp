/*global $*/
var // variables
    password = document.getElementById("password"),
    passwordShow = document.getElementById("passwordshow");

// functions
function showPassword() {
    "use strict";
    if (password.hasAttribute("type")) {
        if (password.type === 'password') {
            password.type = 'text';
            passwordShow.className = "fa fa-eye-slash";
        } else {
            password.type = 'password';
            passwordShow.className = "fa fa-eye";
        }
    }
}
function showPasswordDirection() {
    "use strict";
    if (document.dir === 'rtl') {
        passwordShow.style.right = '287px';
    }
}
// events
passwordShow.onclick = showPassword;
window.onload = showPasswordDirection;
// jquery
$(document).ready(function () {
    "use strict";
    $("nav ul").remove();
    $("#userinformation").remove();
});