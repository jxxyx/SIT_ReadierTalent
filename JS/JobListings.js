// Get the Navbar
var navbar = document.getElementById("navbarSupportedContent");

// Get the horizontal selector
var horiSelector = document.querySelector(".hori-selector");

// Add active class and move the horizontal selector on click
navbar.addEventListener("click", function(e) {
    if (e.target.tagName === "A") {
        var activeItem = navbar.querySelector(".active");
        activeItem.classList.remove("active");
        e.target.parentNode.classList.add("active");

        var activeWidth = e.target.parentNode.offsetWidth;
        var activeHeight = e.target.parentNode.offsetHeight;
        var itemPosTop = e.target.parentNode.offsetTop;
        var itemPosLeft = e.target.parentNode.offsetLeft;

        horiSelector.style.top = itemPosTop + "px";
        horiSelector.style.left = itemPosLeft + "px";
        horiSelector.style.width = activeWidth + "px";
        horiSelector.style.height = activeHeight + "px";
    }
});

// Initial setup
function initialize() {
    var activeItem = navbar.querySelector(".active");
    var activeWidth = activeItem.offsetWidth;
    var activeHeight = activeItem.offsetHeight;
    var itemPosTop = activeItem.offsetTop;
    var itemPosLeft = activeItem.offsetLeft;

    horiSelector.style.top = itemPosTop + "px";
    horiSelector.style.left = itemPosLeft + "px";
    horiSelector.style.width = activeWidth + "px";
    horiSelector.style.height = activeHeight + "px";
}

document.addEventListener("DOMContentLoaded", function() {
    initialize();
});

window.addEventListener("resize", function() {
    initialize();
});

// Toggle navbar collapse
/*
$(".navbar-toggler").click(function() {
    $(".navbar-collapse").slideToggle(300);
    initialize(); // Call initialize() immediately after slideToggle()
});
*/