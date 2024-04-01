<?php
session_start();

$email = $password = $fname = $lname = $transcriptnum = $errorMsg = $location = $companyName = "";

$success = true;

function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_SESSION["loggedIn"])) {
    $email = sanitize_input($_POST["email"]);
    if($_POST["pwd"] != "" && $_POST["password"] != null)
        $password = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
    $fName = sanitize_input($_POST["fname"]);
    $lname = sanitize_input($_POST["lname"]);
    $transcriptnum = sanitize_input($_POST["transcriptnum"]);
    $location = sanitize_input($_POST["location"]);
    $companyName = sanitize_input($_POST["companyName"]);
}


updateProfile();
if ($success) {
    header("Location: profile.php");
} else {
    if($_SESSION["loginType"] == "student"){
        header("Location: myapplicationspage.php");
    }else if ($_SESSION["loginType"] == "employer"){
        header("Location: employerapplicationpage.php");
    }
}
function updateProfile()
{
    global $email, $password, $fname, $lname, $transcriptnum, $success, $location, $companyName;

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
            if ($_SESSION["loginType"] == "student") {
                if ($password != "") {
                    $stmt = $conn->prepare("UPDATE students SET fname=?, lname=?, email=?, password=?, transcriptnum=? WHERE email=?");
                    $stmt->bind_param("ssssss", $fname, $lname, $email, $password, $transcriptnum, $_SESSION['email']);
                } else {
                    $stmt = $conn->prepare("UPDATE students SET fname=?, lname=?, email=?, transcriptnum=? WHERE email=?");
                    $stmt->bind_param("sssss", $fname, $lname, $email, $transcriptnum, $_SESSION['email']);
                }
                if (!$stmt->execute()) {
                    $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                    $success = false;
                }
            }else if ($_SESSION["loginType"] == "employer"){
                if ($password != "") {
                    $stmt = $conn->prepare("UPDATE employer SET email=?, password=?, location=?, company=? WHERE email=?");
                    $stmt->bind_param("sssss", $email, $password, $location, $companyName, $_SESSION['email']);
                } else {
                    $stmt = $conn->prepare("UPDATE employer SET email=?, location=?, company=? WHERE email=?");
                    $stmt->bind_param("ssss", $email, $location, $companyName, $_SESSION['email']);
                }
                if (!$stmt->execute()) {
                    $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                    $success = false;
                }
            }
            $stmt->close();
        }
        $conn->close();
    }
}
