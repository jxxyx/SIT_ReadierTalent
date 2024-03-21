<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <title>About Us</title>
  <link rel="stylesheet" href="CSS/AboutUs.css">
  <?php
    include "inc/header.inc.php";
    ?>
  <!-- Custom JS -->
  <script defer src="/JS/AboutUs.js"></script>
  <!-- Tinyslider JS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php
    include "inc/nav.inc.php";
    ?>
<div class="about-section">
    <h1>About Us Page</h1>
    <p>Some text about who we are and what we do.</p>
    <p>Resize the browser window to see that this page is responsive by the way.</p>
  </div>
  
  <h2 style="text-align:center; color: white">Our Team</h2>
  <br>
  <section id="slider">
    <div class="carousel">
      <div class="subcarousel">
        <div class="slider-wrapper">
          <div class="my-slider">
            <div>
              <div class="slide">
                <div class="slide-img">
                  <img src="Images/account.png" alt="Member 1">
                  <div class="team-info">
                    <h3>Member Name 1</h3>
                    <p class="title">Position 1</p>
                    <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                    <p>mike@example.com</p>
                    <p><button class="button">Contact</button></p>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <div class="slide">
                <div class="slide-img">
                  <img src="Images/account.png" alt="Member 1">
                  <div class="team-info">
                    <h3>Member Name 2</h3>
                    <p class="title">Position 2</p>
                    <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                    <p>mike@example.com</p>
                    <p><button class="button">Contact</button></p>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <div class="slide">
                <div class="slide-img">
                  <img src="Images/account.png" alt="Member 1">
                  <div class="team-info">
                    <h3>Member Name 3</h3>
                    <p class="title">Position 3</p>
                    <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                    <p>mike@example.com</p>
                    <p><button class="button">Contact</button></p>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <div class="slide">
                <div class="slide-img">
                  <img src="Images/account.png" alt="Member 1">
                  <div class="team-info">
                    <h3>Member Name 4</h3>
                    <p class="title">Position 4</p>
                    <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                    <p>mike@example.com</p>
                    <p><button class="button">Contact</button></p>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <div class="slide">
                <div class="slide-img">
                  <img src="Images/account.png" alt="Member 1">
                  <div class="team-info">
                    <h3>Member Name 5</h3>
                    <p class="title">Position 5</p>
                    <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                    <p>mike@example.com</p>
                    <p><button class="button">Contact</button></p>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="/JS/AboutUs.js"></script>
  <?php include 'inc/footer.inc.php'; ?>
</body>