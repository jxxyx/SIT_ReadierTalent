<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> User Login and Sign Up</title>
  <link rel="stylesheet" href="CSS/Login.css">
  <?php
  include "inc/header.inc.php";
  ?>
  <style>
    /* Add the CSS for the success message container here */
    .success-container {
      max-width: 600px;
      margin: 2rem auto;
      padding: 2rem;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
      position: relative;
      font-family: 'Poppins', sans-serif;
    }
    /* Add the CSS for the countdown animation here */
    .countdown-animation {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background-color: #4CAF50;
      animation: countdown 5s linear forwards;
    }
    @keyframes countdown {
      from { width: 100%; }
      to { width: 0; }
    }
    .auto-redirect {
      margin-top: 1rem;
      font-size: 0.9rem;
    }
  </style>
</head>

<body>
  <?php
  include "inc/nav.inc.php";
  ?>
  <main>
    <?php
    // Initialize variables to store form data and error messages
    $fname = $lname = $email = $pwd = $pwd_confirm = $gender = $courseType = $resume = $transcriptnum = $type = "";
    $errorMsg = "";
    $success = true;
    $courseType = $_POST["typeofcourse"];
    $gender = $_POST["gender"];

    // Check for email input
    if (empty($_POST["email"])) {
      $errorMsgEmail .= "Email is required.<br>";
      $success = false;
    } else {
      // Sanitize the input data
      $email = strtolower(sanitize_input($_POST["email"]));
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsgEmail .= "Invalid email format.";
        $success = false;
      }
      // check for duplicate email
      checkDuplicateEmail();
    }
    

    // Check for first name input
    if (empty($_POST["fname"])) {
      $errorMsgName .= "First name is required.<br>";
      $success = false;
    } else {
      $fname = sanitize_input($_POST["fname"]);
    }

    // Check for last name input
    if (empty($_POST["lname"])) {
      $errorMsgName .= "Last name is required.<br>";
      $success = false;
    } else {
      $lname = sanitize_input($_POST["lname"]);
    }

    // Check for password input
    if (empty($_POST["pwd"])) {
      $errorMsgPass .= "Password is required.<br>";
      $success = false;
    } else {
      $pwd = ($_POST["pwd"]);
      $confirm_pwd = ($_POST["confirm_pwd"]);
      if ($pwd !== $confirm_pwd) {
        $errorMsgPass .= "Password does not match.<br>";
        $success = false;
      } else {
        $hashed_pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
      }
    }

    // Check for Transcript Number input
    if (empty($_POST["transcriptnum"])) {
      $errorMsgTranscript .= "Transcript Number is required.<br>";
      $success = false;
    } else {
      $transcriptnum = sanitize_input($_POST["transcriptnum"]);
    }
    //echo is_uploaded_file($_FILES["resume-upload"];
    // check for resume input
    if (empty(basename($_FILES["resume-upload"]["name"]))) {
      $errorMsgResume .= "Resume is required.<br>";
      $success = false;
    } else {
      $resume = $_FILES["resume-upload"];
      $resumeFileType = strtolower(pathinfo($resume['name'], PATHINFO_EXTENSION));
      
      // Check if file is a pdf
      if ($resumeFileType != "pdf") {
        $errorMsgResume .= "Only PDF files are allowed.<br>";
        $success = false;
      } else {
        // Save file to All_Resume folder
        $target_dir = "All_Resume/";
        $target_file = $target_dir . basename($resume["name"]);
        if (move_uploaded_file($resume["tmp_name"], $target_file)) {
          // Store the file upload message in a variable instead of echoing it
          $fileUploadMessage = "The file " . htmlspecialchars(basename($resume["name"])) . " has been uploaded.<br>";
        } else {
          $errorMsgResume .= "Sorry, there was an error uploading your file.<br>";
          $success = false;
        }
      }
    }
    
    


    if ($success) 
    { 
      echo "
      <meta http-equiv='refresh' content='5;url=UserLogin.php'>
      <div class='success-container'>
          <h1>Registration Successful!</h1> 
          <h3>Thank you for signing up, ". htmlspecialchars($fname). " " .htmlspecialchars($lname) . "</h3>
          <p>$fileUploadMessage</p>
          <p>Your account has been created successfully. You will be redirected to the login page shortly.</p>
          <div class='countdown-animation'></div>
          <p class='auto-redirect'>If you are not redirected automatically, <a href='UserLogin.php'>click here</a>.</p>
      </div>";
      saveMemberToDB();
    } 
    else 
    { 
      echo "
      <div class='container' style='
        max-width: 600px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #fff3f3; /* Light red background for error */
        border: 1px solid #ffcccc; /* Red border */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        font-family: \"Poppins\", sans-serif;'>
        <h1 style='color: #cc0000;'>Oops!</h1> <!-- Dark red color for the text -->
        <h3>The following input errors were detected:</h3> 
        <p>" . $errorMsg . "</p>
        <p>" . $errorMsgName . "</p>
        <p>" . $errorMsgPass . "</p>
        <p>" . $errorMsgEmail . "</p>
        <p>" . $errorMsgAdd . "</p>
        <p>" . $errorMsgTranscript . "</p>
        <p>" . $errorMsgResume . "</p>
        <button onclick=\"location.href='UserLogin.php'\"  class='btn btn-danger'>Return to Sign Up</button><br><br>
    </div>";
    } 

    function sanitize_input($data) 
    { 
      $data = trim($data); 
      $data = stripslashes($data); 
      $data = htmlspecialchars($data); 
      return $data; 
    } 

    function checkDuplicateEmail() 
    { 
      global $email, $errorMsg, $success; 
  
      $config = parse_ini_file('/var/www/private/db-config.ini'); 
      if (!$config) 
      { 
        $errorMsg .= "Failed to read database config file.\n"; 
        $success = false; 
      } 
      else 
      { 
        $conn = new mysqli( 
          $config['servername'], 
          $config['username'], 
          $config['password'], 
          $config['dbname'] 
        ); 

        if ($conn->connect_error) 
        { 
          $errorMsg .= "Connection failed: " . $conn->connect_error; 
          $success = false; 
        } 
        else 
        {  
          $stmt = $conn->prepare("SELECT * FROM students WHERE email=?"); 

          $stmt->bind_param("s", $email); 
          $stmt->execute(); 
          $result = $stmt->get_result(); 
          if ($result->num_rows > 0) 
          { 
            $errorMsg .= "Email already in use.\n"; 
            $success = false;
          
          } 
          $stmt->close(); 
        }
        $conn->close(); 
      } 
    }

    function saveMemberToDB() 
    { 
      global  $fname, $lname, $email, $hashed_pwd, $resume, $transcriptnum, $errorMsg, $success, $courseType, $gender; 
  
      $config = parse_ini_file('/var/www/private/db-config.ini'); 
      if (!$config) 
      { 
        $errorMsg .= "Failed to read database config file.\n"; 
        $success = false; 
      } 
      else 
      { 
        $conn = new mysqli( 
          $config['servername'], 
          $config['username'], 
          $config['password'], 
          $config['dbname'] 
        ); 

        if ($conn->connect_error) 
        { 
          $errorMsg .= "Connection failed: " . $conn->connect_error."\n"; 
          $success = false; 
        } 
        else 
        {  
          $stmt = $conn->prepare("INSERT INTO students 
            (email, fname, lname, password, coursetype, resume, transcriptnum, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"); 
          $stmt->bind_param("ssssssss", $email, $fname, $lname, $hashed_pwd, $courseType, $resume["name"], $transcriptnum, $gender); 
          if (!$stmt->execute()) 
          { 
            $errorMsg .= "Execute failed: (" . $stmt->errno . ") " . 
              $stmt->error; 
            $success = false; 
          } 
          $stmt->close(); 
        } 

        $conn->close(); 
      } 
    } 

    ?>
  </main>

  <?php 
  include 'inc/footer.inc.php'; 
  ?>

</body>