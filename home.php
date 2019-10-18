<?php
session_start();
$loggedIn = false;

$_SESSION['username'] = "jordan";
$_SESSION['password'] = "password";
$firstName = "Jordan";
$lastName = "Burdett";

if ($_SESSION['username'] || $_SESSION['password']) {
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
                echo "<a href='login.php' id='login_here'><p class='loggedIn'>Login Here</p>";
            }
            ?>


        </div>
    </div>

    <?php
    if (!$loggedIn) {

        echo "
    <div class='loginBox' id='loginBox'>
        <div class='shadow p-4 mb-4 bg-white'>
            <div class='card'>
                <div class='card-body'>
                    <h4 class='card-title'>Login</h4>
                    <p class='card-text'>Some example text. Some example text.</p>
                </div>
            </div>
        </div>
    </div>";
    }
    ?>

    <div class="shadow p-4 mb-4 bg-white">
        <div class="container">

            <!-- bootstrap navbar -->
            <ul class="nav nav-tabs nav-justified">
                <li class="nav-item">
                    <a class="nav-link active" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="info.php">Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link 3</a>
                </li>
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

    <div class="shadow p-4 mb-4 bg-white">
        <div class="container-fluid" style="background-color='whitesmoke; padding-top: 50px;">

            <p>Created by Jordan Burdett - jordan@burdett.us - 801-725-5109</p>
        </div>
    </div>

    <script src="javascript.js"></script>
</body>

</html>