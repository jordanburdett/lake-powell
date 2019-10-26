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



$dayStart = $_POST['dayStart'];
$dayEnd = $_POST['dayEnd'];
$year = $_POST['year'];
$month = $_POST['month'];
$user_id = $_SESSION['user_id'];
$info = $_POST['info'];

$statement = $db->prepare("INSERT INTO dates(user_id, month_start, month_end, day_start, day_end, year_start, year_end)
VALUES ($user_id, $month, $month, $dayStart, $dayEnd, $year, $year)");

//$statement->execute();

/*
$date_id = $db->lastInsertId('dates_id_seq');

$statement = $db->prepare("INSERT INTO note(user_id, date_id, info)
VALUES ($user_id, $date_id, '$info')");

$statement->execute();

echo "<p>Your dates for $month/$startDay/$year - $month/$dayEnd/$year</p>";
echo "<p>Notes - $info</p>";

*/
?>
