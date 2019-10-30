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
            <?php
            if ($loggedIn) {
                echo "<button class='btn btn-danger' onclick='logout()'>Logout</button>";
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
                    <a class='nav-link' href='schedule.php'>Schedule</a>
                </li>";
                }
                ?>
            </ul>
            <br>
            <div class="row">
                <div class="col-md-5">

                    <div class="thumbnail">
                        <a href="\images\sumrrain.png" target="_blank">
                            <img src="\images\sumrrain.png" alt="Sum-R-Rain Houseboat" style="width:100%">
                        </a>
                        <div class="caption">
                            <br>

                        </div>

                    </div>
                </div>
                <div class="col-md-7">

                    <h2>About</h2>
                    <br>

                    <p>The Sum-R-Rain houseboat is owned by the Shareholders of the Navajo Rainbow Corporation.</p>
                    <p>The boat is moored at Bullfrog Marina in the Covered slips. <br>Slip #P-17.</p>
                    <p>The houseboat is 66’ long and 16’ wide</p>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-6">
                    <div class="thumbnail">
                        <a href="/images/rainbowbridge.jpg" target="_blank">
                            <img src="/images/rainbowbridge.jpg" alt="Rainbow Bridge" style="width:100%">
                        </a>
                        <div class="caption" style="text-align:center;">
                            <p>Rainbow Bridge in Lake Powell</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="thumbnail">
                        <a href="/images/lakepowellCanyon.jpg" target="_blank">
                            <img src="/images/lakepowellCanyon.jpg" alt="Canyon at lake powell" style="width:100%">
                        </a>
                        <div class="caption" style="text-align:center;">
                            <p>Reflection Canyon Lake Powell</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="shadow p-4 mb-4 bg-whitesmoke">
        <div class="container">
            <div id="pictures" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#pictures" data-slide-to="0" class="active"></li>
                    <li data-target="#pictures" data-slide-to="1"></li>
                    <li data-target="#pictures" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="/images/antelopeCanyon.jpg" alt="Antelope Canyon" width="1100" height="500">
                    </div>

                    <div class="item">
                        <img src="/images/sunset.jpg" alt="Lake Powell Sunset" width="1100" height="500">
                    </div>

                    <div class="item">
                        <img src="/images/horseshoeBend.jpg" alt="Horse Shoe Bend Lake Powell" width="1100" height="500">
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#pictures" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#pictures" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>

            </div>
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