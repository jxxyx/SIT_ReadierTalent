<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> User Login and Sign Up</title>
  <link rel="stylesheet" href="CSS/Login.css">
  <?php
  include "inc/header.inc.php";
  ?>
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
      $email = sanitize_input($_POST["email"]);
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
          echo "The file " . basename($resume["name"]) . " has been uploaded.";
        } else {
          $errorMsgResume .= "Sorry, there was an error uploading your file.<br>";
          $success = false;
        }
      }
    }
    
    


    if ($success) 
    { 
      echo "
        <h1>Registration successful!</h1> 
        <h3>Thank you for signing up, ". $fname. " " .$lname . "</h3>";
      echo "<button onclick=\"location.href='UserLogin.php'\" class='btn btn-success'>Log-in</button><br><br>";
      saveMemberToDB();
    } 
    else 
    { 
      echo "<h1 > Oops!</h1>";
      echo "<h3>The following input errors were detected:</h3>"; 
      echo "<p>" . $errorMsg. "</p>";
      echo "<p>" . $errorMsgName . "</p>";
      echo "<p>" . $errorMsgPass . "</p>";
      echo "<p>" . $errorMsgEmail . "</p>";
      echo "<p>" . $errorMsgAdd . "</p>";
      echo "<p>" . $errorMsgTranscript . "</p>";
      echo "<p>" . $errorMsgResume . "</p>";
      echo "<button onclick=\"location.href='UserLogin.php'\"  class='btn btn-danger'>Return to Sign Up</button><br><br>"; 
      
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