<?php
session_start();
try {
    $dbUrl = getenv('DATABASE_URL');

    $dbOpts = parse_url($dbUrl);

    $dbHost = $dbOpts["host"];
    $dbPort = $dbOpts["port"];
    $dbUser = $dbOpts["user"];
    $dbPassword = $dbOpts["pass"];
    $dbName = ltrim($dbOpts["path"], '/');

    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo 'Error!: ' . $ex->getMessage();
    die();
}


if (!$_SESSION['loggedIn']) {
    echo "You do not have access";
    header("location: loginPage.php");
    die();
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
            <h1 class="headerText">
                Date details
            </h1>
        </div>
    </div>

    <div class="shadow p-4 mb-4 bg-white">
        <div class="container">

            <!-- bootstrap navbar -->
            <ul class="nav nav-tabs nav-justified">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="info.php">Account Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="schedule.php">Schedule</a>
                </li>
            </ul>
            <br>

            <?php
            $dateId = $_GET['dateId'];

            $statement = $db->prepare("SELECT month_start, month_end, day_start, day_end, year_start, year_end, info, dates.user_id FROM dates
            FULL OUTER JOIN note 
            ON note.date_id = dates.id
            WHERE dates.id = $dateId ORDER BY year_start, month_start, day_start;");

            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            $monthStart = $row['month_start'];
            $monthEnd = $row['month_end'];
            $dayStart = $row['day_start'];
            $dayEnd = $row['day_end'];
            $yearStart = $row['year_start'];
            $yearEnd = $row['year_end'];
            $info = $row['info'];
            $userId = $row['user_id'];



            $statement = $db->prepare("SELECT first_name, last_name FROM user_profile WHERE id = $userId");
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $firstname = $row['first_name'];
            $lastname = $row['last_name'];

            echo "<h3>Date reserved to $firstname, $lastname</h3>";
            echo "<p>$monthStart/$dayStart/$yearStart - $monthEnd/$dayEnd/$yearEnd $info</p>";

            ?>

        </div>
    </div>



    <script src="javascript.js"></script>
</body>

</html>