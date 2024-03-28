<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (isset($_POST['Offer'])){

        $errorMsg = "";
        $success = true;


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
            $stmt = $conn->prepare("UPDATE application SET status = \"Offered\" WHERE appid=?"); 

            $stmt->bind_param("i", $_POST["AppId"]); 
            $stmt->execute();
            $stmt->close();
          }
          $conn->close(); 
        } 

    }
    elseif (isset($_POST['Reject'])){

        $errorMsg = "";
        $success = true;


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
            $stmt = $conn->prepare("UPDATE application SET status = \"Rejected\" WHERE appid=?"); 

            $stmt->bind_param("i", $_POST["AppId"]); 
            $stmt->execute();
            $stmt->close();
          }
          $conn->close(); 
        }

    }
    header("Location: employerapplicationpage.php");
}
?>