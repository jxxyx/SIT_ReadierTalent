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
<?php session_start(); ?>
 <div class="container">
        <div class="student-summary">
            <div class="student-photo">
                <img src="/Images/account.png" alt="Default Account">
            </div>
            <h1>Student Summary</h1>
            <form action="profileProcess.php" method="post">
            <div class="form-row">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" name='fname' id="firstName" placeholder="Full Name">
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" name='lname' id="lastName" placeholder="Last Name">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="emailaddress">Email Address</label>
                    <input type="text" name='email' id="emailaddress" placeholder="Email Address">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" name='pwd' id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="transcriptnum">Transcript Number</label>
                    <input type="text" name='transcriptnum' id="transcriptnum" placeholder="Transcript Number">
                </div>
            </div>
            </form>
            <div class="form-actions">
                    <button type="button">Cancel</button>
                    <button type="submit">Save</button>
                </div>
        </div>
        <script>
                document.getElementById("emailaddress").value = "<?php echo $_SESSION['email']; ?>";
                document.getElementById("transcriptnum").value = "<?php echo $_SESSION['transcriptnum']; ?>";
                document.getElementById("firstName").value = "<?php echo $_SESSION['fname']; ?>";
                document.getElementById("lastName").value = "<?php echo $_SESSION['lname']; ?>";
                document.getElementById("password").value = "<?php echo $_SESSION['pwd']; ?>";
            </script>
    </div>
    <?php include 'inc/footer.inc.php'; ?>
</body>
</html>
