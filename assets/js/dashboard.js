var mainHeader = document.getElementById("mainHeader");
var leftSection = document.getElementById("leftSection");
var mainSection = document.getElementById("mainSection");
var rightSection = document.getElementById("rightSection");
var hamburgerIcon = document.getElementById("hamburgerIcon");


function adjust() 
{
   var topping = (mainHeader.offsetHeight) + "px";
   var sectionHeight = (window.innerHeight - mainHeader.offsetHeight) + "px";

   leftSection.style.marginTop = topping;
   mainSection.style.marginTop = topping;

   mainSection.style.minHeight = sectionHeight;
   leftSection.style.height = sectionHeight;
}

setInterval(adjust, 100);


function menu() 
{
   if (hamburgerIcon.firstElementChild.className == "fa-solid fa-bars") 
   {
      leftSection.style.width = "100%";
      hamburgerIcon.firstElementChild.className = "fa fa-times";
   } else if (hamburgerIcon.firstElementChild.className == "fa fa-times") 
   {
      leftSection.style.width = "0%";
      hamburgerIcon.firstElementChild.className = "fa-solid fa-bars";
   }
}