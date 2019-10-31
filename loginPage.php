<?php
session_start();

if ($_SESSION['loggedIn']) {
    echo "You're already logged in silly";
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
        </div>
    </div>

    <div class="shadow p-4 mb-4 bg-white">
        <div class="container" id="reload">

            <!-- bootstrap navbar -->
            <ul class="nav nav-tabs nav-justified">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="login.php">Login</a>
                </li>
            </ul>

            <div class="row">
                <div class="col">
                    <h2 class="smallHeader">Login</h2>

                    <form name="loginForm" id="loginForm">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="txt" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>

                        <input type="button" class="btn btn-primary" onsubmit="login()">Login</button>
                    </form>
                </div>

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