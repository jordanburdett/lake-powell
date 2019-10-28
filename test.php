<?php


if ($_POST["offSet"] != NULL) {
    $offSet = $_POST["offSet"];
}
else {
    $offSet = 0;
}

$startDayOfWeek = date("w", mktime(0,0,0, date("m") + $offSet, 1, date("y")));
echo $startDayOfWeek;
echo "<br>";
echo date("Y", mktime(0,0,0, date("n") + 12, date("d"), date("y")));
?>