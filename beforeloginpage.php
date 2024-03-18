<!DOCTYPE html>
<html lang="en">
<head>
<title>SIT Readier Talent Portal</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>


.w3-theme, .w3-theme-l1, .w3-theme-l5, .w3-bar {
    background: linear-gradient(to bottom, #2D2F6F 0%, #00f2fe 100%) !important;
  }

  
html, body {
  font-family: "Roboto", sans-serif;
  margin: 0;
  height: 100%;
  background-image: url('blue.jpg'); /* Replace with your image path */
  background-size: cover;
  background-position: center;
}

.w3-bar .w3-button {
  color: white;
  border: none;
}

/* Style for the container of the buttons */
.content {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
}

/* Style for the header */
.header {
  margin-bottom: 30px; /* Spacing between header and buttons */
  font-size: 48px; /* Size of the header text */
  color: white; /* Color of the header text */
  text-shadow: 2px 2px 4px rgba(0,0,0,0.5); /* Shadow effect for better readability */
}

/* Style for the buttons */
.button {
  padding: 15px 30px;
  margin: 10px;
  font-size: 18px;
  cursor: pointer;
  border: none;
  border-radius: 4px;
  color: white;
  background-color: #009688; /* You can change the color to suit your style */
  transition: background-color 0.3s;
}

.button:hover {
  background-color: #00796b; /* Darker shade for hover effect */
}

/* Close the sidebar style block */
/* Add styles for .w3-main to ensure it's not covered by the navbar */
.w3-main {
  .w3-main 
  margin-left: 0;
  margin-top: 43px; /* Adjust if your navbar is taller or shorter */
}


</style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-theme w3-top w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
    <a href="#" class="w3-bar-item w3-button w3-theme-l1">SIT Readier Talent</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">About Us</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Contact</a>
  </div>
</div>


<div class="content">
  <div class="header">Welcome to SIT Readier Talent Portal</div>
  <button class="button">Student Login</button>
  <button class="button">Employee Login</button>
</div>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">


<!-- END MAIN -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

</body>
</html>
