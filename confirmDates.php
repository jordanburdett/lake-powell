<?php

session_start();

if ($_SESSION['loggedIn'] != true) {
    echo "You do not have access";
    die();
}

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


?>

<!DOCTYPE html>
<html>

<head>
    <title>Lake Powell Calendar</title>
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="javascript.js"></script>
</head>

<body>

    <div class="bg">
        <div class="header">
            <h1 class="headerText">
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
                    <a class="nav-link" href="schedule.php">Schedule</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="info.php">Account Info</a>
                </li>
            </ul>

<?php

$dayStart = $_POST['dayStart'];
$dayEnd = $_POST['dayEnd'];
$year = $_POST['year'];
$month = $_POST['month'];
$user_id = $_POST['user_id'];
$info = $_POST['info'];

$statement = $db->prepare("INSERT INTO dates(user_id, month_start, month_end, day_start, day_end, year_start, year_end
VALUES ($user_id,$month, $month, $dayStart, $dayEnd, $year, $year)");

$statement->execute();

$date_id = $db->lastInsertId('dates_id_seq');

$statement = $db->prepare("Insert INTO note(user_id, date_id, info)
VALUES ($user_id, $date_id, $info");

echo "<p>Your dates for $month/$startDay/$year - $month/$dayEnd/$year</p>";
echo "<p>Notes - $info</p>";


?>
