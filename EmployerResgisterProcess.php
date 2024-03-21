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
      $email = sanitize_input($_POST["email"]);
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
      checkDuplicateCompany();
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
        <h1>Registration successful!</h1> 
        <h3>Thank you for signing up, ". $CName . "</h3>";
      echo "<button onclick=\"location.href='EmployerLogin.php'\" class='btn btn-success'>Log-in</button><br><br>";
      saveMemberToDB();
    } 
    else 
    { 
      echo "<h1 > Oops!</h1>";
      echo "<h3>The following input errors were detected:</h3>"; 
      echo "<h3>" . $errorMsg. "</h3>";
      echo "<h3>" . $errorMsgName . "</h3>";
      echo "<h3>" . $errorMsgPass . "</h3>";
      echo "<h3>" . $errorMsgEmail . "</h3>";
      echo "<h3>" . $errorMsgAdd . "</h3>";
      echo "<button onclick=\"location.href='EmployerLogin.php'\"  class='btn btn-danger'>Return to Sign Up</button><br><br>"; 
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

    function checkDuplicateCompany() 
    { 
      global $CName, $errorMsg, $success; 
  
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
          $stmt = $conn->prepare("SELECT * FROM employer WHERE company=?"); 

          $stmt->bind_param("s", $CName); 
          $stmt->execute(); 
          $result = $stmt->get_result(); 
          if ($result->num_rows > 0) 
          { 
            $errorMsg .= "Company already in registered.\n"; 
            $success = false;
          
          } 
          $stmt->close(); 
        }
        $conn->close(); 
      } 
    }

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