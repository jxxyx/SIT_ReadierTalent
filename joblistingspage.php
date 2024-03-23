<!DOCTYPE html>
<html lang="en">

<head>
  <title>SIT Readier Talent Portal</title>
  <meta charset="UTF-8">

  <?php
    include "inc/header.inc.php";
    ?>
  <link rel="stylesheet" href="CSS/Joblistingspage.css">
  <script defer src="/JS/JobListings.js"></script>
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

    <!-- connect to database and render elements -->
    <?php
    session_start();
    //temp hardcoded values
    $_SESSION["email"] = "1234567@testemail.com";
    if (!empty($_SESSION["email"]) && isset($_SESSION["email"]))
      getJobs();
    else
      header("Location: index.php");
    
    function getJobs()
    {
      global $errorMsg, $success;
      global $jobName, $jobPay, $jobDescription, $company, $courseType, $jobType, $closingDate, $jobVacancy;
      //temp hardcoded values


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

        $conn2 = new mysqli(
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
          $stmt = $conn->prepare("SELECT * FROM students WHERE email=?");
          // Bind & execute the query statement:
          $stmt->bind_param("s", $_SESSION["email"]);
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
              $jobDescription = $row2["description"];
              $company = $row2["company"];
              $jobType = $row2["jobtype"];
              $closingDate = $row2["closingdate"];
              $jobVacancy = $row2["vacancy"];

              echo "<div class='w3-container w3-card w3-white w3-margin-bottom'>";
              echo "<div class='w3-container'>";
              echo "<h5 class='w3-opacity'><b>" . $jobName .  "/" . $company . "</b></h5>";
              echo "<h6 class='w3-text-teal'><i class='fa fa-calendar fa-fw w3-margin-right'></i>Closed on " . $closingDate . " - <span class='w3-tag w3-teal w3-round'>$" . $jobPay . "</span></h6>";
              echo "<p>$jobDescription</p> "; //change next time
              echo "<p>$jobType</p> "; //change next time
              echo "<hr>";
              echo "</div>";
              echo "<div class='w3-container'>";
              echo  "<div class='w3-row'>";
              echo  "<div class='w3-col m8 s12'>";
              echo   "<p><button class='w3-button w3-padding-large w3-white w3-border'><b>View Details »</b></button></p></div>";
              echo   "<div class='w3-col m4 w3-hide-small'>";
              echo  "<p><span class='w3-tag w3-teal w3-round'>" . $jobVacancy . " Vacancy</span></p>";
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

      <!-- Job Description Panel -->
  <div id="jobDescription" class="job-description">
    <!-- This is where the job description will appear when a listing is clicked -->
    <h2>Job Title Here</h2>
    <p>Company Name - Location</p>
    <p>Pay Range - Job Type</p>
    <hr>
    <h3>Job Details</h3>
    <p>Description Here...</p>
    <!-- More details -->
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
  <?php include 'inc/footer.inc.php'; ?>
</body>

</html>