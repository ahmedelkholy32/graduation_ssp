var // variables
    selectLangDir = document.getElementById("selectlang");
// functions
function changeSelectLangDir() {
    "use strict";
    // change position of select lang
    if (document.dir === "ltr") {
        selectLangDir.style.float = "right";
    } else {
        selectLangDir.style.float = "left";
    }
}
// events
window.onload = changeSelectLangDir;