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
        <div class="text">
        </div>
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Employer Login</div>
          <form action="EmployerLoginProcess.php" method="post" enctype="multipart/form-data">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="email" id = "Lemail" name="Lemail" placeholder="Enter your email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" id="Lpwd" name= "Lpwd" placeholder="Enter your password" required>
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
        <div class="title">Employer Signup</div>
        <form action="EmployerResgisterProcess.php" method="post" enctype="multipart/form-data">
          <div class="input-boxes">
            <div class="input-box">
              <i class="fas fa-building"></i>
              <input type="text" id = "cname" name="cname" placeholder="Enter your company name" required>
            </div>
            <div class="input-box">
              <i class="fas fa-envelope"></i>
              <input type="text" id = "email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="input-box">
              <i class="fas fa-lock"></i>
              <input type="password" id = "pwd" name="pwd" placeholder="Enter your password" required>
            </div>
            <div class="input-box">
              <i class="fas fa-lock"></i>
              <input type="password" id = "confirm_pwd" name="confirm_pwd" placeholder="Confirm your password" required>
            </div>
            <!-- <div class="input-box">
              <i class="fas fa-venus-mars"></i> -->
              <!-- <div class="gender-options">
                <input type="radio" id="male" name="gender" value="male" required>
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="female" required>
                <label for="female">Female</label>
              </div> -->
            <!-- </div> -->
            <div class="input-box">
              <i class="fas fa-building"></i>
              <input type="text" id = "address" name="address" placeholder="Enter your company address" required>
            </div>
            <div class="button input-box">
                <input type="submit" value="submit">
            </div>
            <!-- <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div> -->
          </div>
        </form>
        <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
      </div>
    </div>
    </div>
    </div>
    <?php include 'inc/footer.inc.php'; ?>
</body>

</html>