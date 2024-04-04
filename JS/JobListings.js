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
$(".navbar-toggler").click(function() {
    $(".navbar-collapse").slideToggle(300);
    initialize(); // Call initialize() immediately after slideToggle()
});




function searchJobs() {
    var input, filter, select, jobType, listings, title, type, i, txtValue;
    input = document.getElementById("searchBar");
    filter = input.value.toUpperCase();
    select = document.getElementById("jobTypeFilter");
    jobType = select.value.toUpperCase();
    listings = document.getElementById("jobListings").getElementsByClassName("w3-container w3-card w3-white w3-margin-bottom");
  
    for (i = 0; i < listings.length; i++) {
      title = listings[i].getElementsByTagName("h5")[0];
      type = listings[i].getElementsByTagName("p")[0]; // Assuming the first <p> element contains the job type
      if (title && type) {
        txtValue = title.textContent || title.innerText;
        jobTypeValue = type.textContent || type.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1 && (jobType === "" || jobTypeValue.toUpperCase().indexOf(jobType) > -1)) {
          listings[i].style.display = "";
        } else {
          listings[i].style.display = "none";
        }
      }
    }
  }


