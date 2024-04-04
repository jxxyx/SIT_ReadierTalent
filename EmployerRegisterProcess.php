<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> Employer Login and Sign Up</title>
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
  include "inc/nav.inc.index.php";
  ?>
  <main class="container">
    <?php 
    $email = $errorMsgEmail = ""; 
    $success = true; 
    $errorMsgName = "";
    $errorMsgPass = "";
    $errorMsgAdd = "";
    $errorMsg = "";
    $CName="";
    $CLocation="";
    $pwd = "";
    $confirm_pwd = "";
    $hashed_pwd = "";


    if (empty($_POST["email"])) 
    { 
      $errorMsgEmail .= "Email is required.<br>"; 
      $success = false; 
    } 
    else 
    { 
      $email = strtolower(sanitize_input($_POST["email"]));
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
      { 
        $errorMsgEmail .= "Invalid email format."; 
        $success = false; 
      } 
      checkDuplicateEmail();
    }

    if (empty($_POST["cname"])) 
    { 
      $errorMsgName .= "Last name is required.<br>"; 
      $success = false; 

    } 

    else 
    { 
      $CName = sanitize_input($_POST["cname"]);
      // checkDuplicateCompany();
    }

    if (empty($_POST["address"])) 
    { 
      $errorMsgAdd .= "Address is required.<br>"; 
      $success = false; 

    } 

    else 
    { 
      $CLocation = sanitize_input($_POST["address"]);
    }


    if (empty($_POST["pwd"]))
    {
      $errorMsgPass .= "Password is required.<br>"; 
      $success = false; 
    }
    else
    {
      $pwd = sha1($_POST["pwd"]);
      $confirm_pwd = sha1($_POST["confirm_pwd"]);
      if ($pwd !== $confirm_pwd){
        $errorMsgPass .= "Password does not match.<br>";
        $success = false;
      }
      else
      {
        $hashed_pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
      }
    }

    if ($success) 
    { 
      echo "
      <meta http-equiv='refresh' content='5;url=EmployerLogin.php'>
      <div class='success-container'>
          <h1>Registration Successful!</h1> 
          <h3>Thank you for signing up, ". htmlspecialchars($CName). "</h3>
          <p>Your account has been created successfully. You will be redirected to the login page shortly.</p>
          <div class='countdown-animation'></div>
          <p class='auto-redirect'>If you are not redirected automatically, <a href='EmployerLogin.php'>click here</a>.</p>
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
          $stmt = $conn->prepare("SELECT * FROM employer WHERE email=?"); 

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

    // function checkDuplicateCompany() 
    // { 
    //   global $CName, $errorMsg, $success; 
  
    //   $config = parse_ini_file('/var/www/private/db-config.ini'); 
    //   if (!$config) 
    //   { 
    //     $errorMsg .= "Failed to read database config file.\n"; 
    //     $success = false; 
    //   } 
    //   else 
    //   { 
    //     $conn = new mysqli( 
    //       $config['servername'], 
    //       $config['username'], 
    //       $config['password'], 
    //       $config['dbname'] 
    //     ); 

    //     if ($conn->connect_error) 
    //     { 
    //       $errorMsg .= "Connection failed: " . $conn->connect_error; 
    //       $success = false; 
    //     } 
    //     else 
    //     {  
    //       $stmt = $conn->prepare("SELECT * FROM employer WHERE company=?"); 

    //       $stmt->bind_param("s", $CName); 
    //       $stmt->execute(); 
    //       $result = $stmt->get_result(); 
    //       if ($result->num_rows > 0) 
    //       { 
    //         $errorMsg .= "Company already in registered.\n"; 
    //         $success = false;
          
    //       } 
    //       $stmt->close(); 
    //     }
    //     $conn->close(); 
    //   } 
    // }

    function saveMemberToDB() 
    { 
      global $CName, $CLocation, $email, $hashed_pwd, $errorMsg, $success; 
  
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
          $stmt = $conn->prepare("INSERT INTO employer 
            (email, password, location, company) VALUES (?, ?, ?, ?)"); 

          $stmt->bind_param("ssss", $email, $hashed_pwd, $CLocation, $CName); 
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
  <?php include 'inc/footer.inc.php'; ?>
</body>

</html>