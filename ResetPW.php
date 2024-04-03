<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
  <link rel="stylesheet" href="CSS/ForgetPW.css">
  <?php
  include "inc/header.inc.php";
  ?>
</head>

<body>

  <?php
  include "inc/nav.inc.aboutus.php";

  session_start();
  $_SESSION["resetEmail"] = $_POST["resetEmail"];
  ?>

  <div class="container">
    <div class="cover">
      <div class="front" style="background-color: #2D2F6F;">
      </div>
    </div>
    <div class="forms">
      <div class="form-content">
        <div class="password-reset-form">
          <div class="title">Reset Password</div>
          <form action="PasswordResetProcess.php" method="post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input name="code" type="text" placeholder="Reset Code" required>
              </div>
              <div class="input-box">
                <i class="fas fa-key"></i>
                <input name="password" type="password" placeholder="New Password" required>
              </div>
              <div class="input-box">
                <i class="fas fa-key"></i>
                <input name="passwordcheck" type="password" placeholder="Confirm New Password" required>
              </div>
              <div class="button input-box">
                <input type="submit" value="Reset Password">
              </div>
            </div>
          </form>
          <div class="text sign-up-text">Remembered your password? <a href="index.php">Login now</a></div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'inc/footer.inc.php'; ?>
</body>

</html>