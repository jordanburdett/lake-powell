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



$username = $_POST['username'];
$password = $_POST['password'];
$first_name = "";
$last_name = "";

/*
foreach($db->query('SELECT username, password, first_name, last_name FROM user_profile
                    WHERE username = ' . $username . 'AND password = ' . $password) as $row) 
                    { 
                        echo '<p>' . $row['username'] . ' , ' . $row['password'] . "</p>";
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                    }
*/

if ($first_name == "") {
    echo "invalid login";
}
else
{
    echo '<p>' . $first_name . '</p>';
    echo '<p>' . $last_name . '</p>';
}
?>
