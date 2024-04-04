<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> Employer Login and Sign Up</title>
  <link rel="stylesheet" href="CSS/Login.css">
  <?php
  include "inc/header.inc.php";
  ?>
</head>



<body>
  <?php
  include "inc/nav.inc.index.php";
  ?>
  <main class="container">
    <?php
    $success = true;
    $email = "";
    $company = "";
    $pwd = "";
    $location = "";
    $errorMsg = "";


    if (empty($_POST["Lemail"])) {
      $errorMsg = "no email";
      $success = false;
    } else {
      $email = strtolower(sanitize_input($_POST["Lemail"]));
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $success = false;
      }
    }

    if (empty($_POST["Lpwd"])) {
      $errorMsg = "no password";
      $success = false;
    }

    if ($success) {
      authenticateUser();
    }

    if ($success) {
      session_start();
      $_SESSION['email'] = $email;
      $_SESSION['company'] = $company;
      $_SESSION['location'] = $location;
      $_SESSION['loggedIn'] = true;
      $_SESSION['loginType'] = "employer";

      header("Location: JobPosting.php");
    } else {
      echo "<h1> Oops!</h1>";
      echo "<p>" . $errorMsg . "</p>";
      echo "<button onclick=\"location.href='EmployerLogin.php'\"  class='btn btn-warning'>Return to Login</button><br><br>";
    }

    function sanitize_input($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }


    function authenticateUser()
    {
      global $email, $company, $pwd, $location, $errorMsg, $success;

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

        if ($conn->connect_error) {
          $errorMsg = "Connection failed: " . $conn->connect_error;
          $success = false;
        } else {
          $stmt = $conn->prepare("SELECT * FROM employer WHERE email=?");


          $stmt->bind_param("s", $email);
          $stmt->execute();
          $result = $stmt->get_result();
          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $company = $row["company"];
            $location = $row["location"];
            $pwd = $row["password"];

            if (!password_verify($_POST["Lpwd"], $pwd)) {
              $errorMsg = "Email not found or password doesn't match...";
              $success = false;
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
  </main>
  <?php include 'inc/footer.inc.php'; ?>
</body>

</html>