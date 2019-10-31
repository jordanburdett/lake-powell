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
$user_id = 0;

foreach($db->query('SELECT username, password, first_name, last_name, id FROM user_profile
                    WHERE username = \'' . $username .'\' AND password = \'' . $password .'\'') as $row) 
                    { 
                       
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        $user_id = $row['id'];
                    }


if ($first_name == "") {
    
    header("location: loginPage.php");
}
else
{

    
    

    $_SESSION['loggedIn']   = true;
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name']  = $last_name;
    $_SESSION['user_id']    = $user_id;
    $_SESSION['username']   = $username;

    header("location: home.php");
}
?>
