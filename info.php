<?php
session_start();
try
{
  $dbUrl = getenv('DATABASE_URL');

  $dbOpts = parse_url($dbUrl);

  $dbHost = $dbOpts["host"];
  $dbPort = $dbOpts["port"];
  $dbUser = $dbOpts["user"];
  $dbPassword = $dbOpts["pass"];
  $dbName = ltrim($dbOpts["path"],'/');

  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
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

    <div class="header">
        <h1 class="display-4">
            House Boat info
        </h1>

        <div class="shadow p-4 mb-4 bg-white">
        <div class="container">

            <!-- bootstrap navbar -->
            <ul class="nav nav-tabs nav-justified">
                <li class="nav-item">
                    <a class="nav-link active" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="info.php">Info</a>
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

        <div class="shadow p-4 mb-4 bg-white">
            <?php
                foreach($db->query('SELECT first_name, month_start, month_end, day_start, day_end, year_start, year_end FROM user_profile AS u
                    JOIN dates AS n
                    ON u.id = n.user_id') as $row) { 
                        echo '<p>' . $row['first_name'] . "'s date: " 
                        . $row['month_start'] . ", " . $row['day_start'] . ", " . $row['year_start']
                        . " - " . $row['month_end'] . ", " . $row['day_end'] . ", " . $row['year_end']
                        . "</p>";
                    }
            ?>
        </div>
    </div>
    </div>

    
    <script src="javascript.js"></script>
</body>

</html>