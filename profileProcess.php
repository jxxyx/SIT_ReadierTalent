<?php
session_start();

$email = $password = $fname = $lname = $transcriptnum = $errorMsg = "";




$success = true;

function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (!isset($_SESSION["loggedIn"])) {
    $email = sanitize_input($_POST["email"]);
    $password = sanitize_input($_POST["pwd"]);
    $fName = sanitize_input($_POST["fname"]);
    $lname = sanitize_input($_POST["lname"]);
    $transcriptnum = sanitize_input($_POST["transcriptnum"]);
}


updateProfile();
    if($success){
        header("Location: index.php");
    }else {
        header("Location: profile.php");
    }
function updateProfile()
{
    global $email, $password, $fname, $lname, $transcriptnum, $success;

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
            $stmt = $conn->prepare("UPDATE students SET fname=?, lname=?, email=?, pwd=?, transcriptnum=? WHERE id=?");
            // Bind & execute the query statement:
            $stmt->bind_param("sssssi", $fname, $lname, $email, $password, $transcriptnum, $_SESSION['email']);
            if (!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                $success = false;
            }
            $stmt->close();
        }
        $conn->close();
    }
}
?>