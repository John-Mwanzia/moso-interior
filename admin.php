<!-- admin page -->
<?php
// require_once 'includes/header.php';
require_once 'includes/auth_check.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
       <!-- CSS FILES -->
       <link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap" rel="stylesheet">

<link href="css/bootstrap.min.css" rel="stylesheet">

<link href="css/bootstrap-icons.css" rel="stylesheet">

<link href="css/owl.carousel.min.css" rel="stylesheet">

<link href="css/tooplate-moso-interior.css" rel="stylesheet">

</head>
<body>
<div class="container">
    <h1>Admin Dashboard</h1>
    <!-- <p>Welcome, <?php echo $_SESSION['username']; ?>!</p> -->

    <div class="row">
        <div class="col-12 mt-5">
            <h3>Download Contacts Report</h3>
            <a href="includes/generate_report.php?format=csv" class="" style=" background-color: #ED7020; padding: 0.8rem 1rem; color: white; border-radius:4px">Download CSV</a>
            <a href="includes/generate_report.php?format=pdf" class="" style=" background-color: #ED7020; padding: 0.8rem 1rem; color: white; border-radius:4px">Download PDF</a>
            <a href="includes/generate_report.php?format=excel" class="" style=" background-color: #ED7020; padding: 0.8rem 1rem; color: white; border-radius:4px">Download Excel</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mt-5">
            <h3>Manage Users</hh3>
            <a href="ViewUsers.php" class="" style=" background-color: #ED7020; padding: 0.6rem 1rem; color: white; border-radius:4px">View Users</a>
        </div>
    </div>

    <div class="row">
        <!-- users report -->

        <div class="col-12 mt-5">
            <h3>Download Users Report</h3>
            <a href="includes/generate_users_report.php?format=csv" class="" style=" background-color: #ED7020; padding: 0.8rem 1rem; color: white; border-radius:4px">Download CSV</a>
            <a href="includes/generate_users_report.php?format=pdf" class="" style=" background-color: #ED7020; padding: 0.8rem 1rem; color: white; border-radius:4px">Download PDF</a>
            <a href="includes/generate_users_report.php?format=excel" class="" style=" background-color: #ED7020; padding: 0.8rem 1rem; color: white; border-radius:4px">Download Excel</a>
            
        </div>

    </div>
</div> 
</body>
</html>

