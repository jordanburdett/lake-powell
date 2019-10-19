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


foreach($db->query('SELECT username, password, first_name, last_name FROM user_profile
                    WHERE username = \'' . $username .'\' AND password = \'' . $password .'\'') as $row) 
                    { 
                       
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                    }


if ($first_name == "") {
    echo "<ul class='nav nav-tabs nav-justified'>
    <li class='nav-item'>
        <a class='nav-link' href='home.php'>Home</a>
    </li>
    </ul>";
    echo "invalid login";
}
else
{

    echo "<ul class='nav nav-tabs nav-justified'>
    <li class='nav-item'>
        <a class='nav-link active' href='home.php'>Home</a>
    </li>
    <li class='nav-item'>
        <a class='nav-link' href='info.php'>Info</a>
    </li>
    <li class='nav-item'>
        <a class='nav-link' href='#'>Link 3</a>
    </li>
    </ul>";
    echo '<p>' . $first_name . ' ' . $last_name . ' you are now logged in</p>';
    

    $_SESSION['loggedIn'] = true;
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
}
?>
