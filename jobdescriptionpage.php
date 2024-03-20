<!DOCTYPE html>
<html lang="en">
<head>
<title>SIT Readier Talent Portal</title>
<meta charset="UTF-8">
    <?php
    include "inc/header.inc.php";
    ?>
    <link rel="stylesheet" href="CSS/JobDescription.css">
    <!-- Custom JS -->
    <script defer src="/JS/JobDescription.js"></script>
</head>
<body>

<!-- Navbar -->
<?php
  include "inc/nav.inc.php";
?>

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
<?php include 'inc/footer.inc.php'; ?>
</body>
</html>
