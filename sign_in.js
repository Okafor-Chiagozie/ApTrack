
var toggle = document.getElementById("toggle")
var flow = document.getElementById("flow")
var admin = document.getElementById("admin")
var user = document.getElementById("user")
var loginImage = document.getElementById("loginImage")

// var requestButton = document.getElementsByClassName("requestButton")
// requestButton[4].firstElementChild.style.border = "1px solid silver"

// flow.style.border = "1px solid silver"


var userShow = true

function change(){

    if(userShow == true){
        admin.style.display = "flex"
        user.style.display = "none"
        toggle.lastElementChild.style.color = "black"
        toggle.firstElementChild.nextElementSibling.style.color = "white"
        flow.style.left = "0"
        userShow = false
        loginImage.src = "photos/Hand coding-pana.png"
    }else if(userShow == false){
        user.style.display = "flex"
        admin.style.display = "none"
        flow.style.left = "50%"
        toggle.lastElementChild.style.color = "white"
        toggle.firstElementChild.nextElementSibling.style.color = "black"
        userShow = true
        loginImage.src = "photos/Collab-pana.png"
    }
}










