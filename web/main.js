document.getElementById("click-btn").addEventListener("click", function(){
    alert("Clicked!");
})


$(document).ready(function(){
    $("#change-color-btn").click(function() {
        const color = $("#color-input").val();
        $(".first").css('background-color', color)
    });
});

/* function changeColor() {
    var color = document.getElementById("color-input").value;
    document.querySelector(".first").style.backgroundColor = color;
} */