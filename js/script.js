//--------------------- MENU ITEMS ---------------------\\


//------------------- SLIDEBAR INFORMATION  -------------\\

const itemsliderbar = document.querySelectorAll(".information-left-li")
itemsliderbar.forEach(function(menu, index){
    menu.addEventListener("click", function(){
        menu.classList.toggle("block")
    })
})
