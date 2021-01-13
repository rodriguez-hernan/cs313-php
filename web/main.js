document.getElementById("click-btn").addEventListener("click", function(){
    alert("Clicked!");
})


function changeColor() {
    var color = document.getElementById("color-input").value;
    document.querySelector(".first").style.backgroundColor = color;
}