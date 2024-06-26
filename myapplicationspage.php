<!DOCTYPE html>
<html lang="en">

<head>
  <title>SIT Readier Talent Portal</title>
  <meta charset="UTF-8">
  <?php
  include "inc/header.inc.php";
  ?>
  <link rel="stylesheet" href="CSS/MyApplicationspage.css">
  <script defer src="/JS/MyApplications.js"></script>
</head>

<body>

  <!-- Navbar -->
  <?php
  include "inc/nav.inc.php";
  ?>

<main>

  <!-- Overlay effect when opening sidebar on small screens -->
  <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu"
    id="myOverlay"></div>

  <!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
  <div class="w3-content" style="max-width:1400px;">
    <div class="w3-row">
      <div class="w3-container w3-card w3-white w3-margin-bottom">
        <h1 class="w3-text-grey w3-padding-16"><i
            class="fa fa-paper-plane fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>My Applications</h1>
        <div class="w3-responsive">
          <table class="w3-table-all">
            <tr class="w3-theme">
              <th>Job Title</th>
              <th>Company</th>
              <th>Employment Type</th>
              <th>Applied On</th>
              <th>Status</th>
            </tr>

            <!-- connect to database and render elements -->
            <?php
            session_start();
            $email = "";

            //check if logged in
            if (!empty($_SESSION["email"]) && isset($_SESSION["email"])) {
              $email = $_SESSION["email"];
              getJobs();
            } else {
              header("Location: UserLogin.php");
            }

            function getJobs()
            {
              global $errorMsg, $success;
              $jobName = $jobType = $companyName = $jobid = $applicationStatus = $applicationDate = "";
              global $email;


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
                  // Prepare the statement: get applications and thn job name from database connection
                  $stmt = $conn->prepare("SELECT * FROM application WHERE email=?");

                  // Bind & execute the query statement:
                  $stmt->bind_param("s", $email);
                  $stmt->execute();
                  $result = $stmt->get_result();
                  if ($result->num_rows > 0) {
                    // Note that email field is unique, so should only have
                    // one row in the result set.
                    for ($i = 0; $i < $result->num_rows; $i++) {
                      $row = $result->fetch_assoc();
                      $jobId = $row["jobid"];
                      $applicationStatus = $row["status"];

                      //get info from jobs table using jobid
                      $stmt2 = $conn2->prepare("SELECT * FROM job WHERE jobid=? AND closingdate>=?");
                      $stmt2->bind_param("ss", $jobId, date("Y-m-d"));
                      $stmt2->execute();
                      $result2 = $stmt2->get_result();

                      for ($j = 0; $j < $result2->num_rows; $j++) {
                        $row2 = $result2->fetch_assoc();
                        $jobName = $row2["jobname"];
                        $jobType = $row2["jobtype"];
                        $companyName = $row2["company"];
                      }
                      $stmt2->close();

                      echo "<tr>";
                      echo "<td>" . $jobName . "</td> ";
                      echo "<td>" . $companyName . "</td>";
                      echo "<td>" . $jobType . "</td> ";
                      echo "<td>25/02/2024</td>";
                      echo "<td><span class='w3-tag w3-round w3-teal dark-teal'>" . $applicationStatus . "</span></td> ";
                      echo "</tr>";
                    }
                  } else {
                    $success = false;
                  }
                  $stmt->close();
                }
                $conn->close();
                $conn2->close();
              }
            }
            ?>


            <!-- ... (additional rows for other applications) ... -->
          </table>
          <br>
        </div>
      </div>
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
</main>
</body>

</html>