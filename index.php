<!DOCTYPE html>
<html lang="en">
<head>
<title>SIT Readier Talent Portal</title>
<meta charset="UTF-8">
<?php
    include "inc/header.inc.php";
    ?>
<link rel="stylesheet" href="CSS/index.css">
<!-- Custom JS -->
<script defer src="/JS/Index.js"></script>
</head>
<body>

<?php
  include "inc/nav.inc.aboutus.php";
?>

<main>
<div class="content">
  <h1 class="header">Welcome to SIT Readier Talent Portal</h1>
  <form style="display: inline" action="/UserLogin.php" method="get"><button class="button">Student Login</button>
</form>
  
  <form style="display: inline" action="/EmployerLogin.php" method="get"><button class="button">Employer Login</button>
</form>
</div>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">


<!-- END MAIN -->
</div>
</main>
<?php include 'inc/footer.inc.php'; ?>
</body>
</html>
