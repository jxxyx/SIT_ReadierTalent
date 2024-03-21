<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> User Login and Sign Up</title>
    <link rel="stylesheet" href="CSS/Login.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <?php
    include "inc/header.inc.php";
    ?>
   </head>
<body>

<?php
  include "inc/nav.inc.php";
?>

  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="Images/main_Background.png" alt="">
        <div class="text">
          <span class="text-1">Seek opportunities <br>where your passion ignites success</span>
          <span class="text-2">Time to Hussle</span>
        </div>
      </div>
      <div class="back">
        <img src="Images/main_Background.png" alt="">
          <span class="text-1">Join Us <br>where your passion ignites success</span>
          <span class="text-2">Time to Hussle</span>
        <div class="text">
        </div>
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">User Login</div>
          <form action="joblistingspage.php">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Enter your email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Enter your password" required>
              </div>
              <div class="text"><a href="/ForgetPW.php">Forgot password?</a></div>
              <div class="button input-box">
                <input type="submit" value="submit">
              </div>
              <div class="text sign-up-text">Don't have an account? <label for="flip">Signup now</label></div>
            </div>
        </form>
      </div>
      <div class="signup-form">
        <div class="title">User Signup</div>
        <form action="#" method="post" enctype="multipart/form-data">
          <div class="input-boxes">
            <div class="input-box">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Enter your name" required>
            </div>
            <div class="input-box">
              <i class="fas fa-envelope"></i>
              <input type="text" placeholder="Enter your email" required>
            </div>
            <div class="input-box">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Enter your password" required>
            </div>
            <div class="input-box">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Confirm your password" required>
            </div>
            <div class="input-box">
              <i class="fas fa-venus-mars"></i>
              <div class="gender-options">
                <input type="radio" id="male" name="gender" value="male" required>
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="female" required>
                <label for="female">Female</label>
              </div>
            </div>
            <label for="degree-upload" class="degree-upload-label">Attach your degree in PDF format:</label>
            <div class="input-box">
              <i class="fas fa-file-pdf"></i>
              <input type="file" id="degree-upload" name="degree-upload" accept=".pdf" required>
            </div>
            <div class="input-box">
              <i class="fas fa-hashtag"></i>
              <input type="text" placeholder="Enter your transcript ID" required>
            </div>
            <div class="button input-box">
              <input type="submit" value="Submit">
            </div>
            <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
          </div>
        </form>
      </div>
    </div>
    </div>
    </div>
    <?php include 'inc/footer.inc.php'; ?>
</body>
</html>