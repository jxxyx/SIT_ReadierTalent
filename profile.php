<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Profile </title>
    <link rel="stylesheet" href="CSS/profile.css">
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

 <div class="container">
        <div class="student-summary">
            <div class="student-photo">
                <img src="/Images/account.png" alt="Default Account">
            </div>
            <h1>Student Summary</h1>
            <form action="#" method="post">
            <div class="form-row">
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" placeholder="Full Name">
                </div>
                <div class="form-group">
                    <label for="nric">NRIC/FIN</label>
                    <input type="text" id="nric" placeholder="NRIC/FIN">
                </div>
                <div class="form-group">
                    <label for="studentId">Student ID/Matric No</label>
                    <input type="text" id="studentId" placeholder="Student ID/Matric No">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="emailaddress">Email Address</label>
                    <input type="text" id="emailaddress" placeholder="Email Address">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="degreeid">Degree ID</label>
                    <input type="text" id="degreeid" placeholder="Degree ID">
                </div>
            </div>
            </form>
            <div class="form-actions">
                    <button type="button">Cancel</button>
                    <button type="submit">Save</button>
                </div>
        </div>
    </div>
    <?php include 'inc/footer.inc.php'; ?>
</body>
</html>
