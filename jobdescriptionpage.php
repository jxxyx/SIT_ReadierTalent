<!DOCTYPE html>
<html lang="en">
<head>
<title>SIT Readier Talent Portal</title>
<meta charset="UTF-8">
<<<<<<< HEAD
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html, body, h1, h2, h3, h4, h5, h6 {font-family: "Roboto", sans-serif;}

.w3-theme, .w3-theme-l1, .w3-theme-l5, .w3-bar {
    background: linear-gradient(to bottom, #2D2F6F 0%, #00f2fe 100%) !important;
  }

/* Sidebar links */
.w3-sidebar .w3-bar-item {
  color: white;
}

.w3-sidebar {
  z-index: 3;
  width: 250px;
  top: 43px;
  bottom: 0;
  height: inherit;

}

/* Close the sidebar style block */
/* Add styles for .w3-main to ensure it's not covered by the navbar */
.w3-main {
  margin-left: 250px;
  margin-top: 80px; /* Adjust this value if your navbar is taller or shorter */
}

.w3-tag, .w3-tag:after {
  background-color: #f1f1f1;
  color: #000;
}

.w3-teal, .w3-hover-teal:hover, .w3-teal.w3-hover-opacity:hover {
  color: #fff!important;
  background-color: #009688!important;
}

.w3-round {
  border-radius: 16px;
}

.w3-border {
  border: 1px solid #ccc!important;
}

.w3-back-button {
    margin-top: -17px; /* Moves the button up; adjust the value as needed */
    margin-left: 20px; /* Moves the button to the right; adjust the value as needed */
    margin-bottom: 10px; /* Optional: ensures there is space below the button */
   
}

</style>
=======
    <?php
    include "inc/header.inc.php";
    ?>
    <link rel="stylesheet" href="CSS/JobDescription.css">
    <!-- Custom JS -->
    <script defer src="/JS/JobDescription.js"></script>
>>>>>>> 301946529a86d01428a431dce48d19423869b927
</head>
<body>

<!-- Navbar -->
<<<<<<< HEAD
<div class="w3-top">
  <div class="w3-bar w3-theme w3-top w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
    <a href="#" class="w3-bar-item w3-button w3-theme-l1">SIT Readier Talent</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Dashboard</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Jobs</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">My Profile</a>

  </div>
</div>
=======
<?php
  include "inc/nav.inc.php";
?>
>>>>>>> 301946529a86d01428a431dce48d19423869b927

<!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
    <i class="fa fa-remove"></i>
  </a>
  <h4 class="w3-bar-item"><b>Status</b></h4>
  <a class="w3-bar-item w3-button w3-hover-black" href="#">Applied Jobs</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="#">Shortlisted</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="#">Offered Jobs</a>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">

<button onclick="history.back()" class="w3-button w3-theme w3-back-button">Back</button>

<!-- Job Description Box -->
<div class="w3-container w3-card w3-white w3-margin-bottom">
    <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-briefcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Accounts Assistant cum Admin</h2>
    <div class="w3-container">
      <h5 class="w3-opacity"><b>Entirety Network Services Pte Ltd</b></h5>
      <h6 class="w3-text-teal"><i class="fa fa-map-marker fa-fw w3-margin-right"></i>Singapore, North-East Region</h6>
      <h6 class="w3-text-teal"><i class="fa fa-dollar fa-fw w3-margin-right"></i>$2,000 - $3,000 per month</h6>
      <hr>
      <div class="w3-container">
        <h6 class="w3-text-teal"><b>Responsibilities:</b></h6>
        <ul>
          <li>Perform accounts payable and accounts receivable functions, including data entry into the QuickBooks system.</li>
          <!-- ... (more responsibilities) ... -->
        </ul>
        <h6 class="w3-text-teal"><b>The Ideal Candidate:</b></h6>
        <ul>
          <li>Basic understanding of accounting principles and practices.</li>
          <!-- ... (more qualifications) ... -->
        </ul>
        <!-- ... (rest of the job description as needed) ... -->
      </div>
    </div>
  </div>

  <!-- END MAIN -->


  <!-- Pagination -->

  <div class="w3-center w3-padding-32">
    <div class="w3-bar">
      <a class="w3-button w3-black" href="#">1</a>
      <a class="w3-button w3-hover-black" href="#">2</a>
      <a class="w3-button w3-hover-black" href="#">3</a>
      <a class="w3-button w3-hover-black" href="#">4</a>
      <a class="w3-button w3-hover-black" href="#">5</a>
      <a class="w3-button w3-hover-black" href="#">»</a>
    </div>
  </div>


<!-- END MAIN -->
</div>
<<<<<<< HEAD

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

=======
<?php include 'inc/footer.inc.php'; ?>
>>>>>>> 301946529a86d01428a431dce48d19423869b927
</body>
</html>
