<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\Str();
$dataSetTime = $fabric->create("time");
printData("No parameters", $dataSetTime);
$dataSetTime2 = $fabric->create("time:seconds=1");
printData("With seconds", $dataSetTime2);
$dataSetTime3 = $fabric->create("time:min=12:30;max=13:15");
printData("From 12:30 to 13:15", $dataSetTime3);
$dataSetTime4 = $fabric->create("time:min=12:30;max=12:31;seconds=1");
printData("From 12:30 to 12:31", $dataSetTime4);
