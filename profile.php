<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Profile </title>
    <link rel="stylesheet" href="CSS/Profile.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <?php
    include "inc/header.inc.php";
    ?>
</head>

<body>

    <?php
    include "inc/nav.inc.php";
    ?>
    <?php session_start();
    $email = $_SESSION["email"];
    $fname = $lname = $transcriptnum = $companyName = $location = "";
    if (isset($_SESSION["loginType"])) {
        getUser();
    } else {
        header("Location: index.php");
    }
    function getUser()
    {
        global $email, $pwd, $errorMsg, $success, $fname, $lname, $transcriptnum, $companyName, $location;
        $config = parse_ini_file('/var/www/private/db-config.ini');
        if (!$config) {
            $errorMsg = "Failed to read database config file";
            $success = false;
        } else {
            $conn = new mysqli(
                $config['servername'],
                $config['username'],
                $config['password'],
                $config['dbname']
            );

            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                $success = false;
            } else {
                $stmt = "";
                if ($_SESSION["loginType"] == "student") {
                    $stmt = $conn->prepare("SELECT * FROM students WHERE email =?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $pwd = $row["password"];
                        $email = $row["email"];
                        $fname = $row["fname"];
                        $lname = $row["lname"];
                        $transcriptnum = $row["transcriptnum"];
                    } else {
                        $errorMsg = "Email not found or password doesn't match...";
                        $success = false;
                    }
                } else if ($_SESSION["loginType"] == "employer") {
                    $stmt = $conn->prepare("SELECT * FROM employer WHERE email =?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $email = $row["email"];
                        $companyName = $row["company"];
                        $location = $row["location"];
                    } else {
                        $errorMsg = "Email not found or password doesn't match...";
                        $success = false;
                    }
                }

                $stmt->close();
            }
            $conn->close();
        }
    }

    ?>
    <div class="container">
        <div class="student-summary">
            <div class="student-photo">
                <img src="/Images/account.png" alt="Default Account">
            </div>
            <h1 id="studentHeader">Student Summary</h1>
            <form id="studentsummary" action="profileProcess.php" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <?php echo "<input type='text' name='fname' id='firstName' placeholder='Full Name' value='" . $fname . "'>" ?>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <?php echo "<input type='text' name='lname' id='lastName' placeholder='Last Name' value='" . $lname . "'>" ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="emailaddress">Email Address</label>
                        <?php echo "<input type='text' name='email' id='emailaddress' placeholder='Email Address' value='" . $email . "'>" ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name='pwd' id="password" placeholder="Password" value="">
                    </div>
                    <div class="form-group">
                        <label for="transcriptnum">Transcript Number</label>
                        <?php echo "<input type='text' name='transcriptnum' id='transcriptnum' placeholder='Transcript Number' value='" . $transcriptnum . "'>" ?>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button">Cancel</button>
                    <button type="submit">Save</button>
                </div>
            </form>
        </div>

        <h1 id="employerHeader">Employer Summary</h1>
        <form id="employerSummary" action="profileProcess.php" method="post">
            <div class="form-row">
                <div class="form-group">
                    <label for="emailaddress">Email Address</label>
                    <?php echo "<input type='text' name='email' id='companyemailaddress' placeholder='Email Address' value='" . $email . "'>" ?>
                </div>
                <div class="form-group">
                    <label for="companyName">Company Name</label>
                    <?php echo "<input type='text' name='companyName' id='companyName' placeholder='Company Name' value='" . $companyName . "'>" ?>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <?php echo "<input type='text' name='location' id='location' placeholder='xxxxxx' value='" . $location . "'>" ?>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" name='pwd' id="password" placeholder="Password" value="">
                </div>

            </div>

            <div class="form-actions">
                <button type="button">Cancel</button>
                <button type="submit">Save</button>
            </div>
        </form>

    </div>

    <script>
        if (document.getElementById("lastName").value == "") {
            document.getElementById("studentHeader").style.display = "none";
            document.getElementById("studentsummary").style.display = "none";
        } else {
            document.getElementById("employerHeader").style.display = "none";
            document.getElementById("employerSummary").style.display = "none";
        }
    </script>
    </div>
    <?php include 'inc/footer.inc.php'; ?>
</body>

</html>