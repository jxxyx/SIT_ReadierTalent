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



  <!-- Overlay effect when opening sidebar on small screens -->
  <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>


  <!-- connect to database and render elements -->
  <?php
  session_start();
  //temp hardcoded values
  $errorMsg = "";
  $success = true;
  $type = $_SESSION["loginType"];
  $email = $_SESSION["email"];
  if (!empty($_SESSION["loginType"]) && isset($_SESSION["email"]))
    getJobs();

    if($success){
      echo $errorMsg;
    }
  else
    header("Location: index.php");



  function getJobs()
  {
    global $errorMsg, $success, $type, $email;
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

        if ($type == "student") {
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
              $jobDescription = $row2["description"];
              $company = $row2["company"];
              $jobType = $row2["jobtype"];
              $closingDate = $row2["closingdate"];
              $jobVacancy = $row2["vacancy"];

              echo "<div class='w3-container w3-card w3-white w3-margin-bottom'>";
              echo "<div class='w3-container'>";
              echo "<h5 class='w3-opacity'><b>" . $jobName .  "/" . $company . "</b></h5>";
              echo "<h6 class='w3-text-teal'><i class='fa fa-calendar fa-fw w3-margin-right'></i>Closed on " . $closingDate . " - <span class='w3-tag w3-teal w3-round'>$" . $jobPay .
                "</span><span class='w3-tag w3-teal w3-round w3-margin-left'> " . $jobVacancy . " Vacancy</span></h6> ";
              echo "<p>$jobType</p> "; //add styling to this maybe?
              echo "<p>$jobDescription</p> "; //add styling to this maybe
              echo "<hr>";
              echo "</div>";
              echo "<div class='w3-container'>";
              echo  "<div class='w3-row'>";
              echo  "<div class='w3-col m8 s12'>";
              echo   "<p><button onclick='applyJob(this);' class='w3-button w3-padding-large w3-blue w3-border'><b>Apply Job</b></button></p></div>";
              echo   "<div class='w3-col m4 w3-hide-small'>";
              echo "</div></div></div></div>";
            }
          } else {
            $errorMsg = "Email not found or password doesn't match...";
            $success = false;
          }

          //if employer dont allow for applying of jobs and only show their listings
        } else if ($type == "employer") {
          $stmt = $conn->prepare("SELECT * FROM employer WHERE email=?");
          // Bind & execute the query statement:
          $stmt->bind_param("s", $email);
          $stmt->execute();
          $result = $stmt->get_result();

          // Note that email field is unique, so should only have 1 row
          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $companyName = $row["company"];
            //get info from jobs table using jobid
            $stmt2 = $conn2->prepare("SELECT * FROM job WHERE company=?");
            $stmt2->bind_param("s", $companyName);
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
              echo "<h6 class='w3-text-teal'><i class='fa fa-calendar fa-fw w3-margin-right'></i>Closed on " . $closingDate . " - <span class='w3-tag w3-teal w3-round'>$" . $jobPay .
                "</span><span class='w3-tag w3-teal w3-round w3-margin-left'> " . $jobVacancy . " Vacancy</span></h6> ";
              echo "<p>$jobType</p> "; //add styling to this maybe?
              echo "<p>$jobDescription</p> "; //add styling to this maybe
              echo "<hr>";
              echo "</div>";
              echo "<div class='w3-container'>";
              echo  "<div class='w3-row'>";
              echo  "<div class='w3-col m8 s12'>";
              echo   "<p><button onclick='deleteJob(this);' class='w3-button w3-padding-large w3-red w3-border'><b>Delete Job Posting</b></button></p></div>";
              echo   "<div class='w3-col m4 w3-hide-small'>";
              echo "</div></div></div></div>";
            }
          } else {
            $errorMsg = "Email not found or password doesn't match...";
            $success = false;
          }
        }
        $stmt->close();
      }
      $conn->close();
    }
  }
  ?>

  <!-- Job Description Panel -->


  <div style="display: hidden">
    <form id="applyJobForm" method="post" action="jobApplyProcess.php">
      <input type="hidden" id="applyFormcompanyName" name="companyName" value="">
      <input type="hidden" id="applyFormjobName" name="jobName" value="">
    </form>
  </div>

  <div style="display: hidden">
    <form id="deleteJobForm" method="post" action="jobDeleteProcess.php">
      <input type="hidden" id="deleteFormCompanyName" name="companyName" value="">
      <input type="hidden" id="deleteFormJobName" name="jobName" value="">
    </form>
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

<script>
  function applyJob(element) {
    var parent = element.parentElement.parentElement.parentElement.parentElement.parentElement;
    var info = parent.firstChild;
    var job = info.firstChild.firstChild;
    var jobText = job.innerText.split("/");
    document.getElementById("applyFormjobName").value = jobText[0];
    document.getElementById("applyFormcompanyName").value = jobText[1];
    document.getElementById("applyJobForm").submit();
  }

  function deleteJob(element) {
    var parent = element.parentElement.parentElement.parentElement.parentElement.parentElement;
    var info = parent.firstChild;
    var job = info.firstChild.firstChild;
    var jobText = job.innerText.split("/");
    document.getElementById("deleteFormJobName").value = jobText[0];
    document.getElementById("deleteFormCompanyName").value = jobText[1];
    document.getElementById("deleteJobForm").submit();
  }
</script>

</html>