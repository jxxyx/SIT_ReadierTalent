<!DOCTYPE html>
<html lang="en">

<head>
  <title>SIT Readier Talent Portal</title>
  <meta charset="UTF-8">
  <?php
  include "inc/header.inc.php";
  ?>
  <link rel="stylesheet" href="CSS/employerapplicationpage.css">
  <script defer src="/JS/MyApplications.js"></script>
</head>

<body>
  <!-- Navbar -->
  <?php include "inc/nav.inc.php"; ?>
  <main>
    <div class="w3-content" style="max-width:1400px;">
      <div class="w3-row">
        <div class="w3-container w3-card w3-white w3-margin-bottom">
          <h1 class="w3-text-grey w3-padding-16"><i
              class="fa fa-paper-plane fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Applications</h1>
          <div class="w3-responsive">
            <table class="w3-table-all">
              <tr class="w3-theme">
                <th>Application ID</th>
                <th>Job Name</th>
                <th>Email</th>
                <th>Date</th>
                <th>Status</th>
                <th>Resume</th>
                <th>Accept</th>
                <th>Reject</th>
              </tr>


              <!-- php to list out the job applications according to the employer that is logged in-->
              <?php
              session_start();
              $AppId;
              $JobIds = [];
              $JobNames = [];
              $Jobname;
              $Email;
              $Date;
              $Status = "";
              $Resume;


              $config = parse_ini_file('/var/www/private/db-config.ini');
              if ($config) {
                $conn = new mysqli(
                  $config['servername'],
                  $config['username'],
                  $config['password'],
                  $config['dbname']
                );

                if (!$conn->connect_error) {
                  //getting the jobs that the company has posted 
                  $stmt = $conn->prepare("SELECT * FROM job WHERE company=?");

                  $stmt->bind_param("s", $_SESSION['company']);
                  $stmt->execute();
                  $result = $stmt->get_result();
                  if ($result->num_rows > 0) {
                    foreach ($result as $row) {
                      $JobIds[] = $row['jobid'];
                      $JobNames[] = $row['jobname'];
                    }
                  }
                  $stmt->close();


                  //for each job, look up the application database to get all applications for that job
                  foreach ($JobIds as $id) {
                    $Jobname = $JobNames[array_search($id, $JobIds)];
                    $stmt = $conn->prepare("SELECT * FROM application WHERE jobid=?");
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    foreach ($result as $row) {
                      $AppId = $row["appid"];
                      $Email = $row['email'];
                      $Date = $row['date'];
                      $Status = $row['status'];

                      $stmt2 = $conn->prepare("SELECT * FROM students WHERE email=?");
                      $stmt2->bind_param("s", $Email);
                      $stmt2->execute();
                      $result2 = $stmt2->get_result();
                      if ($result2->num_rows > 0) {
                        $row2 = $result2->fetch_assoc();
                        $Resume = $row2['resume'];
                      }


                      //display each application's information alongside 2 buttons to either offer or reject the application
                      echo "<form action=\"employerapplicationpageProcess.php\" method=\"post\" enctype=\"multipart/form-data\">";
                      echo "<tr>";
                      echo "<td><input type=\"hidden\" name= 'AppId' value=" . $AppId . ">" . $AppId . "</td> ";
                      echo "<td>" . $Jobname . "</td>";
                      echo "<td>" . $Email . "</td> ";
                      echo "<td>" . $Date . "</td> ";
                      if ($Status == "Processing") {
                        echo "<td><span class='w3-tag w3-round w3-teal darker-green'>" . $Status . "</span></td>";
                      } elseif ($Status == "Offered") {
                        echo "<td><span class='w3-tag w3-round w3-yellow'>" . $Status . "</span></td>";
                      } elseif ($Status == "Rejected") {
                        echo "<td><span class='w3-tag w3-round w3-red darker-red'>" . $Status . "</span></td>";
                      }
                      echo "<td><a href=\"All_Resume/" . $Resume . "\" download>" . $Resume . "</a></td> ";
                      echo " <td><input type=\"submit\" name=\"Offer\" value =\"Offer\" class='w3-button w3-green small-button darker-green'></td>";
                      echo "<td><input type=\"submit\" name=\"Reject\" value =\"Reject\" class='w3-button w3-red small-button darker-red'></td>";
                      echo "</tr>";
                      echo "</form>";

                    }

                  }

                }
                $conn->close();
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
  </main>
  <?php include 'inc/footer.inc.php'; ?>
</body>

</html>