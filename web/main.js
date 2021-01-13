document.getElementById("click-btn").addEventListener("click", function(){
    alert("Clicked!");
})


$(document).ready(function(){
    $("#change-color-btn").click(function() {
        const color = $("#color-input").val();
        $(".first").css('background-color', color)
    });

    $("#toggle-btn").click(function() {
        $(".third").fadeToggle("slow");
    })
});
