<?php
session_start();
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
  echo '<a href="loggingout.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Logout</a>';
}
?>