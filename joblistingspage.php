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

    .w3-theme,
    .w3-theme-l1,
    .w3-theme-l5,
    .w3-bar {
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
=======

  <?php
    include "inc/header.inc.php";
    ?>
  <link rel="stylesheet" href="CSS/Joblistingspage.css">
  <script defer src="/JS/JobListings.js"></script>
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

    <!-- connect to database and render elements -->
    <?php
    session_start();
    //temp hardcoded values
    $_SESSION["email"] = "1234567@testemail.com";
    if (!empty($_SESSION["email"]) && isset($_SESSION["email"]))
      getJobs();
    else
      header("Location: http:/35.212.201.233/");
    
    function getJobs()
    {
      global $errorMsg, $success;
      global $jobName, $jobPay, $jobDescription, $jobRequirements, $company, $courseType, $jobType, $closingDate, $jobVacancy;
      //temp hardcoded values
<<<<<<< HEAD
      $coursetype = "Tech";
=======
>>>>>>> 301946529a86d01428a431dce48d19423869b927


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
<<<<<<< HEAD
=======

        $conn2 = new mysqli(
          $config['servername'],
          $config['username'],
          $config['password'],
          $config['dbname']
        );
>>>>>>> 301946529a86d01428a431dce48d19423869b927
        // Check connection
        if ($conn->connect_error) {
          $errorMsg = "Connection failed: " . $conn->connect_error;
          $success = false;
        } else {
          // Prepare the statement:
<<<<<<< HEAD
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
=======
          $stmt = $conn->prepare("SELECT * FROM students WHERE email=?");
          // Bind & execute the query statement:
          $stmt->bind_param("s", $email);
          $stmt->execute();
          $result = $stmt->get_result();
            // Note that email field is unique, so should only have 1 row
          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $courseType = $row["coursetype"];


            //get info from jobs table using jobid
            $stmt2 = $conn2->prepare("SELECT * FROM job WHERE coursetype=?");
            $stmt2->bind_param("s", $courseType);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            // one row in the result set.
            for ($i = 0; $i < $result2->num_rows; $i++) {
              $row2 = $result2->fetch_assoc();
              $jobName = $row2["jobname"];
              $jobPay = $row2["jobpay"];
              $jobDescription = $row2["jobDescription"];
              $jobRequirements = $row2["jobRequirements"];
              $company = $row2["company"];
              $jobType = $row2["jobtype"];
              $closingDate = $row2["closingdate"];
              $jobVacancy = $row2["jobvacancy"];
>>>>>>> 301946529a86d01428a431dce48d19423869b927

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
            header("Location: http:/35.212.201.233/");
          }
          $stmt->close();
        }
        $conn->close();
      }
    }
    ?>

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
<<<<<<< HEAD


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

=======
    <!-- END MAIN -->
  </div>
  <?php include 'inc/footer.inc.php'; ?>
>>>>>>> 301946529a86d01428a431dce48d19423869b927
</body>

</html>