<?php
session_start();

if ($_SESSION['loggedIn'] != true) {
    echo "You do not have access";
    header("location: loginPage.php");
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

<?php

if ($_POST["offSet"] != NULL) {
    $offSet = $_POST["offSet"];

   

}
else {
    $offSet = 0;

    echo '
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
                    Houseboat Calendar
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
                        <a class="nav-link" href="info.php">Account Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="schedule.php">Schedule</a>
                    </li>
                </ul>';
}





            ?>

            <?php

            class Day
            {
                public $number;
                public $isAvaliable;
                public $dateId = null;
                public $userId = 0;
            }


            //DECLARE EVERYTHING TO DO WITH DATES HERE!
           
            

            $month          = date("n", mktime(6,6,6, date("n") + $offSet, 1, date("y")));
            $monthString    = date("F", mktime(6,6,6, date("n") + $offSet, 1, date("y")));
            $year           = date("Y", mktime(6,6,6, date("n") + $offSet, 1, date("y")));
            $startDayOfWeek = date("w", mktime(6,6,6, date("n") + $offSet, 1, date("y")));
            $daysInMonth    = date("t", mktime(6,6,6, date("n") + $offSet, 1, date("y")));
            

            // query the info for current month || end month && current year || end year
            // day_start, day_end, dateId || if day start = null its a carry over from previous month or year

            $dates = array();
            foreach ($db->query('SELECT id, day_start, day_end, year_start, year_end, user_id FROM dates
                    WHERE month_start = ' . $month . '
                    AND year_start = ' . $year . 'ORDER BY day_start'
                    ) as $row) {
                array_push($dates, $row['day_start'], $row['user_id'], $row['id'], $row['day_end']);
            }

            $datesArray = array();

            $dateCounter = 0;
            for ($i = 1; $i < 35; $i++) {


                if ($i == $dates[$dateCounter]) {
                    // this is what will run if we have a occupied date

                    //increment dateCounter to the end date of the first trip

                    $dateCounter++;
                    $user_id = ($dates[$dateCounter]);
                    $dateCounter++;
                    $date_id = $dates[$dateCounter];
                    $dateCounter++;

                    while ($i != ($dates[$dateCounter])) {

                        $day = new Day;
                        $day->number = ($i);
                        $day->isAvaliable = false;
                        $day->dateId = $date_id;
                        $day->userId = $user_id;
                        $i++;
                        array_push($datesArray, $day);
                    }
                    $day = new Day;
                    $day->number = $i;
                    $day->isAvaliable = false;
                    $day->dateId = $date_id;
                    $day->userId = $user_id;
                    array_push($datesArray, $day);
                    $dateCounter++;
                } else {
                    $day = new Day;

                    $day->number = ($i);
                    $day->isAvaliable = true;

                    array_push($datesArray, $day);
                }
            }

            //calendar div
            echo "<div id='calendar'>";

            $days = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");

            //display the month
            echo "<h3 class='display-4' style='text-align:center;'> 
                <span class='nextMonth' onclick='nextMonth(false)'><-  </span>" 
                . $monthString . " $year<span onclick='nextMonth(true)' class='nextMonth'>  -></span></h3>";

            echo "<p>Click any green space to reserve the boat</p>";
            echo "<h3 id='monthNumber'  style='display:none;' value='" . $month . "'></h3>";
            echo "<h3 id='yearNumber'   style='display:none;' value='" . $year . "'></h3>";
            echo "<div class='row flex-nowrap' style='border:solid black;'>";
           
            //create the header of days
            for ($i = 0; $i < 7; $i++) {
                echo "<div class='col' style='text-align:center;'>" . $days[$i] . "</div>";
            }
            echo "</div>";

            //create the days
            echo "<div class='row flex-nowrap'>";


            $indexOfDates = 0;
            for ($i = 0; $i < 35; $i++) {

                //wrap every 7 days
                if ($i % 7 == 0) {

                    echo "</div><div class='row flex-nowrap'>";
                }

                if ($i >= ($startDayOfWeek) && $i < $daysInMonth + $startDayOfWeek) {

                    // the actual day
                    if ($datesArray[$indexOfDates]->isAvaliable) {
                        echo "<div class='col' id='avaliable' name='date" . $datesArray[$indexOfDates]->number . "'  onclick='selectDay(" . $datesArray[$indexOfDates]->number . ")'>"
                            . $datesArray[$indexOfDates]->number . "</div>";
                    } else {

                        //query the info to get who has what date
                        $firstName = "";
                        $lastName = "";
                        $dateId = $datesArray[$indexOfDates]->dateId;

                        $statement = $db->prepare("SELECT first_name, last_name FROM user_profile as u, dates as d
                        WHERE u.id = d.user_id AND d.id = " . $datesArray[$indexOfDates]->dateId);

                        $statement->execute();


                        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                            $firstName = $row['first_name'];
                            $lastName = $row['last_name'];
                        }

                        echo "<div class='col' id='taken'>" . $datesArray[$indexOfDates]->number . "<a href='dateDetails.php?dateId=$dateId' style='color:black;' id='nameHide'><br>$firstName</a></div>";
                    }

                    $indexOfDates++;
                } else {
                    // place holder not actual days
                    echo "<div class='col' style='border:solid black .5px;'></div>";
                }
            }




            echo "</div>";
            
            
            echo '
            <br>
            <div>Green = Available</div>
            <div>red = taken</div>
            <div>orange = selected</div>
            <br>
            <div id="infoBox">
                <h3>Trip Info</h3>
                <textarea class="form-control" id="info" column="5"></textarea>
                <br>

                <button class="btn btn-primary" id="reserveButton" onclick="reserve()">Reserve Dates</button>
            </div>
        </div>

        <div id="confirm"></div>
    </div>
    



</body>';

// close calendar div
echo "</div>";

?>

</html>