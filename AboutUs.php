<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <title>About Us</title>
  <link rel="stylesheet" href="CSS/AboutUs.css">
  <?php include "inc/header.inc.php"; ?>
  <!-- Custom JS -->
  <script defer src="/JS/AboutUs.js"></script>
  <!-- Tinyslider JS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php include "inc/nav.inc.index.php"; ?>
<main> <!-- main landmark -->
<div class="about-section">
    <h1>About Us Page</h1>
    <p>At the School of Information Technology (SIT), we're passionate about pushing the boundaries of technology and innovation.</p>
    <p>Our student project is a testament to our dedication to learning and creativity.</p>
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
                  <img src="Images/shilong.png" alt="Member 1">
                  <div class="team-info">
                    <h3>ShiLong</h3>
                    <p class="title">Back end Developer</p>
                    <p>SIT Student</p>
                    <p>2303344@sit.singaporetech.edu.sg</p>
                    <p><button class="button" data-email="2303344@sit.singaporetech.edu.sg">Contact</button></p>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <div class="slide">
                <div class="slide-img">
                  <img src="Images/junyu.png" alt="Member 1">
                  <div class="team-info">
                    <h3>Jun Yu</h3>
                    <p class="title">Back end Developer</p>
                    <p>SIT Student</p>
                    <p>2302997@sit.singaporetech.edu.sg</p>
                    <p><button class="button" data-email="2302997@sit.singaporetech.edu.sg">Contact</button>
</p>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <div class="slide">
                <div class="slide-img">
                  <img src="Images/weiqiang.png" alt="Member 1">
                  <div class="team-info">
                    <h3>Wei Qiang</h3>
                    <p class="title">Back end Developer</p>
                    <p>SIT Student</p>
                    <p>2303095@sit.singaporetech.edu.sg</p>
                    <p><button class="button" data-email="2303095@sit.singaporetech.edu.sg">Contact</button></p>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <div class="slide">
                <div class="slide-img">
                  <img src="Images/jovan.png" alt="Member 1">
                  <div class="team-info">
                    <h3>Jovan</h3>
                    <p class="title">Front End Developer</p>
                    <p>SIT Student</p>
                    <p>2303397@sit.singaporetech.edu.sg</p>
                    <p><button class="button" data-email="2303397@sit.singaporetech.edu.sg">Contact</button></p>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <div class="slide">
                <div class="slide-img">
                  <img src="Images/mingzhao.png" alt="Member 1">
                  <div class="team-info">
                    <h3>Ming Zhao</h3>
                    <p class="title">Front End Developer</p>
                    <p>SIT Student</p>
                    <p>2303045@sit.singaporetech.edu.sg</p>
                    <p><button class="button" data-email="2303045@sit.singaporetech.edu.sg">Contact</button></p>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
  </section>
  </main>


  <script src="/JS/AboutUs.js"></script>
  <?php include 'inc/footer.inc.php'; ?>
</body>
</html>