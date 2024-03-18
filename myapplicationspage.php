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

</style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-theme w3-top w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
    <a href="#" class="w3-bar-item w3-button w3-theme-l1">SIT Readier Talent</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Dashboard</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Jobs</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">My Profile</a>

  </div>
</div>

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
<div class="w3-container w3-card w3-white w3-margin-bottom">
    <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-paper-plane fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>My Applications</h2>
    <table class="w3-table-all">
      <tr class="w3-theme">
        <th>Job Title</th>
        <th>Company</th>
        <th>Employment Type</th>
        <th>Applied On</th>
        <th>Status</th>
      </tr>
      <tr>
        <td>Digital Transformation Specialist</td>
        <td>INTERNATIONAL COLLEGE OF HOLISTIC HEALTH PTE. LTD.</td>
        <td>SkillsFuture Work-Study Degree (WSDeg)</td>
        <td>25/02/2024</td>
        <td><span class="w3-tag w3-round w3-teal">ACCEPTED</span></td>
      </tr>
      <!-- ... (additional rows for other applications) ... -->
    </table>
  </div>


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
