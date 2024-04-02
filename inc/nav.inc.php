<nav class="navbar navbar-expand-custom navbar-mainbg">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <div class="hori-selector">
        <div class="left"></div>
        <div class="right"></div>
      </div>
      <li class="nav-item">
        <a class="nav-link" href=<?php
                                  session_start();
                                  if ($_SESSION["loginType"] == "student")
                                    echo "myapplicationspage.php";
                                  else if ($_SESSION["loginType"] == "employer")
                                    echo "employerapplicationpage.php";
                                  ?>>
          <i class="fas fa-tachometer-alt"></i>Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="joblistingspage.php"><i class="far fa-address-book"></i>Jobs</a>
      </li>
      <?php if ($_SESSION["loginType"] == "employer") {
        echo "<li class='nav-item'>";
        echo "<a class='nav-link' href='JobPosting.php'><i class='far fa-address-book'></i>Add a Job</a>";
        echo "</li>";
      }
      ?>

      <li class="nav-item">
        <a class="nav-link" href="profile.php"><i class="far fa-clone"></i>My Profile</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
      </li>
    </ul>
  </div>
</nav>