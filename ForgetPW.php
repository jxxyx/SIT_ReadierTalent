<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="CSS/ForgetPW.css">
  <?php
  include "inc/header.inc.php";
  ?>
</head>

<body>

  <?php
  include "inc/nav.inc.index.php";
  ?>
<main class="container">
      <div class="cover">
        <div class="front" style="background-color: #2D2F6F;">
        </div>
      </div>
      <div class="forms">
        <div class="form-content">
          <div class="password-reset-form">
            <h1 class="title">Reset Password</h1>
            <form action="ResetPW.php" method="post">
              <div class="input-boxes">
                <div class="input-box">
                  <i class="fas fa-envelope"></i>
                  <input id="resetEmail" name="resetEmail" required type="text" placeholder="Enter your email">
                </div>
                <div class="button input-box">
                  <input type="submit" value="Submit">
                </div>
              </div>
            </form>
            <div class="text sign-up-text">Remembered your password? <a href="index.php">Login now</a></div>
          </div>
        </div>
      </div>
    </div>
</main>
  <?php include 'inc/footer.inc.php'; ?>
</body>

</html>