<?php

require '../init.php';

$fabric = new RandData\Fabric();
$dataSetTime = $fabric->createObjectFromString("time");
printData("No parameters", $dataSetTime);
$dataSetTime2 = $fabric->createObjectFromString("time:seconds=1");
printData("With seconds", $dataSetTime2);
$dataSetTime3 = $fabric->createObjectFromString("time:min=12:30;max=13:15");
printData("From 12:30 to 13:15", $dataSetTime3);
$dataSetTime4 = $fabric->createObjectFromString("time:min=12:30;max=12:31;seconds=1");
printData("From 12:30 to 12:31", $dataSetTime4);
