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
if (!isset($_SESSION["loggedIn"])) {
    header("Location: index.php");
} else {
    deletePosting();
}

if ($success) {
    header("Location: joblistingspage.php");
} else {
    header("Location: joblistingspage.php");
}

function deletePosting()
{
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
            $stmt = $conn->prepare("DELETE FROM job WHERE jobname=? AND company=?");
            // Bind & execute the query statement:
            $stmt->bind_param("ss", $jobname, $companyname);
            if (!$stmt->execute()) {
                $sucess = false;
                $stmt->close();
            }
            $conn->close();
        }
    }
}
