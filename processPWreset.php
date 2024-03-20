<?php

session_start();
$code = $pwd = $passwordcheck = $email = $errorMsg = "";
$success = true;
$email = $_SESSION["resetEmail"];
echo $email;

if (empty($email)) {
    $errorMsg .= "Email is required.<br>";
    $success = false;
} else {
    $email = sanitize_input($email);
    // Additional check to make sure e-mail address is well-formed.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg .= "Invalid email format.";
        $success = false;
    }
}
if (empty($_POST["password"])) {
    $errorMsg .= "Password is required.<br>";
    $success = false;
} else if (empty($_POST["passwordcheck"])) {
    $errorMsg .= "Confirmation password is required.<br>";
    $success = false;
} else {
    $pwd = password_hash($_POST["password"], PASSWORD_DEFAULT);
    if (!password_verify($_POST["passwordcheck"], $pwd)) {
        $errorMsg .= "Passwords do not match please try again. <br>";
        $errorMsg .= $password . "<br>";
        $errorMsg .= $passwordcheck . "<br>";
        $success = false;
    }
}
$code = $_POST["code"];
if ($success && $code == "1234") {
    updatePassword();
}

if($success){
    header("Location: index.php");
}else {
    echo $errorMsg;
}


function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function updatePassword(){
    global $pwd, $email, $errorMsg, $success;

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

            $stmt = $conn->prepare("UPDATE employer SET password=? WHERE email=?");
            // Bind & execute the query statement:
            $stmt->bind_param("ss", $pwd, $email);
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


?>