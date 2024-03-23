<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Post a Job</title>
    <?php
    include "inc/header.inc.php";
    ?>
    <link rel="stylesheet" href="CSS/JobPosting.css">
</head>

<body>
    <?php
    include "inc/nav.inc.php";
    ?>
    <main>
        <?php
        session_start();
        ?>
        <section class="form-container">
            <h1 class="form-header">Add a job</h1>
            <p class="form-header">You know what you are looking for. We help you find them. <br> Post your open positions and hire fast the best talent.</p>
            <form action="JobPostingProcess.php" method="post">
                <label for="company">Company *</label>
                <input type="text" id="company" name="company" placeholder="Your company's name" required>

                <label for="jobTitle">Job Title *</label>
                <input type="text" id="jobTitle" name="jobTitle" placeholder="Open position title" required>

                <label for="jobDescription">Job Description</label>
                <textarea id="jobDescription" name="jobDescription" placeholder="Tasks, requirements, benefits" rows="4"></textarea>

                <label for="jobPay">Job Pay *</label>
                <input type="text" id="jobPay" name="jobPay" placeholder="E.g 1000" required>

                <label for="jobVacancy">Vacancies *</label>
                <input type="text" id="jobVacancy" name="jobVacancy" placeholder="Number of Vacancies " required>

                <label for="typeOfContract">Type of Contract *</label>
                <select id="typeOfContract" name="typeOfContract" required>
                    <option value="Intern">Intern</option>
                    <option value="Full-Time">Full Time</option>
                    <option value="Part-Time">Part Time</option>
                </select>

                <label for="typeOfIndustry">Industry Type *</label>
                <select id="typeOfIndustry" name="typeOfIndustry" required>
                    <option value="Tech">Tech</option>
                    <option value="Business">FBusiness</option>
                    <option value="Design">Design</option>
                    <option value="Engineering">Engineering</option>
                    <option value="Science">Science</option>
                </select>

                <label for="jobDate">Closing Date *</label>
                <input type="text" id="jobDate" name="jobDate" placeholder="YYYY-MM-DD" required>

                <label for="location">Location *</label>
                <input type="text" id="location" name="location" placeholder="City" required>

                <label for="email">Email *</label>
                <input type="email" id="email" name="email" placeholder="Your Email Address" required>

                <button type="submit">Submit</button>
            </form>
            <script>
                document.getElementById("company").value = "<?php echo $_SESSION['company']; ?>";
                document.getElementById("email").value = "<?php echo $_SESSION['email']; ?>";
                document.getElementById("location").value = "<?php echo $_SESSION['location']; ?>";
            </script>
        </section>
    </main>
    <?php include 'inc/footer.inc.php'; ?>

</body>

</html>