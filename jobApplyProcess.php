<?php

//start session
session_start();
//initialize variables
$email = $jobname = $companyname = "";
//set values
$success = true;
$email = $_SESSION["email"];
$jobname = $_POST["jobName"];
$companyname = $_POST["companyName"];
if(!isset($_SESSION["loggedIn"])){
    header("Location: index.php");
}else {
    checkApplication();
}

if ($success){
    applyJob();
    header("Location: myapplicationspage.php");
}else{
    header("Location: joblistingspage.php");
}

function checkApplication(){
    global $success, $email, $jobname, $companyname;
    $config = parse_ini_file('/var/www/private/db-config.ini');
    if (!$config) {
        $errorMsg = "Failed to read database config file.";
        $success = false;
    } else {
        $conn = new mysqli(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['dbname']
        );

        // Check connection
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
            // Prepare the statement:
            $stmt = $conn->prepare("SELECT * FROM application WHERE jobname=? AND company=? AND email=?");
            // Bind & execute the query statement:
            $stmt->bind_param("sss", $jobname, $companyname, $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $sucess= false;
            $stmt->close();
        }
        $conn->close();
    }
}
}

function applyJob(){
    global $email, $jobname, $companyname;

    // Create database connection.
    $config = parse_ini_file('/var/www/private/db-config.ini');
    if (!$config) {
        $errorMsg = "Failed to read database config file.";
        $success = false;
    } else {
        $conn = new mysqli(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['dbname']
        );

        $conn2 = new mysqli(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['dbname']
        );
        // Check connection
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
            // Prepare the statement:
            $stmt = $conn->prepare("SELECT * FROM job WHERE jobname=? AND company=?");
            // Bind & execute the query statement:
            $stmt->bind_param("ss", $jobname, $companyname);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                // Note that email field is unique, so should only have
                // one row in the result set.
                for ($i = 0; $i < $result->num_rows; $i++) {
                    $row = $result->fetch_assoc();
                    $jobId = $row["jobid"];
                    $applicationStatus = "Processing";
                    $date = date("Y-m-d");

                    //get info from jobs table using jobid
                    $stmt2 = $conn2->prepare("INSERT INTO application (jobid,email, date, status) VALUES (?, ?, ?, ?)");
                    $stmt2->bind_param("ssss", $jobId, $email, $date, $applicationStatus);
                    $stmt2->execute();
                    
                    $stmt2->close();
                    $conn2->close();
                }
            } else {
                $success = false;
            }
            $stmt->close();
        }
        $conn->close();
    }
}

?>