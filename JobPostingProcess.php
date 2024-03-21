<?php

session_start();

$jobname = $jobpay = $jobdescription = $jobrequirements = $company = $coursetype = $jobtype = $date = $vacancy = "";

$jobname = $_POST["jobTitle"];
$jobpay = $_POST["jobPay"];
$jobdescription = $_POST["jobDescription"];
$company = $_POST["company"];
$jobtype = $_POST["typeOfContract"];
$vacancy = $_POST["jobVacancy"];
$coursetype = $_POST["typeOfIndustry"];
$date = $_POST["jobDate"];

$success = true;
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

insertJobPost();
if($success){
    header("Location: index.php");
}else {
    header("Location: JobPosting.php");
}

function insertJobPost()
{
    global $jobname, $jobpay, $jobdescription, $company, $coursetype, $jobtype, $date, $vacancy, $success;

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
                $stmt = $conn->prepare("INSERT INTO job (jobname, jobpay, description, 
                company, coursetype, jobtype, closingdate, vacancy) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            // Bind & execute the query statement:
            $stmt->bind_param("sisssssi", $jobname, $jobpay, $jobdescription,
                                        $company, $coursetype, $jobtype, $date, $vacancy);
            if (!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ") " .
                    $stmt->error;
                $success = false;
            }
            $stmt->close();
        }
        $conn->close();
    }
}
