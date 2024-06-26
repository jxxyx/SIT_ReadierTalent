<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> User Login</title>
  <link rel="stylesheet" href="CSS/Login.css">
  <?php
  include "inc/header.inc.php";
  ?>
</head>

<body>
  <?php
  include "inc/nav.inc.index.php";
  ?>
  <main>
    <?php
    $success = true;
    $email = "";
    $pwd = "";
    $errorMsg = "";
    $fname = "";
    $lname = "";
    if (empty($_POST["email"])) {
      $success = false;
    } else {
      $email = strtolower(sanitize_input($_POST["email"]));
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $success = false;
      }
    }

    if (empty($_POST["pwd"])) {
      $success = false;
    }

    if ($success) {
      authenticateUser();
    }

    if ($success) {
      session_start();
      $_SESSION['email'] = $email;
      $_SESSION['loginType'] = "student";
      $_SESSION['loggedIn'] = true;
      $_SESSION['fname'] = $fname;
      $_SESSION['lname'] = $lname;
      header("Location: myapplicationspage.php");

      echo "
      <div class='container' style='border: 1px solid #ccc; padding: 20px; margin-top: 20px;'>
          <h1>Login Successful!</h1>
          <h3>Welcome " . $email . "</h3>
          <button onclick=\"location.href='HomePage.php'\" class='btn btn-success'>Return to Home</button><br><br>
      </div>";
    } else {
      echo "
      <div class='container' style='border: 1px solid #ccc; padding: 20px; margin-top: 20px;'>
          <h1> Oops!</h1>
          <p>" . $errorMsg . "</p>
          <button onclick=\"location.href='UserLogin.php'\"  class='btn btn-warning'>Return to Login</button><br><br>
      </div>";
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
      global $email, $pwd, $errorMsg, $success, $fname, $lname;
      $config = parse_ini_file('/var/www/private/db-config.ini');
      if (!$config) {
        $errorMsg = "Failed to read database config file";
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
          $stmt = $conn->prepare("SELECT * FROM students WHERE email =?");
          $stmt->bind_param("s", $email);
          $stmt->execute();
          $result = $stmt->get_result();
          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $pwd = $row["password"];
            $email = $row["email"];
            $lname = $row["lname"];
            $fname = $row["fname"];
            if (!password_verify($_POST["pwd"], $pwd)) {
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