<!DOCTYPE html>
<html lang="en">
<head>
<title>SIT Readier Talent Portal</title>
<meta charset="UTF-8">
<?php
    include "inc/header.inc.php";
    ?>
<link rel="stylesheet" href="CSS/index.css">

</head>
<body>

<?php
  include "inc/nav.inc.php";
?>


<div class="content">
  <div class="header">Welcome to SIT Readier Talent Portal</div>
  <a href="/UserLogin.php"><button class="button">Student Login</button>
  <a href="/EmployerLogin.php"><button class="button">Employee Login</button>
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
