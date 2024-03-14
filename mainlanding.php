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
    html,
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: "Roboto", sans-serif;
    }

    .w3-theme {
      background-color: #2D2F6F !important;
    }

    .w3-theme-l1 {
      background-color: #2D2F6F !important;
    }

    .w3-theme-l5 {
      background-color: #2D2F6F !important;
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
      margin-top: 80px;
      /* Adjust this value if your navbar is taller or shorter */
    }

    .w3-tag,
    .w3-tag:after {
      background-color: #f1f1f1;
      color: #000;
    }

    .w3-teal,
    .w3-hover-teal:hover,
    .w3-teal.w3-hover-opacity:hover {
      color: #fff !important;
      background-color: #009688 !important;
    }

    .w3-round {
      border-radius: 16px;
    }

    .w3-border {
      border: 1px solid #ccc !important;
    }
  </style>
</head>

<body>

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

    <!-- Page heading -->
    <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Latest Available Jobs</h2>

    <!-- connect to database and render elements -->
    <?php
    session_start();
    //temp hardcoded values
    $_SESSION["email"] = "1234567@testemail.com";
    if (!empty($_SESSION["email"]) && isset($_SESSION["email"]))
      getJobs();
    else
     header("Location: http://www.redirect.to.url.com/"); 
    function getJobs()
    {
      global $errorMsg, $success;
      global $jobName, $jobPay, $jobDescription, $jobRequirements, $company, $courseType, $jobType, $closingDate, $jobVacancy;
      //temp hardcoded values
      $coursetype = "Tech";


      // Create database connection.
      $config = parse_ini_file('/var/www/private/db-config.ini');
      if (!$config) {
        $errorMsg = "Failed to read database config file.";
        $success = false;
      } else {
        $conn = new mysqli(
          $config['servername'],
          $config['username'],
          $config['password'],
          $config['dbname']
        );
        // Check connection
        if ($conn->connect_error) {
          $errorMsg = "Connection failed: " . $conn->connect_error;
          $success = false;
        } else {
          // Prepare the statement:
          $stmt = $conn->prepare("SELECT * FROM job WHERE coursetype=?");
          // Bind & execute the query statement:
          $stmt->bind_param("s", $coursetype);
          $stmt->execute();
          $result = $stmt->get_result();
          if ($result->num_rows > 0) {
            // Note that email field is unique, so should only have
            // one row in the result set.
            for ($i = 0; $i < $result->num_rows; $i++) {
              $row = $result->fetch_assoc();
              $jobName = $row["jobname"];
              $jobPay = $row["jobpay"];
              $jobDescription = $row["jobDescription"];
              $jobRequirements = $row["jobRequirements"];
              $company = $row["company"];
              $jobType = $row["jobtype"];
              $closingDate = $row["closingdate"];
              $jobVacancy = $row["jobvacancy"];

              echo "<div class='w3-container w3-card w3-white w3-margin-bottom'>";
              echo "<div class='w3-container'>";
              echo "<h5 class='w3-opacity'><b>" . $jobName .  "/" . $company . "</b></h5>";
              echo "<h6 class='w3-text-teal'><i class='fa fa-calendar fa-fw w3-margin-right'></i>Closed on " . $closingDate . " - <span class='w3-tag w3-teal w3-round'>$" . $jobPay . "</span></h6>";
              echo "<p>$jobType</p> "; //change next time
              echo "<hr>";
              echo "</div>";
              echo "<div class='w3-container'>";
              echo  "<div class='w3-row'>";
              echo  "<div class='w3-col m8 s12'>";
              echo   "<p><button class='w3-button w3-padding-large w3-white w3-border'><b>View Details »</b></button></p></div>";
              echo   "<div class='w3-col m4 w3-hide-small'>";
              echo  "<p><span class='w3-tag w3-teal w3-round'>" . $jobVacancy . "Vacancy</span></p>";
              echo "</div></div></div></div>";
            }
          } else {
            $errorMsg = "Email not found or password doesn't match...";
            $success = false;
          }
          $stmt->close();
        }
        $conn->close();
      }
    }
    ?>


    <!-- Job Listing Box -->
    <div class="w3-container w3-card w3-white w3-margin-bottom">
      <div class="w3-container">
        <h5 class="w3-opacity"><b>Intern - Robotic Process Automation Developer / KONE PTE LTD</b></h5>
        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Closed on 29/03/2024 - <span class="w3-tag w3-teal w3-round">$1,000</span></h6>
        <p>SkillsFuture Work-Study Degree (WSDeg)</p>
        <hr>
      </div>
      <div class="w3-container">
        <div class="w3-row">
          <div class="w3-col m8 s12">
            <p><button class="w3-button w3-padding-large w3-white w3-border"><b>View Details »</b></button></p>
          </div>
          <div class="w3-col m4 w3-hide-small">
            <p><span class="w3-tag w3-teal w3-round">1 Vacancy</span></p>
          </div>
        </div>
      </div>
    </div>
    <!-- End Job Listing Box -->


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