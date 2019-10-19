<?php
session_start();

$loggedIn = false;
$firstName = "";
$lastName = "";

if ($_SESSION['loggedIn'] != null) {
    $loggedIn = true;
    $firstName = $_SESSION['first_name'];
    $lastname = $_SESSION['last_name'];
} else {
    $loggedIn = false;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Lake Powell Share Holder</title>
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="bg">
        <div class="header">

            <div class="headerText">
                Sum-R-Rain
            </div>

            <p class="headerSmall">Shareholder website</p>


            <?php
            if ($loggedIn) {
                echo "<p class='loggedIn' style='text-align:left; padding-left 5%;'>Welcome $firstName $lastName</p>";
            } else {
                echo "<a href='loginPage.php' class='btn btn-primary' id='login_here'>Login Here</a>";
            }
            ?>


        </div>
    </div>

    <div class="shadow p-4 mb-4 bg-white">
        <div class="container">

            <!-- bootstrap navbar -->
            <ul class="nav nav-tabs nav-justified">
                <li class="nav-item">
                    <a class="nav-link active" href="home.php">Home</a>
                </li>

                <?php

                if ($loggedIn) {

                    echo "
                <li class='nav-item'>
                    <a class='nav-link' href='info.php'>Info</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#'>Link 3</a>
                </li>";
                }
                ?>
            </ul>

            <div class="row">
                <div class="col">
                    <h2 class="smallHeader">col1</h2>
                </div>
                <div class="col">
                    <h2 class="smallHeader">col2</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="shadow p-4 mb-4 bg-whitesmoke">
        <div class="container">
            <div class="display-4" style="text-align:center;">
                Pictures
            </div>

            <?php
            if ($loggedIn) {
             echo "button class='btn btn-danger' onclick='logout()'>Logout</button>";
            }

            ?>
        </div>
    </div>

    <div class="shadow p-4 mb-4 bg-white">
        <div class="container-fluid" style="background-color='whitesmoke; padding-top: 50px;">

            <p style="text-align:center;">Created by Jordan Burdett - jordan@burdett.us - 801-725-5109</p>
        </div>
    </div>

    <script src="javascript.js"></script>
</body>

</html>