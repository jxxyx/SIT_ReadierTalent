<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

     //if the employer clicked on offer to offer the applicant the job
    if (isset($_POST['Offer'])){


        $config = parse_ini_file('/var/www/private/db-config.ini'); 
        if ($config) 
        { 
          $conn = new mysqli( 
            $config['servername'], 
            $config['username'], 
            $config['password'], 
            $config['dbname'] 
          ); 

          if (!$conn->connect_error) 
          {  
            $stmt = $conn->prepare("UPDATE application SET status = \"Offered\" WHERE appid=?"); 

            $stmt->bind_param("i", $_POST["AppId"]); 
            $stmt->execute();
            $stmt->close();
          }
          $conn->close(); 
        } 

    }
    

    //if the employer clicked on reject to reject the applicantion
    elseif (isset($_POST['Reject'])){

        $config = parse_ini_file('/var/www/private/db-config.ini'); 
        if ($config) 
        { 
          $conn = new mysqli( 
            $config['servername'], 
            $config['username'], 
            $config['password'], 
            $config['dbname'] 
          ); 

          if (!$conn->connect_error) 
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