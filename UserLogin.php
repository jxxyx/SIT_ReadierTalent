<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>User Login and Sign Up</title>
  <link rel="stylesheet" href="CSS/Login.css">
  <!-- Fontawesome CDN Link -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <?php include "inc/header.inc.php"; ?>
</head>

<body>
  <?php include "inc/nav.inc.index.php"; ?>

  <main class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="Images/main_Background.png" alt="">
        <div class="text">
          <h1 class="text-1">Seek opportunities where your passion ignites success</h1>
          <h2 class="text-2">Time to Hussle</h2>
        </div>
      </div>
      <div class="back">
        <img src="Images/main_Background.png" alt="">
        <div class="text">
          <h1 class="text-1">Join Us where your passion ignites success</h1>
          <h2 class="text-2">Time to Hussle</h2>
        </div>
      </div>
    </div>
    <div class="forms">
      <div class="form-content">
        <div class="login-form">
          <h3 class="title">User Login</h3>
          <form action="UserLoginProcess.php" method="post" enctype="multipart/form-data">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" name="email" placeholder="Enter your email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="pwd" placeholder="Enter your password" required>
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
          <h3 class="title">User Signup</h3>
          <form action="UserRegistrationProcess.php" method="post" enctype="multipart/form-data">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" id="fname" name="fname" placeholder="Enter your first name" required>
              </div>
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" id="lname" name="lname" placeholder="Enter your last name" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" id="registerEmail" name="email" placeholder="Enter your email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" id="registerPassword" name="pwd" placeholder="Enter your password" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" id="registerPasswordCheck" name="confirm_pwd" placeholder="Confirm your password" required>
              </div>
              <div class="input-box">
                <i class="fas fa-venus-mars"></i>
                <div class="gender-options">
                  <input type="radio" id="male" name="gender" value="male" required>
                  <label for="male">Male</label>
                  <input type="radio" id="female" name="gender" value="female" required>
                  <label for="female">Female</label>
                  <input type="radio" id="noanswer" name="gender" value="noanswer" required>
                  <label for="noanswer">Prefer not to say</label>
                </div>
              </div>
              <div class="input-box">
                <label for="typeofcourse">Course Type*</label>
                <select id="typeofcourse" name="typeofcourse" required>
                  <option value="" disabled selected>Select your course type</option>
                  <option value="Tech">Tech</option>
                  <option value="Business">Business</option>
                  <option value="Design">Design</option>
                  <option value="Engineering">Engineering</option>
                  <option value="Science">Science</option>
                </select>
              </div>
              <div class="input-box">
                <label for="resume-upload" class="resume-upload-label">Attach your resume in PDF format:</label>
                <input type="file" id="resume-upload" name="resume-upload" accept=".pdf" required>
              </div>
              <div class="input-box">
                <i class="fas fa-hashtag"></i>
                <input type="text" id="transcriptnum" name="transcriptnum" placeholder="Enter your transcript ID" required>
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
</main>
  <?php include 'inc/footer.inc.php'; ?>
</body>

</html>
